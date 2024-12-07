pipeline {

    agent {
        docker {
            image 'php:8.1-cli'
            args '-u root:root'
        }
    }
    environment {
        // Deployment Paths
        DEPLOY_BASE_DIR = "/var/www/myproject"
        APP_NAME = "eureka-app"

        // Repository Configuration
        REPO_URL = "https://github.com/afpthedev/eureka.git"
        REPO_BRANCH = "main"

        // Database Credentials (use Jenkins Credentials)
        DB_CREDENTIALS = credentials('mysql-database-credentials')

        // Docker Container Names
        PHP_CONTAINER = "php-app-${BUILD_NUMBER}"
        MYSQL_CONTAINER = "mysql-db-${BUILD_NUMBER}"

        // Environment Configuration
        APP_ENV = "production"
        APP_DEBUG = "false"
    }

    // Pipeline stages for comprehensive deployment
    stages {
        // Prepare build environment with necessary tools
        stage('Prepare Environment') {
            steps {
                sh '''
                    # Update package lists and install dependencies
                    apt-get update && apt-get install -y \
                        git \
                        unzip \
                        libzip-dev \
                        libpng-dev \
                        libonig-dev \
                        curl

                    # Install PHP extensions
                    docker-php-ext-install \
                        pdo_mysql \
                        mbstring \
                        zip \
                        gd
                '''
            }
        }

        // Clone the repository with specific branch
        stage('Code Checkout') {
            steps {
                git branch: "${REPO_BRANCH}",
                    url: "${REPO_URL}",
                    credentialsId: 'github-credentials'
            }
        }

        // Install Composer dependencies
        stage('Install Dependencies') {
            steps {
                sh '''
                    # Install Composer
                    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

                    # Install project dependencies
                    composer install \
                        --no-interaction \
                        --prefer-dist \
                        --optimize-autoloader \
                        --no-dev
                '''
            }
        }

        // Prepare environment configuration
        stage('Configure Environment') {
            steps {
                script {
                    // Generate a secure application key
                    sh 'php artisan key:generate'

                    // Create custom .env file with secure configurations
                    sh """
                        cat > .env << EOF
APP_NAME=${APP_NAME}
APP_ENV=${APP_ENV}
APP_KEY=\$(php artisan key:generate --show)
APP_DEBUG=${APP_DEBUG}

DB_CONNECTION=mysql
DB_HOST=${DB_CREDENTIALS_HOST}
DB_PORT=3306
DB_DATABASE=${DB_CREDENTIALS_USR}
DB_USERNAME=${DB_CREDENTIALS_USR}
DB_PASSWORD=${DB_CREDENTIALS_PSW}

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
EOF
                    """
                }
            }
        }

        // Database migrations and setup
        stage('Database Preparation') {
            steps {
                script {
                    sh '''
                        # Run database migrations
                        php artisan migrate --force

                        # Optional: Seed database if needed
                        # php artisan db:seed --force
                    '''
                }
            }
        }

        // Build and tag application Docker image
        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("${APP_NAME}:${BUILD_NUMBER}")
                }
            }
        }

        // Deploy application containers
        stage('Deploy Containers') {
            steps {
                script {
                    // Stop and remove existing containers if they exist
                    sh """
                        docker stop ${PHP_CONTAINER} || true
                        docker rm ${PHP_CONTAINER} || true

                        # Run new PHP application container
                        docker run -d \
                            --name ${PHP_CONTAINER} \
                            -p 8000:80 \
                            -v \$(pwd):/var/www/html \
                            --network app-network \
                            ${APP_NAME}:${BUILD_NUMBER}
                    """
                }
            }
        }

        // Application health check and testing
        stage('Health Check') {
            steps {
                script {
                    sh '''
                        # Wait for application to be ready
                        sleep 10

                        # Perform health check
                        curl -f http://localhost:8000/health || exit 1
                    '''
                }
            }
        }
    }

    // Post-deployment actions
    post {
        success {
            echo "🎉 Deployment successful! Application is live at http://localhost:8000"

            // Optional: Send success notification
            // emailext body: 'Deployment completed successfully',
            //         subject: 'Deployment Success',
            //         to: 'team@example.com'
        }

        failure {
            echo "❌ Deployment failed. Initiating rollback..."

            script {
                // Rollback steps
                sh '''
                    docker stop ${PHP_CONTAINER} || true
                    docker rm ${PHP_CONTAINER} || true
                '''
            }

            // Optional: Send failure notification
            // emailext body: 'Deployment failed',
            //         subject: 'Deployment Failure',
            //         to: 'team@example.com'
        }

        always {
            // Clean up Docker images and containers
            sh '''
                docker system prune -f
            '''
        }
    }
}
