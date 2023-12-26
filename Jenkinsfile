pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                // Checkout your source code repository
                git 'https://github.com/vesothya/Backpack.git'
            }
        }
        
        stage('Build') {
            steps {
                // Build your Java application using Maven
                sh 'mvn clean install'
            }
        }
        
        stage('Deploy') {
            steps {
                // Deploy to Tomcat server
                sh 'cp target/your-app.war $CATALINA_HOME/webapps/'
            }
        }
    }
    
    post {
        success {
            // Notify or perform additional tasks on successful deployment
            echo 'Deployment successful!'
        }
        failure {
            // Handle failures, send notifications, or rollback changes
            echo 'Deployment failed! Please check the logs.'
        }
    }
}
