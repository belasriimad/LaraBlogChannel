pipeline {
  agent any
  stages {
    stage('Build') {
      parallel {
        stage('Build') {
          steps {
            sh 'php --version'
            sh 'cp .env.example .env'
            sh 'composer update'
            sh 'php artisan key:generate'
            sh 'php artisan migrate'
          }
        }

        stage('NPM') {
          steps {
            sh 'sudo apt update'
            sh 'apt install nodejs npm'
            sh 'npm build'
          }
        }

      }
    }

  }
}