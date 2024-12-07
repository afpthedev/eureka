pipeline {
    agent any

    environment {
        DEPLOY_DIR = "/var/www/isar"
        REPO_URL = "https://github.com/afpthedev/eureka.git"
        DB_HOST = '127.0.0.1'
        DB_PORT = '3306'
        DB_DATABASE = 'laravel_app'
        DB_USERNAME = 'laravel_user'
        DB_PASSWORD = 'my-secret-pw'
        MARIADB_CONTAINER = 'mymariadb'
    }
    stages {

    stage('Setup Database') {
        steps {
            sh '''
            docker-compose up -d
            docker exec mariadb mysql -u root -p"${DB_PASSWORD}" -e "CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};"
            docker exec mariadb mysql -u root -p"${DB_PASSWORD}" -e "CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';"
            docker exec mariadb mysql -u root -p"${DB_PASSWORD}" -e "GRANT ALL PRIVILEGES ON ${DB_DATABASE}.* TO '${DB_USERNAME}'@'%';"
            docker exec mariadb mysql -u root -p"${DB_PASSWORD}" -e "FLUSH PRIVILEGES;"
            '''
        }
    }

    stage('Prepare Deployment Directory') {
            steps {
                sh 'mkdir -p /var/www/isar'
                sh 'chown -R www-data:www-data /var/www/isar'
            }
        }
        stage('Checkout') {
            steps {
                git branch: 'main', url: "${REPO_URL}"
            }
        }

        stage('Install Dependencies') {
            steps {
                sh '''
                apt-get update
                apt-get install -y php-cli php-mbstring php-xml php-intl unzip curl git
                composer install --no-interaction --prefer-dist --optimize-autoloader
                apt-get update
                cp .env.example .env
                sed -i "s/DB_HOST=127.0.0.1/DB_HOST=${DB_HOST}/" .env
                sed -i "s/DB_DATABASE=laravel/DB_DATABASE=${DB_DATABASE}/" .env
                sed -i "s/DB_USERNAME=root/DB_USERNAME=${DB_USERNAME}/" .env
                sed -i "s/DB_PASSWORD=/DB_PASSWORD=${DB_PASSWORD}/" .env
                export DEBIAN_FRONTEND=noninteractive
                apt-get update && apt-get install -y php-sqlite3 rsync
                mkdir -p /var/www/isar
                rsync -av --exclude=.git . /var/www/isar
                apt-get install -y
                apt-get install -y php-mysql
                apt-get install -y php-sqlite3
                composer install
                php artisan migrate
                php artisan config:cache
                '''
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                 mkdir -p /var/www/laravel
                 rsync -av --exclude=".git" . /var/www/laravel
                 chown -R www-data:www-data /var/www/laravel
                 chmod -R 775 /var/www/laravel/storage
                 chmod -R 775 /var/www/laravel/bootstrap/cache
                '''
            }
        }
    }

    post {
        success {
            echo 'Pipeline başarıyla tamamlandı!'
        }
        failure {
            echo 'Pipeline sırasında bir hata oluştu.'
        }
    }
}
