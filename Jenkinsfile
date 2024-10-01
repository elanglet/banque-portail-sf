pipeline {
  agent any
  stages {

    stage('Récupération du code') {
        steps {
            git branch: 'main', url: 'https://github.com/elanglet/banque-portail-sf'
        }
    }
    
    stage('Installation des dépendances') {
        steps {
            bat 'composer install'
        }
    }

    stage('Exécution des tests') {
        steps {
            bat 'php .\\bin\\phpunit --log-junit tests-results.xml tests\\Unit\\'
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
  }
}