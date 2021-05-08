<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/inscription/forminscription.php';

//----------------------------------------------------------------------------------------------

if(!empty($_POST)){
	
		$nom = htmlspecialchars(strip_tags($_POST['nom']));
		$prenom = htmlspecialchars(strip_tags($_POST['prenom']));
		$email = htmlspecialchars(strip_tags($_POST['email']));
		$tel =  "0" . strval(htmlspecialchars(strip_tags($_POST['tel'])));
		$login =  htmlspecialchars(strip_tags($_POST['login']));
		$password = sha1($_POST['password']);

			$Inscription = new FormInscription($nom,$prenom,$email, $tel,$login, $password);
			$ChekForm = $Inscription->CehckForm();
			
			if ($ChekForm == 1) {
				$tab["ok"] = $ChekForm;
				
			}
	print_r(json_encode($tab));
}
?>