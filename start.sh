#!/bin/bash

echo "Hisse Senedi Tahmin Platformu başlatılıyor..."

# Docker servisinin çalışıp çalışmadığını kontrol et
if ! docker info >/dev/null 2>&1; then
    echo "Docker servisi çalışmıyor. Lütfen Docker'ı başlatın."
    exit 1
fi

# Docker Compose'un yüklü olup olmadığını kontrol et
if ! command -v docker-compose >/dev/null 2>&1; then
    echo "Docker Compose bulunamadı. Lütfen Docker Compose'u yükleyin."
    exit 1
fi

# Python bağımlılıklarını kontrol et ve yükle
echo "Python bağımlılıkları kontrol ediliyor..."
cd mlservice
if [ -f "requirements.txt" ]; then
    python3 -m pip install -r requirements.txt
else
    echo "requirements.txt dosyası bulunamadı!"
    exit 1
fi

# Python servisini arka planda başlat
echo "Python ML servisi başlatılıyor..."
python3 app/routes.py &
PYTHON_PID=$!

# Docker klasörüne git
cd ../docker

# Eski container'ları durdur ve sil
echo "Eski container'lar durduruluyor ve siliniyor..."
docker-compose down

# Container'ları yeniden başlat
echo "Container'lar başlatılıyor..."
docker-compose up -d

# Container'ların durumunu kontrol et
echo "Container'ların durumu kontrol ediliyor..."
docker-compose ps

# Servislerin hazır olmasını bekle
echo "Servisler başlatılıyor, lütfen bekleyin..."
sleep 10

# Backend servisinin durumunu kontrol et
if curl -s http://localhost:8080/actuator/health >/dev/null; then
    echo "Backend servisi hazır!"
else
    echo "Backend servisi henüz hazır değil. Lütfen logları kontrol edin."
fi

# ML servisinin durumunu kontrol et
if curl -s http://localhost:5000/health >/dev/null; then
    echo "ML servisi hazır!"
else
    echo "ML servisi henüz hazır değil. Lütfen logları kontrol edin."
fi

echo "Tüm servisler başlatıldı!"
echo "Frontend: http://localhost:3000"
echo "Backend: http://localhost:8080"
echo "ML Servisi: http://localhost:5000"

# Logları görüntüle
echo "Container loglarını görüntülemek için:"
echo "docker-compose logs -f"

# Uygulamayı durdurmak için fonksiyon
cleanup() {
    echo "Uygulama durduruluyor..."
    # Python servisini durdur
    kill $PYTHON_PID
    # Docker container'larını durdur
    docker-compose down
    exit 0
}

# CTRL+C sinyalini yakala
trap cleanup SIGINT SIGTERM

# Servislerin çalışmasını bekle
wait 