pipeline {
    agent any

    environment {
        DEPLOY_DIR = "/var/www/isar"
        REPO_URL = "https://github.com/afpthedev/eureka.git"
    }
    stages {
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
                export DEBIAN_FRONTEND=noninteractive
                apt-get update && apt-get install -y php-sqlite3 rsync
                mkdir -p /var/www/isar
                rsync -av --exclude=.git . /var/www/isar
                apt-get install -y
                apt-get install -y php-mysql
                apt-get install -y php-sqlite3
                '''
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                mkdir -p ${DEPLOY_DIR}
                rsync -av --exclude=".git" . ${DEPLOY_DIR}
                php ${DEPLOY_DIR}/artisan migrate --force
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
