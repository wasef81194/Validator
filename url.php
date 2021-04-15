<?php

/**
 * URL
 * @param : URL du site à corriger
 * @return : le nom de l'url
 */

class URLS{

	private $url;

	public function __construct(string $url){

		$this->url = $url;

	}
	public function GetURL(){
			return $this->url;
	}

	public function GetURLValidatorHTML(){
		$urlValid = "https://validator.w3.org/nu/?doc=".$this->url."&out=json";
		return $urlValid;
	}
	public function GetURLValidatorCSS(){
		$urlValid = " https://jigsaw.w3.org/css-validator/validator?uri=".$this->url."&output=json";
		return $urlValid;
	}

	public function __toString(){
        $out  = "<------------------URL-----------------><br>";
        $out .= "<p> URL : ". $this->url ."</p>";
        return $out;
    }

	}

?>
