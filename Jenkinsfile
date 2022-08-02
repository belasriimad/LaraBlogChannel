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
              choices: ['1', '2', '3','4', '5', '6', '7', '8', '9', '10'].join('\n'),
              name: 'inputChoice',
              description: 'Select the number of seeds']
            ])
            echo  "You have chosen: ${USER_INPUT} seed(s)"
            int count = "${USER_INPUT}" as Integer
            for(i=0; i < count; i++) {
              def SEED_ARRAY = input(message: 'What\'s your seed?',
              parameters:[string(defaultValue:'', description: 'Choose your class seed',
              name: 'seed')])
              sh """
              echo "Seed class chosen: ${SEED_ARRAY}"
              export SEED_ARRAY=$SEED_ARRAY
              php artisan make:seed $SEED_ARRAY
              php artisan db:seed --class=$SEED_ARRAY """
            }
          }

        }
      }

      stage('Mail Notification') {
        steps {
          script {

            def MAIL_NOTIFICATION = input(
              message: 'Would you like to receive a mail notification with the logs attached?',
              ok: 'Yes')

            }

            waitUntil() {
              emailext(subject: 'LBC Pipeline', body: 'A mail from above', attachLog: true, from: 'jenkins@ubuntu.com', to: 'al2a.meskine@gmail.com')
            }

          }
        }

      }
      environment {
        DB_DATABASE = 'homestead'
      }
    }