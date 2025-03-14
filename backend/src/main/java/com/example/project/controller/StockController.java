package com.example.project.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class StockController {

    @GetMapping("/api/tahmin")
    public String getPrediction(@RequestParam String sembol) {
        // Service katmanına istek gönderilecek
        return "Tahmin sonucu";
    }
} 