<?php
					//Vérification de l'envoi du formulaire
					if (isset($_POST['identifiant']) AND isset($_POST['motdepasse']))
					{

						$membre = 0;		//Membre dit si le visiteur est un membre (1) ou pas (0)
						while ($lesPrenomsDesMembres = $lesMembres -> fetch())
						{
                            
							//Vérifier si l'identifiant correspond à un membre et s'il a entré le bon mot de passe
							if ($_POST['identifiant'] == $lesPrenomsDesMembres['Prenom'] AND $_POST['motdepasse'] == $lesPrenomsDesMembres['Mot_de_passe'])
							{
								$_SESSION['prenom'] = $_POST['identifiant'];
								$membre = 1;
							}							
						}

					}
					
					
					if (isset($membre))
					{
						if ($membre == 1)
						{
							?>
							<script>
								$("#formulaire_de_connection").fadeOut(1);
							</script>

                            <h3 class="bg-info" style="text-align:center">Salut <?php echo $_SESSION['prenom']?>!</h3>
                            
							<form action="index.php?page=etat_financier" method="POST">
                                <button class="btn btn-lg btn-primary btn-block" type="submit" value="Accéder">Etat Financier</button>
							</form>
							<form action="index.php?page=identification" method="POST">
                                <button class="btn btn-lg btn-danger btn-block" type="submit" value="Accéder">Annuler</button>
							</form>
							
							<?php
							
						}
						else
						{
                            ?>
                            <h4 class="bg-danger" style="text-align:center">Vous n'êtes pas autorisé à y accéder.</h4>
                            <?php

						}
							
					}
					
				?>