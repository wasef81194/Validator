<?php
/*

  $url = 'https://waytolearnx.com/2019/07/comment-parcourir-un-tableau-multidimensionnel-en-php.html';
  $parse = parse_url($url);
  echo $parse['host']; 
*/
function getTabUrl($url){
  $parse = parse_url($url); 
	$taburl = [];
	$pattern = '#(?:href|path|xmlns(?::xsl)?)\s*=\s*(?:"|\')\s*(.+)?\s*(?:"|\')#Ui';
	$subject = file_get_contents($url);
	preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);

	$nombre = count($matches[1]);
	array_push($taburl,$url);//ajoute l'url sélctionner dans le tableau

	foreach($matches[1] as $match)
	{
		$parse = parse_url($match);
		if ($parse['host'] == '') {
			$urls = $url;
		}
		else{
			$urls = '';
		}
		
		$urls .= $match;
		array_push($taburl,$urls); //ajoute les urls rejoint sur la page 
		$urls ='';
	}
	//var_dump($taburl);
	return $taburl;
}

function CountTabUrl($url){
	$taburl = getTabUrl($url);
	$count = count($taburl);
	return $count;
}
function Nav(){
	$header='
	<!DOCTYPE html>
	<html>
	<head>
	  <link rel="stylesheet" type="text/css" href="\style\style.css">
	
	</head>
	<body>
	<h1>Validator</h1>

	<ul>
	  <li><a href="main.php">Accueil</a></li>
	  <li><a href="#news">À propos</a></li>
	  <li><a href="#contact">Contact</a></li>
	  <li style="float:right"><a href="connexion.php">Connexion</a></li>
	  <li style="float:right"><a href="inscription.php">Inscription</a></li>
	</ul>';
	return $header;
}
function Footer(){
	$footer='
	<footer><p>© 2021 - WASEF Alexandra & BELHOCINE Thilleli</p></footer>
	
	</body>
	</html>
	';
	return $footer;
}

function FormValidator(){
	$form = '<form action="main.php" method="post">
	<h2>Valide ton site</h2>
	<label>Entrez l\'url de votre site :</label>
    <input type="text" placeholder="https://example.com" name="url" id="url" required/> 
     <input type="hidden" name="formtype" value="validator" /> 
     <input type="submit" value="Valider" id="ButtonValid"/>
	</form>';

	return $form;
}

?>