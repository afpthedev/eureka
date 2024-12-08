pipeline {
    agent any
    environment {
        DB_HOST = 'db'
        DB_DATABASE = 'laravel'
        DB_USERNAME = 'laravel_user'
        DB_PASSWORD = 'laravel_password'
    }
    stages {
        stage("Build") {
            steps {
                sh 'composer install --no-dev --optimize-autoloader'
                sh 'cp .env.example .env'
                sh 'echo DB_HOST=${DB_HOST} >> .env'
                sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
                sh 'echo DB_USERNAME=${DB_USERNAME} >> .env'
                sh 'echo DB_PASSWORD=${DB_PASSWORD} >> .env'
                sh 'php artisan key:generate'
                sh 'php artisan migrate --force'
            }
        }
        stage("Unit Tests") {
            steps {
                sh 'php artisan test'
            }
        }
        stage("Static Code Analysis") {
            steps {
                sh 'vendor/bin/phpstan analyse --memory-limit=2G'
                sh 'vendor/bin/phpcs'
            }
        }
        stage("Docker Build") {
            steps {
                sh 'docker build -t myrepo/laravel-filament:latest .'
            }
        }
        stage("Docker Push") {
            environment {
                DOCKER_USERNAME = credentials("docker-username")
                DOCKER_PASSWORD = credentials("docker-password")
            }
            steps {
                sh 'docker login -u $DOCKER_USERNAME -p $DOCKER_PASSWORD'
                sh 'docker push myrepo/laravel-filament:latest'
            }
        }
    }
}
