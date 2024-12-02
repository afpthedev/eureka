<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VideoController extends Controller
{
    public function showUploadForm($token)
    {
        $kurban = Kurban::where('video_upload_token', $token)->firstOrFail();

        return view('video-upload', compact('kurban'));
    }

    public function storeVideo(Request $request, $token)
    {
        $kurban = Kurban::where('video_upload_token', $token)->firstOrFail();

        // Video dosyasını kaydediyoruz
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('kurban_videos', 'public');
            $kurban->video_url = $path;
            $kurban->save();

            // Video linkini oluşturuyoruz
            $videoLink = url('storage/' . $kurban->video_url);

            // Frontend'e video linkini gönderiyoruz
            return view('kurban_tracking', compact('videoLink'));
        }

        return redirect()->back()->withErrors('Video yüklenemedi.');
    }


    protected function sendVideoLinkToUser($kurban)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');
        $client = new Client($sid, $token);

        if (!empty($kurban->phone_number)) {
            $message = "Merhaba " . $kurban->donor_name . ", kurban videonuz başarıyla yüklendi. İzlemek için şu bağlantıya tıklayın: " . url('storage/' . $kurban->video_url);

            $client->messages->create(
                $kurban->phone_number,
                [
                    'from' => $twilioNumber,
                    'body' => $message,
                ]
            );
        } else {
            Log::error('Donor phone number is missing for Kurban ID: ' . $kurban->id);
        }
    }
}
