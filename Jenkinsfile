pipeline {
    agent any

    environment {
        // Deployment Directories
        DEPLOY_DIR = "/var/www/isar"
        REPO_URL = "https://github.com/afpthedev/eureka.git"

        // Database Configuration
        DB_HOST = "127.0.0.1"
        DB_PORT = "3306"
        DB_DATABASE = "exampledb"
        DB_USERNAME = "exampleuser"
        DB_PASSWORD = "examplepass"

        // Docker Container Names
        MYSQL_CONTAINER = "mysql-docker"
    }

    stages {
        stage('Prepare Environment') {
            steps {
                sh '''
                    # PHP ve gerekli araçları yükle
                    apt-get update
                    apt-get install -y \
                        php-cli \
                        php-mbstring \
                        php-xml \
                        php-intl \
                        unzip \
                        curl \
                        git \
                        rsync
                '''
            }
        }

        stage('Prepare Deployment Directory') {
            steps {
                sh '''
                    # Deployment dizinini oluştur ve izinleri ayarla
                    mkdir -p ${DEPLOY_DIR}
                    chown -R www-data:www-data ${DEPLOY_DIR}
                    chmod -R 775 ${DEPLOY_DIR}
                '''
            }
        }

        stage('Checkout Code') {
            steps {
                git branch: 'main', url: "${REPO_URL}"
            }
        }

        stage('Install Dependencies') {
            steps {
                sh '''
                    # Composer'ı kur ve bağımlılıkları yükle
                    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
                    composer install \
                        --no-interaction \
                        --prefer-dist \
                        --optimize-autoloader
                '''
            }
        }

        stage('Configure MySQL') {
            steps {
                script {
                    // MySQL konteynerini ve bağlantıyı kontrol et
                    sh '''
                    # MySQL konteynerinin çalışıp çalışmadığını doğrula
                    if ! docker ps | grep ${MYSQL_CONTAINER}; then
                        echo "MySQL konteyner çalışmıyor! Lütfen kontrol edin."
                        exit 1
                    fi

                    # Veritabanı ve kullanıcı oluştur
                    docker exec ${MYSQL_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "
                        CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};
                        CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';
                        GRANT ALL PRIVILEGES ON ${DB_DATABASE}.* TO '${DB_USERNAME}'@'%';
                        FLUSH PRIVILEGES;
                    "
                    '''
                }
            }
        }

        stage('Deploy Application') {
            steps {
                sh '''
                    # Uygulamayı deploy et
                    rsync -av --exclude=".git" . ${DEPLOY_DIR}

                    # İzinleri ayarla
                    chown -R www-data:www-data ${DEPLOY_DIR}
                    chmod -R 775 ${DEPLOY_DIR}/storage ${DEPLOY_DIR}/bootstrap/cache

                    # Laravel yapılandırma ve migrasyon
                    php ${DEPLOY_DIR}/artisan config:cache
                    php ${DEPLOY_DIR}/artisan migrate --force
                '''
            }
        }
    }

    post {
        success {
            echo "🎉 Pipeline başarıyla tamamlandı!"
        }
        failure {
            echo "❌ Pipeline sırasında bir hata oluştu."
        }
    }
}
