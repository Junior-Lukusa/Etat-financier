<?php include_once 'includes/header.php';?>                  


<div class="container-fluid">
    <?php

    
    /*Initialisation du cash*/
    if ( isset($_POST['cash_initial']) and !empty($_POST['cash_initial']) ) {
        

        $total_Rev= $db->query('SELECT SUM(cumul) FROM revenus_actifs');
        $total_r = $total_Rev -> fetch();

        $total_Dep= $db->query('SELECT SUM(montant) FROM note_des_depenses');
        $total_d = $total_Dep -> fetch();
        
        
        $maj = $db->prepare('UPDATE users_parameters SET cash = (?) WHERE users_parameters.user_id = 1');
        $_POST['cash_initial'] = $_POST['cash_initial'] - ($total_r[0] - $total_d[0]);
        $maj -> execute(array($_POST['cash_initial']));
    }
    
    
    
    
    
    /*Accumulation des revenus*/
    
    if ( isset($_GET['id_cumul']) and !empty($_GET['id_cumul']) ) {
        
        $maj = $db->prepare('UPDATE revenus_actifs SET cumul = (?) WHERE revenus_actifs.id = (?)');
        $_GET['cumul'] = $_GET['cumul'] + $_GET['salaire_net'];
        $maj -> execute(array($_GET['cumul'], $_GET['id_cumul'] ));
        
    }
    
    
    /*Suppression d'une ligne dans la colonne des actifs
        Alerte permettant d'annuler la suppression*/
    if ( isset($_GET['id_suppr']) and !empty($_GET['id_suppr']) ) {
    
        $rev_actif_ASuppr = $db->query('SELECT * FROM revenus_actifs WHERE id='.$_GET['id_suppr']);
        $revSuppr = $rev_actif_ASuppr -> fetch();

        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Attention!</strong> Suppression de :<hr>
                    <p>Description : '.$revSuppr['description'].'</p>
                    <p>Salaire net : '.$revSuppr['revenu'].'€</p>
                    <p>Fréquence : '.$revSuppr['frequence'].'</p>
                    <p>Accumulé durant ce mois : '.$revSuppr['cumul'].'€</p>
                    <hr>
                    <a href="index.php?page=etat_financier&amp;nom_activite='.$revSuppr['description'].'&amp;salaire_net='.$revSuppr['revenu'].'&amp;frequence='.$revSuppr['frequence'].'&amp;date='.$revSuppr['date'].'&amp;cumul='.$revSuppr['cumul'].'&amp;id='.$revSuppr['id'].'
                    " class="btn btn-danger"><strong>Rajouter</strong></a>

              </div>';


        $suppression_rev = $db->prepare('DELETE FROM  revenus_actifs WHERE revenus_actifs.id=(?)');
        $suppression_rev -> execute(array($_GET['id_suppr']));

    }
    
    /*Ajout d'une nouvelle ligne dans la colonne des actifs*/
    if ( isset($_POST['nom_activite']) and !empty($_POST['nom_activite']) ){
        
        $_POST['cumul']=0;
        
        $nouv_rev_actif= $db->prepare('INSERT INTO revenus_actifs(date,description,revenu,frequence,cumul) VALUES(CURRENT_TIMESTAMP,?,?,?,?)');
        $nouv_rev_actif -> execute(array($_POST['nom_activite'],$_POST['salaire_net'],$_POST['frequence'],0));
        
        
        $ligneAjoutee = $db->query('SELECT * FROM revenus_actifs WHERE description="'.$_POST['nom_activite'].'"');
        $ajout = $ligneAjoutee -> fetch();

        echo '<div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Alerte! Revenus Actifs</strong>
                    <p>Nouvelle ligne dans la colonne des revenus actifs</p><hr>
                    <p>Description : '.$ajout['description'].'</p>
                    <p>Salaire net : '.$ajout['revenu'].'</p>
                    <p>Fréquence : '.$ajout['frequence'].'</p>
                    <hr>';
//                    <!--a href="index.php?page=consulter_les_depenses&amp;description='.$depSuppr['description'].'&amp;montant='.$depSuppr['montant'].'&amp;type='.$depSuppr['types'].'&amp;categorie='.$depSuppr['categories'].'&amp;date='.$depSuppr['date'].'&amp;id='.$depSuppr['id'].'" class="btn btn-danger"><strong>Erreur</strong></a-->
                echo '<button type="button" class="btn btn-primary" data-dismiss="alert" aria-label="Close">OK</button>
                    <a href="#" class="btn btn-danger"><strong>Erreur</strong></a>

              </div>';

    }
    
    
    /*Possibilité de rajouter si suppression par erreur*/
    if ( isset($_GET['nom_activite']) and !empty($_GET['nom_activite']) ){
        $nouv_rev_actif= $db->prepare('INSERT INTO revenus_actifs(date,description,revenu,frequence,cumul) VALUES(CURRENT_TIMESTAMP,?,?,?,?)');
        $nouv_rev_actif -> execute(array($_GET['nom_activite'],$_GET['salaire_net'],$_GET['frequence'],$_GET['cumul']));

        echo '<div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Alerte! Suppression Annulée</strong>
            <hr>';
        echo '<button type="button" class="btn btn-primary" data-dismiss="alert" aria-label="Close">OK</button>
      </div>';

    }

    ?>
    
    
    
    <div class="blog-header">
        <h1 class="blog-title" style="text-align:center">Compte de résultat</h1><hr>
    </div>

        <div class="row">
        <div id="card-principale" class="col-sm-8" style="/*border: 1px solid black*/">
            <h2 style="text-align:center">Revenus</h2>
            <div class="container-fluid" id="revenus">
                <p><strong>Actifs</strong></p>


                <?php

                    $Tous_revenus_actifs = $db->query('SELECT * FROM revenus_actifs  ORDER BY id');

            echo '<div class="panel panel-default">  
                <!-- Default panel contents -->
                <!-- Table -->
                <span onclick="cacher()" id="derouleur_revenu_cacher" style="float:right" class="glyphicon glyphicon-chevron-up"></span><span onclick="decouvrir()" id="derouleur_revenu_decouvrir" style="float:right" class="glyphicon glyphicon-chevron-down"></span>
                <table class="table">';
                echo '<tr><td></td>  <td><strong>Description</strong></td>  <td><strong>Cashflow</strong></td></tr>';
            while ($le_revenu_actif = $Tous_revenus_actifs -> fetch()) {


                    echo '<tr class="ligne_de_revenu">';
                        echo '<td>';
                            echo '<div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="index.php?page=etat_financier&amp;id_cumul='.$le_revenu_actif['id'].'&amp;salaire_net='.$le_revenu_actif['revenu'].'&amp;cumul='.$le_revenu_actif['cumul'].'">Ajouter <strong>'.$le_revenu_actif['revenu'].'</strong>€/'.$le_revenu_actif['frequence'].'</a></li>
                                        <li><a href="#">Modifier</a></li>
                                        <li><a href="index.php?page=etat_financier&amp;id_suppr='.$le_revenu_actif['id'].'">Supprimer</a></li>
                                      </ul>
                                 </div>';
                    echo '</td>';

                    echo '<td>'.$le_revenu_actif['description'].'</td>';

                    echo '<td>'.$le_revenu_actif['cumul'].'</td>';



                    echo '</tr>';

            }

                $total_revenus_actifs= $db->query('SELECT SUM(cumul) FROM revenus_actifs');
        //        print_r($total_depense);
                $total_rev_actif = $total_revenus_actifs -> fetch();
        //        print_r($total[0]);
        //        echo round($total[0]),2);
        //        exit;
                echo '<tr>  <td></td> <td><strong>Total </strong></td> <td><strong>'.round($total_rev_actif[0],2).'</strong></td></tr>';
          echo '</table>';
        echo '</div>';
                ?>

                <script>
                    $('#derouleur_revenu_decouvrir').fadeIn(1);
                    $('#derouleur_revenu_cacher').fadeOut(1);
                    $('.ligne_de_revenu').slideUp(50);
                    
                    function cacher(x){
                        $('#derouleur_revenu_cacher').fadeOut(1);
                        $('#derouleur_revenu_decouvrir').fadeIn(1);
                        $('.ligne_de_revenu').slideUp(50);
                    }
                    
                    function decouvrir(x){
                        $('#derouleur_revenu_cacher').fadeIn(1);
                        $('#derouleur_revenu_decouvrir').fadeOut(1);
                        $('.ligne_de_revenu').slideDown(500);
                    }
                </script>




                <p><strong>Passifs</strong></p> 
            </div>
            <br><hr>
            
            <h2 style="text-align:center">Dépenses</h2>
            <div class="container-fluid" id="depenses">
                <p><strong>Fixes</strong></p> 
                
                
                <?php

                    $Toutes_depenses_fixes = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Fixe"  ORDER BY categories');

            echo '<div class="panel panel-default">  
                <!-- Default panel contents -->
                <!-- Table -->
                <span onclick="cacher_dep_fixes()" id="derouleur_dep_fixes_cacher" style="float:right" class="glyphicon glyphicon-chevron-up"></span><span onclick="decouvrir_dep_fixes()" id="derouleur_dep_fixes_decouvrir" style="float:right" class="glyphicon glyphicon-chevron-down"></span>
                <table class="table">';
                echo '<tr><td></td>  <td><strong>Catégorie</strong></td>  <td><strong>Cashflow</strong></td></tr>';
            while ($la_depense_fixe = $Toutes_depenses_fixes -> fetch()) {


                    echo '<tr class="ligne_de_dep_fixes">';
                        echo '<td>';
                            echo '<div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                      $liste_dep_fix_cat = $db->prepare('SELECT date,description,montant FROM note_des_depenses WHERE types="Fixe" AND categories=? ORDER by date');
                                        $liste_dep_fix_cat -> execute(array($la_depense_fixe['categories']));
                                        while ($element_list = $liste_dep_fix_cat ->fetch()) {
                                        echo '<li><a>';
                                        echo $element_list['description'].' : <strong>'.round($element_list['montant'],2).'€</strong>';
                                        echo '</a></li>';
                                        }
                                        echo '</ul>
                                 </div>';
                    echo '</td>';

                    echo '<td>'.$la_depense_fixe['categories'].'</td>';
                
                    $total_dep_cate_f= $db->prepare('SELECT SUM(montant) FROM note_des_depenses WHERE categories=?');
                    $total_dep_cate_f->execute(array($la_depense_fixe['categories']));
                    $total_d_cat = $total_dep_cate_f -> fetch();
                    echo '<td>'.round($total_d_cat[0],2).'</td>';

                    echo '</tr>';

            }

                $total_dep_fixe= $db->query('SELECT SUM(montant) FROM note_des_depenses WHERE types="Fixe"');
                $total_d_fix = $total_dep_fixe -> fetch();
                echo '<tr>  <td></td> <td><strong>Total </strong></td> <td><strong>'.round($total_d_fix[0],2).'</strong></td></tr>';
          echo '</table>';
        echo '</div>';


                ?>
                
                
                <script>
                    $('#derouleur_dep_fixes_decouvrir').fadeIn(1);
                    $('#derouleur_dep_fixes_cacher').fadeOut(1);
                    $('.ligne_de_dep_fixes').slideUp(50);
                    
                    function cacher_dep_fixes(x){
                        $('#derouleur_dep_fixes_cacher').fadeOut(1);
                        $('#derouleur_dep_fixes_decouvrir').fadeIn(1);
                        $('.ligne_de_dep_fixes').slideUp(50);
                    }
                    
                    function decouvrir_dep_fixes(x){
                        $('#derouleur_dep_fixes_cacher').fadeIn(1);
                        $('#derouleur_dep_fixes_decouvrir').fadeOut(1);
                        $('.ligne_de_dep_fixes').slideDown(500);
                    }
                </script>



                <p><strong>Variables</strong></p> 
                
                <?php

                $Toutes_depenses_variables = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Variable" ORDER BY categories');

            echo '<div class="panel panel-default">  
                <!-- Default panel contents -->
                <!-- Table -->
                <span onclick="cacher_dep_variables()" id="derouleur_dep_variables_cacher" style="float:right" class="glyphicon glyphicon-chevron-up"></span><span onclick="decouvrir_dep_variables()" id="derouleur_dep_variables_decouvrir" style="float:right" class="glyphicon glyphicon-chevron-down"></span>
                <table class="table">';
                echo '<tr><td></td>  <td><strong>Catégorie</strong></td>  <td><strong>Cashflow</strong></td></tr>';
            while ($la_depense_variable = $Toutes_depenses_variables -> fetch()) {


                    echo '<tr class="ligne_de_dep_variables">';
                        echo '<td>';
                            echo '<div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                      $liste_dep_fix_cat = $db->prepare('SELECT date,description,montant FROM note_des_depenses WHERE types="Variable" AND categories=? ORDER by date');
                                        $liste_dep_fix_cat -> execute(array($la_depense_variable['categories']));
                                        while ($element_list = $liste_dep_fix_cat ->fetch()) {
                                        echo '<li><a>';
                                        echo $element_list['description'].' : <strong>'.round($element_list['montant'],2).'€</strong>';
                                        echo '</a></li>';
                                        }
                                        echo '</ul>
                                 </div>';
                    echo '</td>';

                    echo '<td>'.$la_depense_variable['categories'].'</td>';
                
                    $total_dep_cate_v= $db->prepare('SELECT SUM(montant) FROM note_des_depenses WHERE categories=?');
                    $total_dep_cate_v->execute(array($la_depense_variable['categories']));
                    $total_d_cat = $total_dep_cate_v -> fetch();
                    echo '<td>'.round($total_d_cat[0],2).'</td>';

                    echo '</tr>';

            }

                $total_dep_fixe= $db->query('SELECT SUM(montant) FROM note_des_depenses WHERE types="Variable"');
                $total_d_fix = $total_dep_fixe -> fetch();
                echo '<tr>  <td></td> <td><strong>Total </strong></td> <td><strong>'.round($total_d_fix[0],2).'</strong></td></tr>';
          echo '</table>';
        echo '</div>';


                ?>
                
                
                <script>
                    $('#derouleur_dep_variables_decouvrir').fadeIn(1);
                    $('#derouleur_dep_variables_cacher').fadeOut(1);
                    $('.ligne_de_dep_variables').slideUp(50);
                    
                    function cacher_dep_variables(x){
                        $('#derouleur_dep_variables_cacher').fadeOut(1);
                        $('#derouleur_dep_variables_decouvrir').fadeIn(1);
                        $('.ligne_de_dep_variables').slideUp(50);
                    }
                    
                    function decouvrir_dep_variables(x){
                        $('#derouleur_dep_variables_cacher').fadeIn(1);
                        $('#derouleur_dep_variables_decouvrir').fadeOut(1);
                        $('.ligne_de_dep_variables').slideDown(500);
                    }
                </script>

                
                
                <p><strong>Autres</strong></p> 
                 
                <?php

                $Toutes_depenses_autres = $db->query('SELECT DISTINCT categories FROM note_des_depenses WHERE types="Autre" ORDER BY categories');

            echo '<div class="panel panel-default">  
                <!-- Default panel contents -->
                <!-- Table -->
                <span onclick="cacher_dep_autres()" id="derouleur_dep_autres_cacher" style="float:right" class="glyphicon glyphicon-chevron-up"></span><span onclick="decouvrir_dep_autres()" id="derouleur_dep_autres_decouvrir" style="float:right" class="glyphicon glyphicon-chevron-down"></span>
                <table class="table">';
                echo '<tr><td></td>  <td><strong>Catégorie</strong></td>  <td><strong>Cashflow</strong></td></tr>';
            while ($la_depense_autre = $Toutes_depenses_autres -> fetch()) {


                    echo '<tr class="ligne_de_dep_autres">';
                        echo '<td>';
                            echo '<div class="dropdown">
                                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                      $liste_dep_fix_cat = $db->prepare('SELECT date,description,montant FROM note_des_depenses WHERE types="Autre" AND categories=? ORDER by date');
                                        $liste_dep_fix_cat -> execute(array($la_depense_autre['categories']));
                                        while ($element_list = $liste_dep_fix_cat ->fetch()) {
                                        echo '<li><a>';
                                        echo $element_list['description'].' : <strong>'.round($element_list['montant'],2).'€</strong>';
                                        echo '</a></li>';
                                        }
                                        echo '</ul>
                                 </div>';
                    echo '</td>';

                    echo '<td>'.$la_depense_autre['categories'].'</td>';
                
                    $total_dep_cate_a= $db->prepare('SELECT SUM(montant) FROM note_des_depenses WHERE categories=?');
                    $total_dep_cate_a->execute(array($la_depense_autre['categories']));
                    $total_d_cat = $total_dep_cate_a -> fetch();
                    echo '<td>'.round($total_d_cat[0],2).'</td>';

                    echo '</tr>';

            }

                $total_dep_autre= $db->query('SELECT SUM(montant) FROM note_des_depenses WHERE types="Autre"');
                $total_d_aut = $total_dep_autre -> fetch();
                echo '<tr>  <td></td> <td><strong>Total </strong></td> <td><strong>'.round($total_d_aut[0],2).'</strong></td></tr>';
          echo '</table>';
        echo '</div>';


                ?>
                
                
                <script>
                    $('#derouleur_dep_autres_decouvrir').fadeIn(1);
                    $('#derouleur_dep_autres_cacher').fadeOut(1);
                    $('.ligne_de_dep_autres').slideUp(50);
                 
                    
                    function cacher_dep_autres(x){
                        $('#derouleur_dep_autres_cacher').fadeOut(1);
                        $('#derouleur_dep_autres_decouvrir').fadeIn(1);
                        $('.ligne_de_dep_autres').slideUp(50);
                    }
                    
                    function decouvrir_dep_autres(x){
                        $('#derouleur_dep_autres_cacher').fadeIn(1);
                        $('#derouleur_dep_autres_decouvrir').fadeOut(1);
                        $('.ligne_de_dep_autres').slideDown(500);
                    }
                </script>

                
                
            </div>
        </div>
        
        <div id="card-laterale" class="col-sm-3 col-sm-offset-1" style="/*position:fixed;* border: 1px solid black*/">
            <h2 style="text-align:center">Pay-Day</h2>
            <div class="container-fluid" id="pay-day">
                <p><strong>Perçu dans le mois</strong></p> 
                <div class="pay-day">
                    <div class="panel panel-default">
                      <!-- Table -->
                      <table class="table">
                          
                          <?php
                          
                            $total_Rev= $db->query('SELECT SUM(cumul) FROM revenus_actifs');
                            $total_r = $total_Rev -> fetch();

                            $total_Dep= $db->query('SELECT SUM(montant) FROM note_des_depenses');
                            $total_d = $total_Dep -> fetch();

                          ?>
                          
                          
                          
                        <tr><td><strong>Total Revenu </strong></td><td><p style="text-align:center"><?php echo round($total_r[0],2); ?>€</p></td></tr>
                        <tr><td><strong>Total Dépense </strong></td><td><p style="text-align:center"><?php echo round($total_d[0],2); ?>€</p></td></tr>
                        <tr><td><strong>Bilan <?php echo date('m/Y');?></strong></td><td><p style="text-align:center"><strong><?php echo round(($total_r[0]-$total_d[0]),2); ?>€</strong></p></td></tr>
                      </table>
                    </div>
                </div>
            </div>
            <hr>
            <h2 style="text-align:center">Cash</h2>
            <div class="container-fluid" id="cash">
                <div class="cash">
                    <?php
                        
                        $total_cash= $db->query('SELECT * FROM `users_parameters`');
                        $total_c = $total_cash -> fetch();
                    ?>
                    <h1 style="text-align:center"><?php echo round($total_c['cash_banque'] + $total_c['cash_espece'] + ($total_r[0] - $total_d[0]),2)?>€</h1>
                    <div class="panel panel-default">
                      <!-- Table -->
                      <table class="table">
                      	<?php $soldeBanque = round($total_c['cash_banque'],2);?>
                      	<?php $argentEspece = round($total_c['cash_espece'],2);?>
                        <tr><td><strong>Compte en banque</strong></td><td><p style="text-align:center"><?php echo $soldeBanque;?>€</p></td></tr>
                        <tr><td><strong>Argent en espèce </strong></td><td><p style="text-align:center"> <?php echo $argentEspece;?>€</p></td></tr>
                      </table>
                    </div>
                </div>
            </div>
            <hr>
            <h2 style="text-align:center">Epargne</h2>
            <div class="container-fluid" id="epargne">
                <div class="epargne">
                    <h1 style="text-align:center"><?php echo round($total_c['epargne'],2)?>€</h1>
                </div>
            </div>
            <hr>
            <h2 style="text-align:center">Sortie de la rat race</h2>
            <div class="container-fluid" id="rat-race">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
            </div>
        </div>
        </div>


</div>

<?php
/*Nettoyage des variables GET et POST */
$_GET=array();
$_POST=array();
?>

<!--Le pied de page--><?php include_once 'includes/footer.php';?>