<!DOCTYPE html>
<html>
<head>
    <title><?= ucfirst($page) . " - " . WEBSITE_NAME?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?= WEBSITE_AUTHOR?>">
    <meta name="description" content="<?= WEBSITE_DESCRIPTION?>" />
    <meta name=”keywords” content="<?= WEBSITE_KEYWORDS?>"/>
    <meta name="Reply-to" content="<?= WEBSITE_AUTHOR_MAIL?>">
    <meta name="Copyright" content="<?= WEBSITE_AUTHOR?>">
    <meta name="Language" content="<?= WEBSITE_LANGUAGE?>">
    <meta http-equiv="Content-Language" content="<?= WEBSITE_LANGUAGE?>">

    
    <!-- Scripts -->
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.js"></script>

    
    <!-- Font Raleway de Google-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,300,300italic,700,500italic,400italic,900' rel='stylesheet' type='text/css'>
    
    <!-- Font bootstrap-->
    <link rel="stylesheet" href="assets/styles/fonts/glyphicons-halflings-regular.svg"/>
    
    
    <link rel="stylesheet" href="assets/styles/css/bootstrap.css"/>
    <link rel="stylesheet" href="assets/styles/css/carousel.css"/>
    <link rel="stylesheet" href="assets/styles/css/dashbord.css"/>
    <link rel="stylesheet" href="assets/styles/css/detail.css"/>
    
    <!--css jquery-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    


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
        
        
    <meta property="og:image"             content="" />

    <style>
		html
		{
            position: relative;
            min-height: 100%;
		}
		
		body
		{
            height:inherit;
            padding-top: 90px;
            padding-bottom: 90px;
	        background-color: #fff;
		}
        
        p
        {
            text-align : justify;	
        }
        
        h1
        {
            color:#337ab7;
        }
        
        div
        {
            border-radius: 5px/ 5px;
        }

        .mySlides {display:none}
        .w3-left, .w3-right, .w3-badge {cursor:pointer}
        .w3-badge {height:13px;width:13px;padding:0}
        
        .footer 
        {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f5f5f5;
            box-shadow:0px 0px 10px #888888;
        }


	</style>

    
</head>
    
<body>
    <noscript>
    <div class="container marketing" style="background-color:white">
        <p>Votre navigateur n'est pas en mesure d'exécuter du code <strong>JavaScript</strong>, ce qui ne vous permet pas de profiter de toutes les fonctionnalités de ce site et d'une expérience utilisateur optimale. Pour mettre à jour votre navigateur ou savoir comment le configurer pour activer JavaScript, veuillez consulter ce site internet: <a href="http://www.enable-javascript.com/fr/">Comment activer JavaScript dans votre navigateur</a>
        </p>
    </div>  <hr>
    </noscript>
    
    <div class="container-fluid" >
    <?php require_once 'views/includes/nav.php';?>
    </div>
    
    <div class="container-fluid"> 