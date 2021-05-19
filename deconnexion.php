<?php 
include_once './class/bdd/connexionbdd.php';

	$_SESSION = array();
	session_destroy();
	header('Location: connexion.php');
exit();
	
?>

