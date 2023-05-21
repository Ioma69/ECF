# ECF Quai Antique 2023 STUDI

## Lien vers le trello : [Trello](https://trello.com/b/pGkhreB8/ecf-quai-antique-sariel-raquin)


1. Clôner le dépôt : git clone <URL_DU_DÉPÔT>
2. Dans le répertoire, taper **composer install**, pour installer les dépendances nécessaires au projet.
3. Ensuite **php bin/console doctrine:database:create**, pour créer la base de données.
4. Puis **php bin/console doctrine:migrations:migrate**, pour insérer les tables nécessaires au projet.
5. Et enfin **php bin/console doctrine:fixtures:load**, afin d'avoir des entrées dans la base de données, a savoir les identifiants admins et users.
6. Lancer le serveur : Démarrez le serveur Symfony en utilisant la commande suivante : **php bin/console server:start**
7. Accéder à l'application : Ouvrez votre navigateur et accédez à l'URL http://localhost:8000 pour accéder à l'application Symfony.
