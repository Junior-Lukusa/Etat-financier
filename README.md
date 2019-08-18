# etat-financier
Suivre l'évolution des des dépenses financières quotidiennes et établir un bilan financier

## Avant de commencer

Vous devez héberger cette application web sur un serveur en ligne.

Ce serveur doit vous permettre **d'exécuter PHP** et d'avoir accès à **phpmyadmin**.

Vous aurez besoin, pour la configuration, d'avoir :

*   le nom du serveur hôte
*   le nom de la base de données
*   le nom de l'utilisateur
*   le mot de passe

* * *

Cette version est faite pour un utilisateur unique. Si vous voulez un espace avec plusieurs utilisateurs, il faudra mettre en place la gestion de plusieurs utilisateurs et faire des jointures de table sql.

## Insertion des tables nécessaires au fonctionnement dans la base de donnée

Accéder à votre base de données via phpmyadmin, puis **importer les 5 tables** qui se trouvent dans le dossier **table_base_donnees**.

Ces tables sont :

*   credits
*   note_des_depenses
*   revenus_actifs
*   users_parameters
*   utilisateurs

## Configuration de la table **utilisateurs**

Si vous passez cette étape, il va falloir retenir que les **identifiants de connexion par défaut** sont :

*   Prenom : **Junior**
*   Mot de passe : **D0m0@**

Sinon, accédez à la table **utilisateurs** via **phpmyadmin** et modifier ces champs avec vos propres informations

## Configuration du fichier **config**

Une fois que vous auree téléchargé les sources, il faudra modifier les informations relatives à la base de données dans le fichier : **_config/config.php**.

En bas du fichier vous verrez :

<pre>        // DataBase informations
        define("DATABASE_HOST", "nom.hote");
        define("DATABASE_NAME", "nom_base_de_donnees");
        define("DATABASE_USER", "nom_utilisateur");
        define("DATABASE_PASSWORD", "mot_de_passe");
    </pre>

Prenez le temps de remplacer "nom.hote", "nom_base_de_donnees" , "nom_utilisateur" et "mot_de_passe"