<!--Récupération de tous les prénoms des membres pour vérifier les identifiants-->
<?php
    /* Démarre la session */

    $_SESSION = array();
    $lesMembres = $db->query('SELECT Prenom,Mot_de_passe FROM utilisateurs');
?>

