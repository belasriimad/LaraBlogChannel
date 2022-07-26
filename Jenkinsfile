pipeline {
  agent any
  stages {
    stage('Build ') {
      steps {
        sh 'php -v'
        sh 'cp .env.example .env'
        sh 'composer update'
        sh 'echo DB_HOST=${DB_HOST} >> .env'
        sh 'echo DB_USERNAME=${DB_USERNAME} >> .env'
        sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
        sh 'echo DB_PASSWORD=${DB_PASSWORD} >> .env'
        sh 'php artisan key:generate'
      }
    }

    stage('Test') {
      steps {
        sh '''vendor/bin/phpunit tests/Feature
'''
      }
    }

    stage('Migrate') {
      steps {
        sh 'php artisan migrate'
      }
    }

  }
  environment {
    DB_HOST = 'localhost'
    DB_DATABASE = 'credentials("laravel_database")'
    DB_USERNAME = 'credentials("laravel_username")'
    DB_PASSWORD = 'credentials("laravel_password")'
  }
}