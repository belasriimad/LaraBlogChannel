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
        script {
          input = input message: 'What\'s your seed?',
          parameters: [string(defaultValue: '',
          description: 'Choose your class seed',
          name: 'Seed')]


          echo "Seed class chosen: ${input}"
        }

        sh 'php artisan make:seed $input'
        sh 'php artisan db:seed --class=$input'
      }
    }

    stage('Mail Notification') {
      steps {
        emailext(subject: 'LBC Pipeline', body: 'A mail from the above', attachLog: true, from: 'jenkins@ubuntu', to: 'al2a.meskine@gmail.com')
      }
    }

  }
  environment {
    DB_DATABASE = 'homestead'
    input = 'UserTableSeeder'
  }
}