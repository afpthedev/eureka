pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/afpthedev/eureka.git'
            }
        }
        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }
        stage('Migrate DB') {
            steps {
                sh 'php artisan migrate --force'
            }
        }
        stage('Build Assets') {
            steps {
                sh 'npm install && npm run prod'
            }
        }
        stage('Clear Cache') {
            steps {
                sh 'php artisan optimize:clear'
                sh 'php artisan cache:clear'
                sh 'php artisan config:cache'
                sh 'php artisan route:cache'
            }
        }
    }
    post {
        always {
            sh 'chown -R www-data:www-data /var/www/isar'
            sh 'systemctl reload nginx'
        }
    }
}
