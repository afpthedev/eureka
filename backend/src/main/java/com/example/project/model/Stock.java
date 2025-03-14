package com.example.project.model;

import lombok.Data;
import javax.persistence.*;
import java.time.LocalDateTime;

@Data
@Entity
@Table(name = "stocks")
public class Stock {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, unique = true)
    private String sembol;

    private Double fiyat;
    
    private Double tahminDegeri;
    
    private LocalDateTime sonGuncelleme;

    @PrePersist
    @PreUpdate
    public void updateTimestamp() {
        sonGuncelleme = LocalDateTime.now();
    }
} 