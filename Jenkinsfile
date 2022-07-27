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
        sh 'php artisan migrate:fresh'
      }
    }

    stage('Seed') {
      steps {
        sh 'php artisan db:seed'
        script {
          env.USERNAME = input message: 'Please enter the username',
          parameters: [string(defaultValue: '',
          description: '',
          name: 'Username')]
          env.PASSWORD = input message: 'Please enter the password',
          parameters: [password(defaultValue: '',
          description: '',
          name: 'Password')]

          echo "Username: ${env.USERNAME}"
          echo "Password: ${env.PASSWORD}"
        }

      }
    }

  }
  environment {
    DB_DATABASE = 'homestead'
  }
}