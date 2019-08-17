<?php

/*
Pour vérifier si les pages demandées existent sinon afficher une page d'erreur
*/

/*On va appeler toutes les fonctions et les  configurations dans toutes les pages du sites*/
require_once '_config/config.php';
require_once '_functions/functions.php';

if ($_SESSION == array()){
    $page = "identification";
}elseif(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}elseif (isset($_POST['page']) && !empty($_POST['page'])){
    $page = $_POST['page'];
}else{
    //$page = "ajouter_une_depense";
    $page = "identification";
}

$page = strtolower($page);
$allpages = scandir('controllers/');


if(in_array($page."_controller.php",$allpages)){
    require_once '_config/db.php';
    include_once 'controllers/'.$page.'_controller.php';    
}else{
    include_once 'controllers/error_controller.php';
}
?>