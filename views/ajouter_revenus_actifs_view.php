<?php include_once 'includes/header.php';?>

      
        <?php 



            if  ( isset($_GET['type']) and !empty($_GET['type']) )  { }

            if  ( isset($_GET['cash_initial']) )  {
//                print_r($_GET['cash_initial']);
//                exit;
                ?>
                <form class="form-horizontal" action="index.php?page=etat_financier" method="post">
                    <div class="container">
                        <div class="blog-header" style="text-align:center;">
                            <h1 class="blog-title">Ajouter votre cash initial</h1>
                        </div> <hr>

                        <!-- Formulaire d'ajout d'une dépense -->
                        <div class="row">
                            <div class="col-sm-8 blog-main">
                                <div class="blog-post" style="box-shadow:0px 0px 10px #888888; background-color:#f5f5f5;padding:2%;">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Argent possédé</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="cash_initial" class="form-control" placeholder="0.00€" required>
                                        </div>
                                    </div>
                                    
                                    
                                </div><!-- /.blog-post Formulaire principale -->
                                <hr>
                                <p>Pour remettre à zéro, taper <strong><em>00</em></strong> dans le champ</p>
                                <hr>
                            </div><!-- /.blog-main -->
                            
                            <!--Boutton Ajouter-->
                            <div class="center-block">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-5">
                                            <!--div class="col-sm-offset-2 col-sm-10"-->
                                            <button type="submit" class="btn btn-lg btn-primary btn-block"
                                            title="Ajouter-un-revenu-actif" >Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </form>

                <?php
            
            }

            else    {
                ?>
                <form class="form-horizontal" action="index.php?page=etat_financier" method="post">
                    <div class="container">
                        <div class="blog-header" style="text-align:center;">
                            <h1 class="blog-title">Ajouter une ligne de revenu actif</h1>
                        </div> <hr>

                        <!-- Formulaire d'ajout d'une dépense -->
                        <div class="row">
                            <div class="col-sm-8 blog-main">
                                <div class="blog-post" style="box-shadow:0px 0px 10px #888888; background-color:#f5f5f5;padding:2%;">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nom de l'activité</label>
                                        <div class="col-sm-10">
                                            <textarea name="nom_activite" class="form-control" rows="2" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Salaire net reçu</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="salaire_net" class="form-control" placeholder="0.00€" required>
                                        </div>
                                    </div>
                                    
                                    
                                </div><!-- /.blog-post Formulaire principale --><hr>
                            </div><!-- /.blog-main -->
                            <!--Ajout des liens sur le côté-->
                            <div class="col-sm-3 col-sm-offset-1 blog-sidebar" style="text-align:center;box-shadow:0px 0px 10px #888888; background-color:#f5f5f5;padding:2%;">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fréquence</label>
                                    <select name="frequence" class="form-control">
                                      <option>Par mois</option>
                                      <option>Par semaine</option>
                                      <option>Par jour</option>
                                      <option>Par heure</option>
                                      <option>Par séance</option>
                                    </select>
                                </div>
                            </div><!-- /.blog-sidebar Ajout liens--><hr>

                            <!--Boutton Ajouter-->
                            <div class="center-block">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-5">
                                            <!--div class="col-sm-offset-2 col-sm-10"-->
                                            <button type="submit" class="btn btn-lg btn-primary btn-block"
                                            title="Ajouter-un-revenu-actif" >Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </form>

                <?php
            }
        ?>

<?php
/*Nettoyage des variables GET et POST */
//$_GET=array();
//$_POST=array();
?>


<!--Le pied de page--><?php include_once 'includes/footer.php';?>