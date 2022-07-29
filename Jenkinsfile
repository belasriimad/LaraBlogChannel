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
            message: 'How many seeds would you like to implement?',
            parameters: [
              [$class: 'ChoiceParameterDefinition',
              choices: ['1','2','3'].join('\n'),
              name: 'input',
              description: 'Select the number of seeds']
            ])


            if( "${USER_INPUT}" == "1"){
              echo "You have chosen: ${USER_INPUT} seed"
              def SEED_INPUT = input(
                message: 'What\'s your seed?',
                parameters:[string(defaultValue: '',
                description: 'Choose your class seed',
                name: 'Seed')] )
                echo "Seed class chosen: ${SEED_INPUT}" }
              }

              sh 'export SEED_INPUT=$SEED_INPUT'
              sh 'php artisan make:seed SEED_INPUT'
              sh 'php artisan db:seed --class=$SEED_INPUT'
            }
          }

        }
        environment {
          DB_DATABASE = 'homestead'
        }
      }