<?php
require("../index.php");
require("../controleur/conbdd.php");
require("../vues/html/formulaire.html");
;
$log=$_POST['login'];
$mdp=$_POST['mdp'];


if ( $log !="" && isset( $_POST['submit'] ) ) { 
require("../controleur/inscription.php");

}else if ( $log !=""  && isset($_POST['submit2']))
{
    
    require("../controleur/connexion.php");
    }

?>
