<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------

if(!empty($_POST)){
	
		$login =  htmlspecialchars(strip_tags($_POST['login']));
		$password = $_POST['password'];


		//Récupération de la clé de décryptage à partir de la bdd
		$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
		$conn = $ConnexionBDD->OpenCon();

      	$SelectKey= "SELECT key_chiffrement FROM user WHERE login_user='$login'";
      	$Key = $ConnexionBDD->getResults($conn,$SelectKey);


	      //hash mdp
	      $pwdhash=hash("sha512", $password.$Key);

			$Connexion = new FormConnexion($login, $pwdhash);
			$check = $Connexion->CheckForm();
			
			if ($check){
				$obj = json_decode($check);
				

				$tab["check"]=$obj;
				
			}
		print_r(json_encode($tab));
}
?>