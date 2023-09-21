pipeline {
  agent any
  stages {
    stage('SCM') {
      steps {
        git(url: 'https://github.com/elanglet/banque-portail-sf', branch: 'main')
      }
    }

    stage('Build') {
      steps {
        bat 'compose install'
      }
    }

    stage('Test') {
      steps {
        bat './vendor/bin/phpunit --log-junit var/log/phpunit.xml Tests/Unit'
      }
    }

  }
}