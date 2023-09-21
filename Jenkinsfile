pipeline {
  agent any
  stages {
    stage('SCM') {
      steps {
        git(url: 'https://github.com/elanglet/banque-portail-sf', branch: 'main')
      }
    }

  }
}