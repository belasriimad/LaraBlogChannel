pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
        sh 'php --version'
        sh 'composer install'
        sh 'cp .env.example .env'
        sh 'composer update'
        sh 'php artisan key:generate'
        sh 'php artisan migrate'
        sh 'php artisan serve'
      }
    }

  }
}