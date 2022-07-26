pipeline {
  agent any
  stages {
    stage('Download ') {
      steps {
        git(url: 'github.com/alaameskine/LBC', branch: 'lbc', changelog: true, credentialsId: 'alaameskine')
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