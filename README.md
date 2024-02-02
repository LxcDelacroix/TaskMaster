# Projet Symfony TaskMaster

Ce projet est une application TaskMaster développée avec Symfony.

## Prérequis

Avant de lancer le projet, assurez-vous d'avoir installé les outils suivants :

- PHP 7.4 ou supérieur
- Composer
- Symfony CLI
- Un serveur de base de données (MySQL, PostgreSQL, SQLite, etc.)

## Installation

###Clonez le dépôt Git :

git clone https://github.com/LxcDelacroix/TaskMaster

cd taskmaster
   
###Créez la base de données :

composer i

php bin/console doctrine:database:create

###Appliquez les migrations :

php bin/console doctrine:migrations:migrate

###Chargez les fixtures si nécessaire :

php bin/console doctrine:fixtures:load

###Lancement du serveur

Pour lancer le serveur Symfony en arrière-plan, utilisez la commande suivante :

symfony serve -d

Le serveur sera disponible à l'adresse http://localhost:8000.

##Identifiant des Users

admin : [id : john_doe , mot de passe : john_doe123]
admin : [id : jane_doe , mot de passe : jane_doe456]
