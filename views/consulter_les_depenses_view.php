<?php include_once 'includes/header.php'; ?>

<?php
/*Gestion de l'affichage des dates*/
$jourSemAnglais=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
$jourSemFrancais=array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim');
?>




<?php 
echo '<div class="container-fluid">';


if ( (isset($_POST['categorie_a_ajouter']) and !empty($_POST['categorie_a_ajouter'])) or (isset($_GET['categorie']) and !empty($_GET['categorie'])) ) {
    
    if (!empty($_POST['categorie_a_ajouter'])) {
        $cat = $_POST['categorie_a_ajouter'];
    } else {
        $cat = $_GET['categorie'];
    }
    
        
    //Si l'ajout d'une dépense non instantannée
    if (isset($_GET['credit']) and !empty($_GET['credit'])) {
        
        if ($_GET['credit']=="Oui") {
            $nouvelle_depense= $db->prepare('INSERT INTO credits(date,types,categories,montant,description,id_user,date_reglement) VALUES(CURRENT_TIMESTAMP,?,?,?,?,1,CURRENT_TIMESTAMP)');
            $nouvelle_depense -> execute(array($_GET['type'],$cat,$_GET['montant'], $_GET['description']));

            if (isset($_GET['date']) and !empty($_GET['date'])) {
                $maj = $db->prepare('UPDATE credit SET date = (?) WHERE credit.id = (?)');
                $maj -> execute(array($_GET['date'], $_GET['id'] ));
            }
            
        } else {
            $nouvelle_depense= $db->prepare('INSERT INTO note_des_depenses(date,types,categories,montant,description) VALUES(CURRENT_TIMESTAMP,?,?,?,?)');
            $nouvelle_depense -> execute(array($_GET['type'],$cat,$_GET['montant'], $_GET['description']));

            if (isset($_GET['date']) and !empty($_GET['date'])) {
                $maj = $db->prepare('UPDATE note_des_depenses SET date = (?) WHERE note_des_depenses.id = (?)');
                $maj -> execute(array($_GET['date'], $_GET['id'] ));
            }
        }
    }
}



if ( isset($_GET['id_suppr']) and !empty($_GET['id_suppr']) ) {
    
    $depenseASuppr = $db->query('SELECT * FROM note_des_depenses WHERE id='.$_GET['id_suppr']);
    $depSuppr = $depenseASuppr -> fetch();
    
    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous avez supprimé.<hr>
                <p>Description : '.$depSuppr['description'].'</p>
                <p>Montant : '.$depSuppr['montant'].'</p>
                <p>Type : '.$depSuppr['types'].'</p>
                <p>Catégorie : '.$depSuppr['categories'].'</p>
                <p>du : '.$depSuppr['date'].'</p>
                <hr>
                <a href="index.php?page=consulter_les_depenses&amp;description='.$depSuppr['description'].'&amp;montant='.$depSuppr['montant'].'&amp;type='.$depSuppr['types'].'&amp;categorie='.$depSuppr['categories'].'&amp;date='.$depSuppr['date'].'&amp;id='.$depSuppr['id'].'
                
                " class="btn btn-danger"><strong>Rajouter</strong></a>
                
          </div>';
    
    
    $suppression = $db->prepare('DELETE FROM  note_des_depenses WHERE note_des_depenses.id=(?)');
    $suppression -> execute(array($_GET['id_suppr']));
    
}


if  (isset($_GET['id_credit_a_payer']) and !empty($_GET['id_credit_a_payer']))  {
    
    $PayCredit = $db->prepare('SELECT * FROM credits WHERE id=?');
    $PayCredit ->execute(array($_GET['id_credit_a_payer']));
    $paycredit = $PayCredit -> fetch();
    $_GET['type']=$paycredit['types'];
    $_GET['categorie']=$paycredit['categories'];
    $_GET['montant']=$paycredit['montant'];
    $_GET['description']=$paycredit['description'];
    
    $nouvelle_depense= $db->prepare('INSERT INTO note_des_depenses(date,types,categories,montant,description) VALUES(CURRENT_TIMESTAMP,?,?,?,?)');
    $nouvelle_depense -> execute(array($_GET['type'],$_GET['categorie'],$_GET['montant'], $_GET['description']));

    if (isset($_GET['date']) and !empty($_GET['date'])) {
        $maj = $db->prepare('UPDATE note_des_depenses SET date = (?) WHERE note_des_depenses.id = (?)');
        $maj -> execute(array($_GET['date'], $_GET['id'] ));
    }
    
    
    $maj = $db->prepare('UPDATE credits SET montant = (?) WHERE credits.id_user = 1');
    $paiement_credit = 0;
    $maj -> execute(array($paiement_credit));
    
    
    $depenseCreditPaye = $db->query('SELECT * FROM credits WHERE id='.$_GET['id_credit_a_payer']);
    $depCredPay = $depenseCreditPaye -> fetch();
    
    echo '<div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Super!</strong> Vous avez payé un crédit<hr>
                <p>Description : '.$depCredPay['description'].'</p>
                <p>Montant : '.$depCredPay['montant'].'</p>
                <p>Type : '.$depCredPay['types'].'</p>
                <p>Catégorie : '.$depCredPay['categories'].'</p>
                <p>du : '.$depCredPay['date'].'</p>
                <hr>
                <a href="#" class="btn btn-danger"><strong>Erreur</strong></a>                
          </div>';
}



