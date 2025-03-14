package com.example.project.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.project.model.Stock;

import java.util.Optional;

public interface StockRepository extends JpaRepository<Stock, Long> {
    Optional<Stock> findBySembol(String sembol);
    boolean existsBySembol(String sembol);
}