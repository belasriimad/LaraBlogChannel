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

    stage('Seeds') {
      steps {
        script {
          def USER_INPUT = input(
            message: 'How many seeds woud you like to implement?',
            parameters: [
              [$class: 'ChoiceParameterDefinition',
              choices: ['1','2', '3'].join('\n'),
              name: 'input',
              description: 'Menu - select box option']
            ])


            if( "${USER_INPUT}" == "1"){
              echo "The answer is: ${USER_INPUT} seed"
              //do something
            } else {
              echo "The answer is: ${USER_INPUT} seeds"
              //do something else
            }
          }

        }
      }

    }
    environment {
      DB_DATABASE = 'homestead'
      input = 'UserTableSeeder'
    }
  }