/*Pour les dépenses instantannées*/

    $Toutes_les_depenses = $db->query('SELECT * FROM note_des_depenses  ORDER BY date');
    echo '<div class="panel panel-default">  
        <!-- Default panel contents -->
        <div class="panel-heading">Tableau des dépenses</div>
        <div class="panel-body">
            <p>Toutes les dépenses dont j\'en ai conscience (effectuées par moi-même ou que je trouve dans mon relevé de compte) sont dans ce tableau</p>
        </div>

        <!-- Table -->
        <table class="table">';
//        echo '<tr> <td><strong>Date</strong></td>  <td><strong>Description</strong></td>  <td><strong>Montant</strong></td>  <td><strong>Type</strong></td>  <td><strong>Catégorie</strong></td></tr>';
        echo '<tr><td></td> <td><strong>Date</strong></td>  <td><strong>Description</strong></td>  <td><strong>Montant</strong></td></tr>';
    while ($la_depense = $Toutes_les_depenses -> fetch()) {
        
        
            echo '<tr>';
                echo '<td>';
                    echo '<div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Modifier</a></li>
                                <li><a href="index.php?page=consulter_les_depenses&amp;id_suppr='.$la_depense['id'].'">Supprimer</a></li>
                                
                                
                              </ul>
                         </div>';
            echo '</td>';

                $date_lambda=$la_depense['date'];
                $date = new DateTime($date_lambda);
                $indiceJour=0;
                while ($jourSemAnglais[$indiceJour] != $date->format('D')) {
                    $indiceJour++;
                }
                $dateJour = $jourSemFrancais[$indiceJour].' '.$date->format('d/m');
        
        
            echo '<td>';
               echo $dateJour;
            echo '</td>';

            echo '<td>'.$la_depense['description'].'</td>';

            echo '<td>'.$la_depense['montant'].'</td>';
        
        
                
            echo '</tr>';

//            echo '<td>'.$la_depense['types'].'</td>';
//
//            echo '<td>'.$la_depense['categories'].'</td></tr>';


        
        
        
//        echo $la_depense['date'].' - '.$la_depense['description'].' - '.$la_depense['montant'].' - '.$la_depense['types'].' - '.$la_depense['categories'];
    }

        
        $total_depense= $db->query('SELECT SUM(montant) FROM note_des_depenses');
//        print_r($total_depense);
        $total = $total_depense -> fetch();
//        print_r($total[0]);
//        echo substr(strval($total[0]),0,6);
//        exit;
        echo '<tr> <td></td> <td></td> <td></td> <td><strong>'.substr(strval($total[0]),0,6).'</strong></td></tr>';
  echo '</table>';
echo'</div>';

/*fin dépenses instantannées*/




/*Pour les crédits*/

    $Toutes_les_depenses = $db->query('SELECT * FROM credits  ORDER BY date');
    echo '<div class="panel panel-default">  
        <!-- Default panel contents -->
        <div class="panel-heading">Tableau des crédits</div>
        <div class="panel-body">
            <p>Toutes les dépenses non comptabilisées dans le bilan</p>
        </div>

        <!-- Table -->
        <table class="table">';
//        echo '<tr> <td><strong>Date</strong></td>  <td><strong>Description</strong></td>  <td><strong>Montant</strong></td>  <td><strong>Type</strong></td>  <td><strong>Catégorie</strong></td></tr>';
        echo '<tr><td></td> <td><strong>Date</strong></td>  <td><strong>Description</strong></td>  <td><strong>Montant</strong></td></tr>';
    while ($la_depense = $Toutes_les_depenses -> fetch()) {
        
        
            echo '<tr>';
                echo '<td>';
                    echo '<div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Modifier</a></li>
                                <li><a href="index.php?page=consulter_les_depenses&amp;id_suppr='.$la_depense['id'].'">Supprimer</a></li>';
                                if ($la_depense['montant']!=0) {
                                    echo '<li><a href="index.php?page=consulter_les_depenses&amp;id_credit_a_payer='.$la_depense['id'].'">Payer le crédit</a></li>';
                                }
                                
                                
                              echo'</ul>
                         </div>';
            echo '</td>';

                $date_lambda=$la_depense['date'];
                $date = new DateTime($date_lambda);
                $indiceJour=0;
                while ($jourSemAnglais[$indiceJour] != $date->format('D')) {
                    $indiceJour++;
                }
                $dateJour = $jourSemFrancais[$indiceJour].' '.$date->format('d/m');
        
        
            echo '<td>';
                echo $dateJour;
            echo '</td>';
        
            echo '<td>'.$la_depense['description'].'</td>';

            echo '<td>'.$la_depense['montant'].'</td>';
        
        
                
            echo '</tr>';

//            echo '<td>'.$la_depense['types'].'</td>';
//
//            echo '<td>'.$la_depense['categories'].'</td></tr>';


        
        
        
//        echo $la_depense['date'].' - '.$la_depense['description'].' - '.$la_depense['montant'].' - '.$la_depense['types'].' - '.$la_depense['categories'];
    }

        
        $total_depense= $db->query('SELECT SUM(montant) FROM credits');
        $total = $total_depense -> fetch();
        echo '<tr> <td></td> <td></td> <td></td> <td><strong>'.round($total[0],2).'</strong></td></tr>';
  echo '</table>';
echo'</div>';
/*fin crédits*/


echo'</div>';
?>

<a></a>

              
<?php include_once 'includes/footer.php';?>