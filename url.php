<?php

/**
 * URL
 * @param : URL du site à corriger
 * @return : le nom de l'url les API avec l'url entré
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
		$urlValid = "https://jigsaw.w3.org/css-validator/validator?uri=".$this->url."&output=json";
		return $urlValid;
	}

	/*public function  getTabUrl(){
		$url = $this->url;
		$taburl = [];
		$pattern = '#(?:href|path|xmlns(?::xsl)?)\s*=\s*(?:"|\')\s*(.+)?\s*(?:"|\')#Ui';
		$subject = file_get_contents($url);
		preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);

		$nombre = count($matches[1]);
		array_push($taburl,$url);//ajoute l'url sélctionner dans le tableau

		foreach($matches[1] as $match)
		{
			$urls = $url;
			$urls .= $match;
			array_push($taburl,$urls); //ajoute les urls rejoint sur la page 
			$urls ='';
		}
		return $taburl;
	}

	public function CountTabUrl(){
		$url = $this->url;
		$taburl = getTabUrl($url);
		$count = count($taburl);
		return $count;
	}
*/
	public function __toString(){
	    $out  = "<------------------URL-----------------><br>";
	    $out .= "<p> URL : ". $this->url ."</p>";
	    return $out;
    }

}

?>
