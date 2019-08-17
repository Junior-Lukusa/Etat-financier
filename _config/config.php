<?php

//On définie ici des paramètre qui permettrons de gérer le site dans sa globalité


// --------------------------- //
// ---   ERRORS DISPLAY   ---- //
// --------------------------- //

//!\\ A enlever lors du déploiement

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);


// --------------------------- //
// ------   SESSIONS   ------- //
// --------------------------- //

session_start();
ini_set('session.cookie_lifetime', false); /*Pour prolonger la durée de vie des sessions*/


// --------------------------- //
// -----   CONSTANTS   ------- //
// --------------------------- //

// Paths
define("PATH_REQUIRE", substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // Pour fonctions d'inclusion php
define("PATH", substr($_SERVER['PHP_SELF'], 0, -9)); // Pour images, fichiers etc (html) qui seront visibles pour les utilisateurs

// Author informations
define("WEBSITE_AUTHOR", "Votre nom");
define("WEBSITE_AUTHOR_MAIL", "votre@email.com");

// Website informations
define("WEBSITE_TITLE", "Etat Financier!");
define("WEBSITE_NAME", "Etat Financier");
//define("WEBSITE_URL", "https://website.com");
define("WEBSITE_DESCRIPTION", "Donner une description, celle que vous voulez à ce site");
define("WEBSITE_KEYWORDS", "choisir, des, mots, clés, et, les, mettre, ici");
define("WEBSITE_LANGUAGE", "fr");

// Facebook Open Graph tags
define("WEBSITE_FACEBOOK_NAME", WEBSITE_NAME);
define("WEBSITE_FACEBOOK_DESCRIPTION", WEBSITE_DESCRIPTION);
//define("WEBSITE_FACEBOOK_URL", WEBSITE_URL);



// DataBase informations
define("DATABASE_HOST", "nom.hote");
define("DATABASE_NAME", "nom_base_de_donnees");
define("DATABASE_USER", "nom_utilisateur");
define("DATABASE_PASSWORD", "mot_de_passe");

