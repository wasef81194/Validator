<?php

/**
 * URL
 * @param : URL du site à corriger
 * @return : le nom de l'url
 */
//namespace Error;
class URL{

	private $url;

	public function __construct(string $url){

		$this->url = $url;

	}
	public function GetURL(){
			return $this->url;
	}

	public function __toString(){
        $out  = "<------------------URL-----------------><br>";
        $out .= "<p> URL : ". $this->type ."</p>";
        return $out;
    }

	}

?>
