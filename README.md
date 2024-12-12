# **Makine Öğrenmesi ve ChatGPT Destekli Veri Analizi Platformu**

## **Proje Tanımı**

Bu proje, kullanıcıların veri setlerini analiz edebileceği, makine öğrenmesi algoritmalarını kullanarak tahminler yapabileceği ve OpenAI ChatGPT entegrasyonu ile veri setlerini yorumlayabileceği bir platform geliştirmeyi amaçlamaktadır.

## **Proje Hedefleri**

- Kullanıcıların veri setlerini yükleyip analiz yapmalarını sağlamak.
- Çeşitli makine öğrenmesi algoritmaları ile veri analizi yapmak ve sonuçları görselleştirmek.
- OpenAI ChatGPT'yi kullanarak veri setlerine yönelik detaylı analiz ve yorumlama yapmak.
- Kullanıcı kimlik doğrulama ve veritabanı yönetim sistemi entegre ederek güvenli ve ölçeklenebilir bir platform oluşturmak.

## **Teknoloji Yığını**

### **Backend**
- **Python/Flask**: Makine öğrenmesi modelleri ve ChatGPT entegrasyonu için kullanıldı.
- **Laravel**: API geliştirme, kullanıcı doğrulama ve veritabanı yönetimi için kullanıldı.
- **PostgreSQL veya MySQL**: Veritabanı yönetim sistemi olarak.

### **Frontend**
- **Blade (Laravel)**: Kullanıcı arayüzü geliştirme için kullanıldı.
- **React (Opsiyonel)**: Dinamik ve modern kullanıcı arayüzleri için kullanılabilir.

### **Makine Öğrenmesi Kütüphaneleri**
- **scikit-learn**: Makine öğrenmesi modelleri ve algoritmaları için.

### **Yapay Zeka Entegrasyonu**
- **OpenAI API**: ChatGPT entegrasyonu için kullanıldı.

### **Araçlar ve Diğer Teknolojiler**
- **Docker**: Geliştirme ortamlarının yönetimi ve dağıtım için.
- **Git/GitHub**: Versiyon kontrolü ve iş birliği için.
- **Postman**: API testi ve hata ayıklama için.

## **Kurulum ve Çalıştırma**

### **Ön Gereksinimler**
- [Node.js](https://nodejs.org/)
- [Python 3.8+](https://www.python.org/)
- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/)

### **Backend Kurulumu (Flask ve Laravel)**

1. **Python ortamınızı ve Flask'ı kurun:**
   ```bash
   python -m venv venv
   source venv/bin/activate  # macOS/Linux
   .\venv\Scripts\activate  # Windows
   pip install -r requirements.txt


### **Docker Kurulumu**

1. **Docker Kurulumu ve Çalıştırılması:**
   ```bash
   docker-compose up -d
   docker-compose ps
   docker run --name my_postgres -e POSTGRES_PASSWORD=mysecretpassword -e POSTGRES_USER=myuser -e POSTGRES_DB=laravel-docker -p 5432:5432 -d postgres
   docker run --name my_postgres -e POSTGRES_HOST_AUTH_METHOD=trust -p 5432:5432 -d postgres


