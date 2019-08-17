<!--nav class="navbar navbar-default navbar-fixed-top"-->
<nav class="navbar navbar-default navbar-fixed-top" style="box-shadow:0px 0px 10px #888888">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
          

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php?page=etat_financier">Etat financier</a></li>
          
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Revenus<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?page=ajouter_revenus_actifs">Ajouter des Revenus Actifs </a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index.php?page=ajouter_revenus_actifs&amp;cash_initial=0">Ajouter votre cash initial </a></li>

          </ul>
        </li>
      </ul>
        
      <ul class="nav navbar-nav">         
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dépenses<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?page=ajouter_une_depense">Ajouter une dépense</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index.php?page=consulter_les_depenses">Consulter les dépenses</a></li>
          </ul>
        </li>
      </ul>
        
        
        
      <ul class="nav navbar-nav navbar-right">
          
            <li>
              
            <!--Bouton de déconnection / la classe du bouton class="btn btn-default"-->

            <form	action="index.php?page=identification" method="POST">
            <input type="submit" class="btn btn-lg btn-block" name="sedeconnecter" value="Déconnexion"/>
            </form>
            </li>
            <?php
            if (isset($_POST['sedeconnecter']))
            {
            $_SESSION = array();	//Cette commande réinitialise l'array SESSION, en la vidant.
            }
            ?>
            <!--Fin Bouton de déconnection-->

      </ul>
          
    </div>
  </div>
</nav>
              

<?php //include_once '_classes/espace_admin.php';?>