<?php
/*	Comment empêcher les visiteurs de naviguer dans les pages du sites sans avoir été identifiés	*/
if ($_SESSION == array())
{
    ?>
    <script>alert("Veuillez vous connecter pour accéder au contenu!")</script>

    <?php
	//$_SESSION = array();	//Cette commande réinitialise l'array SESSION, en la vidant.
	header('Location: index.php?page=identification');	//Cette commande permet de rediriger l'utilisateur vers une page.
	exit();
}
?>