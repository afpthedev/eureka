<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    public function upload(Request $request)
    {
        // Dosya yükleme işlemi için geçerlilik kontrolü
        $request->validate([
            'data_file' => 'required|mimes:csv,xlsx|max:2048',
        ]);

        $file = $request->file('data_file');
        $path = $file->getRealPath();
        $data = file_get_contents($path);

        try {
            // Dosyanın okunduğunu loglayın
            Log::info('Dosya başarıyla okundu: ' . $file->getClientOriginalName());

            // Flask API'ye dosyayı gönder
            $response = Http::timeout(10)->attach('file', $data, $file->getClientOriginalName())
                ->post('http://127.0.0.1:5000/upload');

            // Yanıtın başarılı olup olmadığını kontrol et
            if ($response->successful()) {
                $responseData = $response->json();

                // Yanıtta 'columns' anahtarının olup olmadığını kontrol et
                if (isset($responseData['columns'])) {
                    Log::info('Flask API\'den başarılı yanıt alındı.');
                    return response()->json(['columns' => $responseData['columns']]);
                } else {
                    Log::error('Flask API yanıtında kolon bilgisi bulunamadı: ' . json_encode($responseData));
                    return response()->json(['error' => 'Flask API yanıtında kolon bilgisi bulunamadı.'], 400);
                }
            } else {
                Log::error('Flask API\'den geçerli bir yanıt alınamadı. HTTP Durum Kodu: ' . $response->status());
                return response()->json(['error' => 'Flask API\'den geçerli bir yanıt alınamadı.'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Flask API hatası: ' . $e->getMessage());
            return response()->json(['error' => 'Flask API\'ye bağlanırken bir hata oluştu.'], 500);
        }
    }

    public function analyze(Request $request)
    {
        $dependentVariable = $request->input('dependentVariable');

        if (!$dependentVariable) {
            return response()->json(['error' => 'Bağımlı değişken belirtilmedi.'], 400);
        }

        try {
            $response = Http::post('http://127.0.0.1:5000/analyze', [
                'dependent_variable' => $dependentVariable,
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('Flask API analiz yanıtı geçerli değil. HTTP Durum Kodu: ' . $response->status());
                return response()->json(['error' => 'Flask API analiz yanıtı geçerli değil.'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Flask API analiz hatası: ' . $e->getMessage());
            return response()->json(['error' => 'Flask API\'ye bağlanırken analiz sırasında bir hata oluştu.'], 500);
        }
    }
}
