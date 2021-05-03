<?php

include_once 'url.php';
/**
 * Erreur Dans le formulaire
 * @param : Type de formulaire
 * @return : Message d'erreur si l'url n'est pas saisie correctement
 */
class FormValidator extends URLS{

	private $formtype;

	public function __construct(string $formtype, string $url){	
		$this->formtype = $formtype;
		parent::__construct($url);

	}
	public function GetURL(){
		return parent::GetURL();
	}
	public function GetURLValidatorHTML(){
		return parent::GetURLValidatorHTML();
	}
	public function GetURLValidatorCSS(){
		return parent::GetURLValidatorCSS();
	}
	public function ValideURL(){//verifie que le lien n'est pas une image
		return parent::ValideURL();
	}

 	public function CehckForm(){
		if ($this->formtype == "validator") {
			$url = parent::GetURL();
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				$message = 'TRUE';
			    return $message;
			  } 
			  else {
			    $message = "L'URL n'est pas valide";
			    return $message;
			  }
			
		}
	}
	public function GetFormType(){
			return $this->formtype;
	}

	public function __toString(){

        $out  = "<------------------Message Du Formulaire-----------------><br>";
        $out .= parent::__toString();
        $out .= "<p> Type de Formulaire : ". $this->formtype ."</p>";
        return $out;
    }

}

?>
