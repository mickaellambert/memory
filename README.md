# Memory Game
Test technique réalisé pour O'Clock. 

## Règles

- Au commencement du jeu, des cartes sont disposées face cachée à l'écran.

- Le joueur doit cliquer sur deux cartes. Si celles-ci sont identiques, la paire est
validée. Sinon, les cartes sont retournées face cachée, et le joueur doit sélectionner
une nouvelle paire de cartes.

- Une compteur de temps, avec une barre de progression, s’affiche en dessous du
plateau.

- Le joueur gagne s'il arrive à découvrir toutes les paires avant la fin du temps imparti.

- Chaque temps de partie effectuée doit être sauvegardée en base de données.
Avant le début du jeu, les meilleurs temps s’affichent à l’écran.

## Style

On utilise l'extension de langage Sass pour styliser notre application. Si des modifications veulent être effectuer, il suffit de l'installer en suivant ce léger [tutoriel](https://gist.github.com/christiannaths/acb132b9b88b65d15f37). 

Une fois terminé, et afin de convertir nos fichiers .scss en fichiers .css, il suffira de lancer cette commande : 

```bash
sass --watch app/assets/style/main.scss
```

## BDD

Lorsque j'ai vu qu'il fallait utiliser les objets pour ce test, j'ai choisi d'aller un peu plus loin et d'y ajouter une connexion à [Doctrine](https://www.doctrine-project.org/) afin de lier notre base de données à nos différents objets.
Cela a eu pour effet de rendre le déploiement Docker plus délicat (cf [Docker](#Docker))

N'oubliez pas de lancer la commande 

```bash
php vendor/bin/doctrine orm:schema-tool:create
```

Si jamais, le fichier suivant contient le code nécessaire à la création de la BDD.

```bash
/scripts/memory.sql
```

## Composer

[Composer](https://getcomposer.org/) est utilisé dans ce projet. Il faut donc, après l'avoir installé localement, générer les fichiers nécessaires grâce à la commande 

```bash
composer install
```

## Docker

Je n'ai malheureusement pas réussi à venir à bout d'un déploiement Docker complet. Il y a une configuration d'host pour le service mysql que je n'arrive pas à trouver et lorsqu'on lance la commande :

```bash
docker-compose up -d
```

, les différentes images se montent bien dans mon container, mais la liaison avec la BDD n'est pas fonctionnelle. 
