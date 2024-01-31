# Projet Symfony TaskMaster

Ce projet est une application TaskMaster développée avec Symfony.

## Prérequis

Avant de lancer le projet, assurez-vous d'avoir installé les outils suivants :

- PHP 7.4 ou supérieur
- Composer
- Symfony CLI
- Un serveur de base de données (MySQL, PostgreSQL, SQLite, etc.)

## Installation

1. Clonez le dépôt Git :

   ```
   git clone https://github.com/votre-utilisateur/taskmaster.git```

  ```
cd taskmaster
Créez la base de données :```

  ```
php bin/console doctrine:database:create```

Appliquez les migrations :

  ```
php bin/console doctrine:migrations:migrate```

Chargez les fixtures si nécessaire :

  ```
php bin/console doctrine:fixtures:load```

Lancement du serveur
Pour lancer le serveur Symfony en arrière-plan, utilisez la commande suivante :

  ```
symfony serve -d```

Le serveur sera disponible à l'adresse http://localhost:8000.
