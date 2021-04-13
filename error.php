<?php

/**
 * Erreur HTML de l'API validator.w3.org
 * @param : ...
 * @return : les erreurs de la pages donner
 */

class Error{
	private $type;
	private $message;
	private $extract;
	private $lastLine;
	private $firstLine;
	private $lastColumn;
	private $firstColumn;

	public function __construct(int $p1, int $p2){
		$this->pos1 = $p1;
		$this->pos2 = $p2;
	}
	public function GetP1(){
			return $this->p1;
	}
	public function GetP2(){
			return $this->p2;
	}
	public function __toString(){
        $out  = "<------------------GeoShape-----------------><br>";
        $out .= "Point 1 :<br> x =". $this->pos1 ."<br> y =". $this->pos2 ."<br>";
        return $out;
    }

	}

?>
