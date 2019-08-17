<?php include_once 'includes/header.php';?>

<!-- CONTENU HTML DE LA PAGE "ERREUR" -->
<h1>Erreur 404 ! Cette page n'existe pas.</h1>

<?php //include_once 'includes/footer.php';?>

     
</div> <!-- Ce div contient tout le corps des pages -->

                <footer class="footer">
                    <div class="container">
                        <p class="pull-right"><a href="#"><br>Haut de page</a></p>
                        <!--p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p-->
                        <p>&copy; <em>Diony's Voice </em><?php $date = date('Y');echo $date;?> <br>&middot; <a href="index.php?page=a-propos">À propos</a></p>
                    </div>
                </footer>

        

    </body>
</html>

<!-- Scripts -->
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.js"></script>




<!--Popover-->
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<!--Fin : Popover-->
