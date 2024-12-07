pipeline {
    agent any

    environment {
        DEPLOY_DIR = "/var/www/isar"
        REPO_URL = "https://github.com/afpthedev/eureka.git"
        DB_HOST = "127.0.0.1"
        DB_PORT = "3306"
        DB_DATABASE = "isar"
        DB_USERNAME = "root"
        DB_PASSWORD = "my-secret-pw"
        MARIADB_CONTAINER = "mymariadb"
    }

    stages {
        stage('Prepare Environment') {
            steps {
                sh '''
                apt-get update
                apt-get install -y php-cli php-mbstring php-xml php-intl unzip curl git rsync
                '''
            }
        }

        stage('Prepare Deployment Directory') {
            steps {
                sh '''
                mkdir -p ${DEPLOY_DIR}
                chown -R www-data:www-data ${DEPLOY_DIR}
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
                composer install --no-interaction --prefer-dist --optimize-autoloader
                '''
            }
        }

        stage('Configure MariaDB') {
            steps {
                script {
                    // MariaDB'yi kontrol et ve çalışıyorsa bağlantıyı doğrula
                    sh '''
                    if ! docker ps | grep ${MARIADB_CONTAINER}; then
                        echo "MariaDB konteyner çalışmıyor!"
                        exit 1
                    fi
                    docker exec ${MARIADB_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};"
                    docker exec ${MARIADB_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';"
                    docker exec ${MARIADB_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "GRANT ALL PRIVILEGES ON ${DB_DATABASE}.* TO '${DB_USERNAME}'@'%';"
                    docker exec ${MARIADB_CONTAINER} mysql -u root -p${DB_PASSWORD} -e "FLUSH PRIVILEGES;"
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
            echo "Pipeline başarıyla tamamlandı!"
        }
        failure {
            echo "Pipeline sırasında bir hata oluştu."
        }
    }
}
