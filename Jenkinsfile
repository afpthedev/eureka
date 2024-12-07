pipeline {
    agent any

    environment {
        DEPLOY_DIR = "/var/www/isar"
        REPO_URL = "https://github.com/afpthedev/eureka.git"
        DB_HOST = "127.0.0.1"
        DB_PORT = "3306"
        DB_DATABASE = "exampledb"
        DB_USERNAME = "exampleuser"
        DB_PASSWORD = "examplepass"
        MYSQL_CONTAINER = "mysql-docker"
    }

    stages {
        stage('Prepare Deployment Directory') {
            steps {
                sh '''
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
                curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
                composer install --no-interaction --prefer-dist --optimize-autoloader
                '''
            }
        }

        stage('Configure MySQL') {
            steps {
                script {
                    // MySQL konteynerini kontrol et ve bağlantıyı yapılandır
                    sh '''
                    if ! docker ps | grep ${MYSQL_CONTAINER}; then
                        echo "MySQL konteyner çalışmıyor, lütfen kontrol edin."
                        exit 1
                    fi
                    docker exec ${MYSQL_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};"
                    docker exec ${MYSQL_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';"
                    docker exec ${MYSQL_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "GRANT ALL PRIVILEGES ON ${DB_DATABASE}.* TO '${DB_USERNAME}'@'%';"
                    docker exec ${MYSQL_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "FLUSH PRIVILEGES;"
                    '''
                }
            }
        }

        stage('Deploy Application') {
            steps {
                sh '''
                rsync -av --exclude=".git" . ${DEPLOY_DIR}
                chown -R www-data:www-data ${DEPLOY_DIR}
                chmod -R 775 ${DEPLOY_DIR}/storage ${DEPLOY_DIR}/bootstrap/cache
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
