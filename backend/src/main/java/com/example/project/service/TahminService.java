package com.example.project.service;

import com.example.project.config.MLServiceConfig;
import com.example.project.model.Stock;
import com.example.project.repository.StockRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

import java.util.Map;

@Service
@RequiredArgsConstructor
public class TahminService {

    private final RestTemplate restTemplate;
    private final StockRepository stockRepository;
    private final MLServiceConfig mlServiceConfig;

    public Map<String, Object> getPrediction(String sembol) {
        // Veritabanından hisse senedi verilerini al
        Stock stock = stockRepository.findBySembol(sembol)
                .orElseThrow(() -> new RuntimeException("Hisse senedi bulunamadı: " + sembol));

        // ML servisine tahmin isteği gönder
        Map<String, Object> prediction = restTemplate.postForObject(
                mlServiceConfig.getUrl() + "/predict",
                Map.of("sembol", sembol),
                Map.class
        );

        // Tahmin sonucunu veritabanına kaydet
        stock.setTahminDegeri((Double) prediction.get("tahmin_degeri"));
        stockRepository.save(stock);

        return prediction;
    }
} 