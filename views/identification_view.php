<!DOCTYPE html>
<html>

<head>
    <title><?= ucfirst($page) . " - " . WEBSITE_NAME?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?= WEBSITE_AUTHOR?>">
    <meta name="description" content="<?= WEBSITE_DESCRIPTION?>" />
    <meta name=”keywords” content="<?= WEBSITE_KEYWORDS?>"/>
    <meta name="Reply-to" content="<?= WEBSITE_AUTHOR_MAIL?>">
    <meta name="Copyright" content="<?= WEBSITE_AUTHOR?>">
    <meta name="Language" content="<?= WEBSITE_LANGUAGE?>">
    <meta http-equiv="Content-Language" content="<?= WEBSITE_LANGUAGE?>">

    <!-- Fonts & Favicon -->
    <!-- Font Roboto de Google-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,300italic,700,500italic,400italic,900' rel='stylesheet' type='text/css'>

    <!-- Font Raleway de Google-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,300,300italic,700,500italic,400italic,900' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="assets/styles/css/bootstrap.css"/>



    <!-- CSS Styles -->

    <!-- Open Graph tags -->
    <meta property="og:type"              content="website" />
    <meta property="og:url"               content="" />
    <meta property="og:title"             content="" />
    <meta property="og:description"       content="" />

    <!-- Open Graph tags -->
    <meta property="og:type"              content="website" />
    <!--meta property="og:url"               content="<?= WEBSITE_FACEBOOK_URL?>" /-->
    <meta property="og:title"             content="<?= WEBSITE_FACEBOOK_NAME?>" />
    <meta property="og:description"       content="<?= WEBSITE_FACEBOOK_DESCRIPTION?>" />


    <!-- Cette dernière balise permettra de partager une image de prévisualisation dans le site vers où ce fait le partage-->
    <meta property="og:image"             content="" />

    <style>
        
        body {
          padding-top: 100px;
          padding-bottom: 40px;
          background-color: #fff;
        }

        .form-signin {
          max-width: 350px;
          padding: 15px;
          margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
          margin-bottom: 10px;
        }
        .form-signin .checkbox {
          font-weight: normal;
        }
        .form-signin .form-control {
          position: relative;
          height: auto;
          -webkit-box-sizing: border-box;
             -moz-box-sizing: border-box;
                  box-sizing: border-box;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
        
        h1
        {
            color:#337ab7;
        }
        
        #conteneur_login
        {*/
            border-radius: 10px/ 10px;		
            box-shadow : 0px 0px 10px #888888;		
            display:flex;
            flex: 1;
            flex-direction:column;
            justify-content:space-around;
            background-color: #f5f5f5;
            max-width: 600px;
            min-height: 300px;
        }
    </style>

    
</head>

<body>

<div class="container"> 

<script src="http://code.jquery.com/jquery-2.1.0.js"></script>




<?php
    chdir('_classes');
    $files1 = scandir(getcwd());
//    print_r($files1);
    require_once getcwd().'/'.$files1[2];
//    require_once 'Identification';
        //include_once
?>
<div class="container-fluid" id="conteneur_login">

<form class="form-signin" method="POST" id="formulaire_de_connection">
<h1 class="form-signin-heading" style="text-align:center">Veuillez vous identifier</h1>
<label for="inputEmail" class="sr-only">Identifiant :</label> <!--for oriente vers l'id qui a la meme valeur-->
<input type="text" id="inputEmail" class="form-control" name="identifiant" placeholder="Identifiant" required autofocus>
<label for="inputPassword" class="sr-only">Mot de passe: </label>
<input type="password" id="inputPassword" class="form-control" name="motdepasse" placeholder="Mot de passe" required>
<div class="checkbox">

</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">OK</button>
</form>				
<?php 
//    chdir('_classes');
    $files1 = scandir(getcwd());
//    echo '<pre>';
//    echo getcwd().'/'.$files1[3];
    require_once getcwd().'/'.$files1[3];
    
    
//    require_once'_classes/identification_validation.php'
    
?>

</div> <!-- /container -->
    
    
</div>
    
</body>

</html>

<!-- Scripts -->
<!-- Jquery -->
<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.js"></script>