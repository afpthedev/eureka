pipeline {
     agent {
            docker {
                image 'composer:2' // Composer yüklü resmi imaj
                args '-u root:root' // Gerekirse root olarak çalıştır
            }
        }

    environment {
        APP_ENV = 'production'
        DB_HOST = 'mariadb'
        DB_PORT = '3306'
        DB_DATABASE = 'laravel_db'
        DB_USERNAME = 'laravel_user'
        DB_PASSWORD = 'laravel_password'
    }

    stages {
        stage('Initialize') {
            steps {
                echo 'Pipeline başlatılıyor...'
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                echo 'Composer bağımlılıkları yükleniyor...'
                sh 'curl -sS https://getcomposer.org/installer | php'
                sh 'php composer.phar install --no-dev --optimize-autoloader'
            }
        }

        stage('Install JS Dependencies & Build') {
            steps {
                echo 'NPM bağımlılıkları yükleniyor ve build yapılıyor...'
                sh 'npm install'
                sh 'npm run prod'
            }
        }

        stage('Run Tests') {
            steps {
                echo 'Testler çalıştırılıyor...'
                sh 'php artisan test'
            }
        }

        stage('Database Migrations') {
            steps {
                echo 'Veritabanı migrasyonları uygulanıyor...'
                sh 'php artisan migrate --force'
            }
        }

        stage('Deploy to Server') {
            steps {
                echo 'Kod canlı ortama aktarılıyor...'
                sh 'rsync -avz --exclude=.git ./ /var/www/eureka/'
            }
        }

        stage('Restart Services') {
            steps {
                echo 'Servisler yeniden başlatılıyor...'
                sh 'sudo systemctl restart php8.1-fpm'
                sh 'sudo systemctl restart nginx'
            }
        }
    }

    post {
        success {
            echo 'Deployment başarılı!'
        }
        failure {
            echo 'Deployment başarısız!'
        }
    }
}
