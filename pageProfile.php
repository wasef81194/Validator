<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------
echo Nav('Connexion');
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class
echo 'WSHHHHHHHH'.$_SESSION['nom_user'].$_SESSION["id_user"];

echo Footer();
?>
