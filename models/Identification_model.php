<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width" charset = "UTF-8"/>
		<title>Identification</title>		
	</head>
	
	
	<style>
		html
		{
			height:100%;
		}
		
		body
		{
			display:flex;
			flex-direction:column;
			justify-content: space-around;
		}
		
	</style>
	<body>
		<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
		
		<!--Récupération de tous les prénoms des membres pour vérifier les identifiants-->
		<?php
			//Variable qui permettra d'aller lire la base de données selon les requetes qui seront effectuées
			$baseDeDonneesMembres = new PDO('mysql:host=localhost;dbname=etat_financier','root','22php33', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			
			//Requete SQL qui récupère toutes les donnés de la table membres.
			$lesMembres = $baseDeDonneesMembres->query('SELECT Prenom,Statut FROM membres ORDER BY Prenom');
			
			//Affichage des données qui va s'exécuter tant qu'il y aura des données dans la table (fetch passe à une nouvelle ligne à chaque fois)
			//Une nouvelle variable va récupérer les résultats de cette requete
		?>
		
		<div style="float:center; text-align:center; margin:auto; flex:1">
			<h1>Entrez vos identifiants pour accéder au carnet de chants</h1>
				<form action ="Identification.php" method="POST" id="formulaire_de_connection">  <!--action ="adresse d'envoi de donnée" method="de quelle façon: GET ou POST"-->
					<p><label>Identifiant: <input type="text" id="identifiant" name="identifiant" placeholder="prénom, nom, etc" required /></label></p>
					<!--id		(prénom récupéré via la liste des membres du groupe -- Ne pas tenir compte de la casse ni les accents)-->
					<p><label>Mot de passe: <input type="password" id="motdepasse" name="motdepasse" required  /></label></p>
					<!--motDePasse	(identique pour tout le monde : "1835LaPlaine"	. Enregistré pour la session)-->
					<!--p><label>Clé de connexion: <input type="text" id="cle" name="cle" placeholder="Code fourni par l'Administrateur" width ="device-width" /></label></p-->
					<!--clé		(donnée par sms au membre qui souhaite se connecté. Demande formulée en amont. En faire un cookie)
						à modifier de façon dynamique.-->
					<p><input type="submit" value="OK"/></p>
				</form>
				
				<?php
					//Vérification de l'envoi du formulaire
					if (isset($_POST['identifiant']) AND isset($_POST['motdepasse']))
					{
						echo '<p>Vous avez tapé "'.$_POST['identifiant'].'" comme identifiant et "'.$_POST['motdepasse'].'" comme mot de passe.</p>';
						//Vérification des données rentrées par l'utilisateur
						echo 'Est-ce que vous êtes membres?';
						
						//Vérification de la présence du visiteur dans la bdd
						$membre = 0;		//Membre dit si le visiteur est un membre (1) ou pas (0)
						while ($lesPrenomsDesMembres = $lesMembres -> fetch())
						{
							
							if ($_POST['identifiant'] == $lesPrenomsDesMembres['Prenom'] AND $_POST['motdepasse'] == '200')
							{
								/*header('Location: Accueil.php');	//Cette commande permet de rediriger l'utilisateur vers une page.
								exit();*/
								//echo '<p>'.$lesPrenomsDesMembres['Prenom'].' c\'est vous</p>';
								$_SESSION['prenom'] = $_POST['identifiant'];
								$membre = 1;
							}							
						}
						
						//echo 'lesMembres = '; print_r($lesMembres['Prenom']);
					}
					
					//Donner l'accès si visiteur = membres
					
					
					if (isset($membre))
					{
						if ($membre == 1)
						{
							echo '<p>OUI!<br />Vous pouvez alors accéder au Carnet de chant</p>';
							//Faire Session Start 
							/*  $_Session['prenom'] = $_POST['identifiant'] */
							?>
							<script>
								$("#formulaire_de_connection").fadeOut(1);
							</script>
							<form action="Accueil.php" method="POST">
								<input type="submit" value="Accéder"/>
							</form>
							
							<?php
							
						}
						else
						{
							echo '<p>NON!<br />Vous ne pouvez pas avoir accès au Carnet de chant,<br />Car vous n\'êtes pas membres de ce groupe.</p>';
						}
							
					}
					
				?>
			<?php	echo '<p></p>$_POST '; print_r($_POST);	?>
			<?php	echo '<p></p>$_SESSION '; print_r($_SESSION);	?>
		</div>

		<h3>Ce site est réservé aux membres du groupe de jeune 18/35 de La Plaine Saint Denis</h3>


	</body>
</html>
