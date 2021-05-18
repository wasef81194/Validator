<?php
//include_once ('../function.php');
include_once $_SERVER['DOCUMENT_ROOT']. 'function.php';

include_once $_SERVER['DOCUMENT_ROOT']. '/class/logs/logs.php';
/**
/**
 * Check du formulaire de connexion
 * @param : login mdp
 * @return : connexion ou non 
 */
class FormConnexion{

	private $login;
	private $password;



	public function __construct(string $login, string $password){	

		$this->login = $login;
		$this->password = $password;

	}
	public function GetLogin(){
		return $this->login;
	}
	public function GetPassword(){
		return $this->password;
	}

 	public function CheckForm(){
 			
 			$message=false;
			if (!empty($this->login) AND !empty($this->password) ) {
				$ConnexionOk=false;
 				$UserExist=verifUser($this->login,$this->password);
				 //-----------------------------------------------------------
				if ($UserExist){

					$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');
					$conn = $ConnexionBDD->OpenCon();
					 
					$request =  ("SELECT id_user,nom_user,prenom_user,mail_user,tel_user,login_user FROM user WHERE login_user='$this->login' AND mdp_user='$this->password'");
					$result = $ConnexionBDD->getResults($conn,$request);
					while ($row = $result -> fetch_array(MYSQLI_NUM)) {
						$_SESSION['id_user']=$row[0];
	              		$_SESSION['nom_user'] = $row[1];
	              		$_SESSION['prenom_user'] = $row[2];
	              		$_SESSION['mail_user'] = $row[3];
	              		$_SESSION['tel_user'] = $row[4];
	              		$_SESSION['login_user'] = $row[5];

					
					}
					$ConnexionOk=TRUE;
					$Logs = New Logs('à été connecté ');
					$Logs->SaveLogs();

				}
				else{
					$Logs = New Logs('n\'a pas renseigné les bonnes informations pour se connecter');
					$Logs->SaveLogs();
				}
				//afficher les resultat en json
			      $tab["ConnexionOk"]=$ConnexionOk;
			      $tab["UserExist"]=$UserExist;	
				
			}
			else{
				$message=TRUE;
				$tab["errorMessage"]=$message;
				$Logs = New Logs('n\'a pas remplies l\'intégralité du formulaire de connexion ');
				$Logs->SaveLogs();
				
			}
			
			return (json_encode($tab));
	}
	public function __toString(){

        $out  = "<------------------Info User-----------------><br>";
        $out .= "<p> Login : ".$this->login."</p>";
        $out .= "<p> Mot de passe: ". $this->password ."</p>";
        return $out;
    }

}



?>
