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
        bat 'composer install'
      }
    }

    stage('Test') {
      steps {
        bat 'php .\\bin\\phpunit --log-junit tests-results.xml Tests\\Unit\\'
        junit testResults: 'tests-results.xml'
      }
    }

    stage('SonarQube analysis') {
      steps {
        script {
            scannerHome = tool 'SonarQube Scanner' // Nom de la référence au SonarQube Scanner (Administrer -> Tools)
        }
        withSonarQubeEnv('SonarQube Server') { // Nom de la référence au SonarQube Server (Administrer -> System)
          bat "${scannerHome}/bin/sonar-scanner"
        }
      }
    }
    
    stage('Deployment') {
        steps {
            bat 'docker\\pre-deploy.cmd'
            bat 'docker compose -f docker\\compose.yaml up -d --build'
            bat 'docker\\post-deploy.cmd'
        }
    }

  }
}