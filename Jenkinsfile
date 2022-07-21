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

        stage('Sleep') {
          steps {
            sleep 10
          }
        }

        stage('NPM') {
          steps {
            sh 'npm install'
          }
        }

      }
    }

    stage('PHP version') {
      steps {
        sh 'php -v'
      }
    }

  }
}