pipeline {
  agent {
    node {
      label 'mylabel'
    }

  }
  stages {
    stage('Download') {
      steps {
        git(url: 'github.com/alaameskine/LBC', branch: 'master', credentialsId: 'alaameskine', changelog: true)
      }
    }

    stage('Build') {
      steps {
        sh 'php -v'
        sh 'cp .env.example .env'
        sh 'composer update'
        sh 'php artisan key:generate'
        sh 'sed -i -e \'s/DB_DATABASE=homestead/DB_DATABASE=staging/g\' .env'
        sh 'sed -i -e \'s/DB_USERNAME=homestead/DB_USERNAME=yourusername/g\' .env'
        sh 'sed -i -e \'s/DB_PASSWORD=secret/DB_PASSWORD=yourpassword/g\' .env'
      }
    }

    stage('Test') {
      steps {
        sh 'vendor/bin/phpunit tests/Feature'
      }
    }

    stage('Migrate') {
      steps {
        sh 'php artisan migrate'
      }
    }

  }
}