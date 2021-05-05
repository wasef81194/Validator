<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';

//----------------------------------------------------------------------------------------------
echo Nav();
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class

//echo $ConnexionBDD;
/*$conn = $ConnexionBDD->OpenCon();
$request = "INSERT INTO `user`(id_user,nom_user,prenom_user,mail_user,login_user,mdp_user)
              VALUES (NULL,'Wasef', 'Alexandra', 'alex.wasef@gmail.com' ,'wasef','wasef01*')";
$ConnexionBDD->getResults($conn,$request);*/
echo Footer();

?>