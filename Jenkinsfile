pipeline {
  agent any
  stages {
    stage('Build ') {
      steps {
        sh 'php -v'
        sh 'cp .env.example .env'
        sh 'composer update'
        sh 'cp .env .env.testing'
        sh 'php artisan key:generate'
        sh 'sed -i -e \'s/DB_DATABASE=homestead/DB_DATABASE=staging/g\' .env'
        sh 'sed -i -e \'s/DB_USERNAME=homestead/DB_USERNAME=yourusername/g\' .env'
        sh 'sed -i -e \'s/DB_PASSWORD=secret/DB_PASSWORD=yourpassword/g\' .env'
        sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
        sh 'php artisan config:cache'
        sh 'cat .env'
        sh 'cp .env .env.testing'
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
        sh 'php artisan migrate '
      }
    }

    stage('Mail Notification') {
      steps {
        emailext(subject: 'LBC Pipeline', body: 'A mail from the above', attachLog: true, from: 'jenkins@ubuntu.com', to: 'al2a.meskine@gmail.com')
      }
    }

    stage('Create new File') {
      steps {
        prependToFile(file: 'Languages', content: 'Valar Morghulis')
      }
    }

  }
  environment {
    DB_DATABASE = 'laravel'
  }
}