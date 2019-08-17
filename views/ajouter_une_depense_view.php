<?php include_once 'includes/header.php';?>

      
        <?php 


            if  ( isset($_GET['type']) and !empty($_GET['type']) )  { 
                echo '<div class="container">
                        <div class="blog-header" style="text-align:center;">
                            <h1 class="blog-title">Choisir ou ajouter une catégorie</h1>
                        </div> <hr>';
                echo '<div class="list-group">';
                
                if ( $_GET['type']=='Fixe') {
                    $depenses_fixes = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Fixe" ORDER BY categories');
                    while ($depense_fixe = $depenses_fixes -> fetch()) {
                        echo '<a href="index.php?page=consulter_les_depenses&amp;description='.$_GET['description'].'&amp;montant='.$_GET['montant'].'&amp;credit='.$_GET['credit'].'&amp;type=Fixe&amp;categorie='.$depense_fixe['categories'].' ">';    
                            echo '<button type="button" class="list-group-item">';
                                echo $depense_fixe['categories'];
                            echo '</button>';
                        echo '</a>';
                    }
                }
                
                else if ( $_GET['type']=='Variable') {
                    $depenses_variables = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Variable" ORDER BY categories');
                    while ($depense_variable = $depenses_variables -> fetch()) {
                        echo '<a href="index.php?page=consulter_les_depenses&amp;description='.$_GET['description'].'&amp;montant='.$_GET['montant'].'&amp;credit='.$_GET['credit'].'&amp;type=Variable&amp;categorie='.$depense_variable['categories'].' ">';
                            echo '<button type="button" class="list-group-item">';
                                echo $depense_variable['categories'];
                            echo '</button>'; 
                        echo '</a>';
                    }
                }
                
                else if ( $_GET['type']=='Autre') {
                    $depenses_autres = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Autre" ORDER BY categories');
                    while ($depense_autre = $depenses_autres -> fetch()) {
                        echo '<a href="index.php?page=consulter_les_depenses&amp;description='.$_GET['description'].'&amp;montant='.$_GET['montant'].'&amp;credit='.$_GET['credit'].'&amp;type=Autre&amp;categorie='.$depense_autre['categories'].' ">';    
                            echo '<button type="button" class="list-group-item">';
                                echo $depense_autre['categories'];
                            echo '</button>'; 
                        echo '</a>';
                    }
                }
                       
                echo '</div>';
                echo '<hr>';
                echo '<div class="list-group">';
                
                            
                        echo '<div>
                            
                            <form method="post" action="index.php?page=consulter_les_depenses&amp;description='.$_GET['description'].'&amp;montant='.$_GET['montant'].'&amp;credit='.$_GET['credit'].'&amp;type='.$_GET['type'].'">
                                <input type="text" name="categorie_a_ajouter" class="form-control" placeholder="Ajouter une catégorie" required>
                                <button type="submit" class="btn btn-lg btn-primary btn-block" title="Ajouter-une-categorie" >Ajouter</button>
                            </form>
                            
                            </div>
                        </div>';
                
                echo '</div>';  
                
                echo '</div>';
                
            
            }
            

            else if ( (isset($_POST['description']) and !empty($_POST['description']))  and (isset($_POST['montant']) and !empty($_POST['montant'])) and (isset($_POST['credit']) and !empty($_POST['credit'])) ) {
                
                ?>

                <div class="container">
                    <div class="blog-header" style="text-align:center;">
                        <h1 class="blog-title">Choisir un type</h1>
                    </div> <hr>


                    <!--Dépense Fixe Variable ou Autre-->
                    <div class="center-block">
                        <div class="container-fluid">
                            <div class="form-group">
                <!--                <div class="col-sm-3 col-sm-5">-->
                                    <div class="col-sm-offset-1 col-sm-10">
                                    <a <?php echo 'href="index.php?page=ajouter_une_depense&amp;description='.$_POST['description'].'&amp;montant='.$_POST['montant'].'&amp;credit='.$_POST['credit'].'&amp;type=Fixe"' ; ?>
                                       style="margin:2em 2em 2em -1em" type="submit" class="btn btn-lg btn-primary btn-block" >Fixe</a>

                                    <a <?php echo 'href="index.php?page=ajouter_une_depense&amp;description='.$_POST['description'].'&amp;montant='.$_POST['montant'].'&amp;credit='.$_POST['credit'].'&amp;type=Variable"'; ?>
                                       style="margin:2em 2em 2em -1em" type="submit" class="btn btn-lg btn-success btn-block" >Variable</a>

                                    <a <?php echo 'href="index.php?page=ajouter_une_depense&amp;description='.$_POST['description'].'&amp;montant='.$_POST['montant'].'&amp;credit='.$_POST['credit'].'&amp;type=Autre"'; ?>
                                       style="margin:2em 2em 2em -1em" type="submit" class="btn btn-lg btn-danger btn-block" >Autre</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>



                <?php
                
            }

            else    {
                ?>
                <form class="form-horizontal" action="#" method="post">
                    <div class="container">
                        <div class="blog-header" style="text-align:center;">
                            <h1 class="blog-title">Noter une dépense</h1>
                        </div> <hr>

                        <!-- Formulaire d'ajout d'une dépense -->
                        <div class="row">
                            <div class="col-sm-8 blog-main">
                                <div class="blog-post" style="box-shadow:0px 0px 10px #888888; background-color:#f5f5f5;padding:2%;">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" rows="2" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Montant</label>
                                        <div class="col-sm-10">
                                            <input type="number" step="0.01"  name="montant" class="form-control" placeholder="0.00€" required>
                                        </div>
                                    </div>
                                </div><!-- /.blog-post Formulaire principale --><hr>
                            </div><!-- /.blog-main -->
                            <!--Ajout des liens sur le côté-->
                            <div class="col-sm-3 col-sm-offset-1 blog-sidebar" style="text-align:center;box-shadow:0px 0px 10px #888888; background-color:#f5f5f5;padding:2%;">
                                

                            <div class="radio">
                              <label>
                                <input type="radio" name="credit" id="credit1" value="Non" checked>
                                <strong>Ce n'est pas un crédit</strong>
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="credit" id="credit2" value="Oui">
                                <strong>c'est un crédit</strong>
                              </label>
                            </div>
                                
<!--                              <label class="col-sm-2 control-label">Est-ce un crédit ?</label>-->
                                
                                
                                
                            </div><!-- /.blog-sidebar Ajout liens--><hr>

                            <!--Boutton Ajouter-->
                            <div class="center-block">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-5">
                                            <!--div class="col-sm-offset-2 col-sm-10"-->
                                            <button type="submit" class="btn btn-lg btn-primary btn-block"
                                            title="Ajouter-une-depense" >Ajouter</button>
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



<!--Le pied de page--><?php include_once 'includes/footer.php';?>