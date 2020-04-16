Projet Symfony - Blog
=====================

[Suivez moi sur twitch](https://www.twitch.tv/toham)
---------------------

Pré-requis :
* PHP 7.4
* MySQL

Installation
------------

Dans un premier temps, cloner le repository : `git clone https://github.com/TBoileau/blog`

Pensez à créer votre fichier pour votre environnement de développement `.env.dev.local` :
```dotenv
DATABASE_URL=mysql://USER:PASSWORD@127.0.0.1:3306/DBNAME
```

Puis executer le script `composer prepare` pour créer la base de données et intérgrer les fixtures.

Episode 1
---------

* Installation de Symfony
* Implémentation des entités `Post` et `Comment`
* Création de notre première page
* Implémentation des fixtures
* Création d'un script `composer` pour recharger notre base de données
* Listing des articles en pages d'accueil
* Page de détail d'un article
* Listing des commentaires
* Formulaire d'ajout d'un commentaire

Episode 2
---------

* CRUD des articles
* Upload d'une image
* Implémentation d'un service pour faciliter l'upload

Episode 3
---------

* Implémentation de l'entité `User`
* Configuration de `security.yaml`
* Implémentation du `WebAuthenticator`
* Création de la page de login
* Ajout de fixtures
* Modification des entités `Post` et `Comment` (ajout de la relation avec l'user)

Episode 4
---------

* Refactoring de la pagination

Episode 5
---------

* Implémentation des `Handler`
* Implémentation des `Responder` et `Presenter`
* Implémentation des `DataTransferObject`
* Implémentation des `EventSubscriber`
* Découpage de l'application en `Application`, `Infrastructure` et `Domain`

Episode 6
---------

* Implémentation des tests fonctionnels