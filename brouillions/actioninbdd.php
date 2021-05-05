<?php

include_once './class/inscription/connexionbdd.php';
//----------------------------------------------------------------------------------------
/**
 * URL
 * @param : information à la base de donner (servername, dbname, username,password, requete et connexion )
 * @return : requete
 */

class ActionInBDD extends ConnexionBDD{

	private $conn;
	private $request;

	public function __construct( string $servername, string $dbname, string $username, string $password, $conn, string $request){

		parent::__construct($servername, $dbname, $username, $password);
		$this->conn = $conn;
		$this->request = $request;

	}
	public function ServerName(){
			return parent::ServerName();
	}
	public function DBName(){
			return parent::DBName();
	}
	public function UserName(){
			return parent::UserName();
	}
	public function Password(){
			return parent::Password();
	}
	public function OpenCon(){
			return parent::OpenCon();
	}

	public function CloseCon()
	{
		$conn = $this->conn;
		$conn -> close();
	}

	public function getResults()
	 {
	 	$request = $this->request;
	    //Connexion à la base de données
	     $conn = $this->conn;

	     $result = mysqli_query($conn,$request);
	     //fermeture de la connexion
	     $conn -> close();
	     return $result;
	 }

	public function __toString(){
	    $out  = parent::__toString();
	    $out .= "-----------------Action dans la BDD ----------------";
	    $out .= "<p> Requete : ".$request."</p>";
	    return $out;
    }

}


?>