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
		$parse2 = parse_url($match);
		if ($parse2['host'] == '') {
			$lastChar = substr($url, -1);
			if ($lastChar =='/') {
				$urls = $url;
			}
			else{
				$urls = $url.'/';
			}
		}
		else{
			$urls = '';
		}
		
		$urls .= $match;
		$parse3 = parse_url($urls);
		if (!in_array($urls, $taburl)) {//si le lien n'xiste pas déja
			if ($parse3['host']==$parse['host']) {//verifie que le nom d'hote sont les même pour pas tomber sur des pages qui n'ont pas le meme nom de domain
				array_push($taburl,$urls); //ajoute les urls rejoint sur la page 
			}
		}
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
function CheckValue($value){
	if ($value == NULL) {
		$value = 0;
		return $value;
	}
	else{
		return $value;
	}
}
function NoError($error)
{
	if ($error == 0) {
		$message = '<div class = "container"> PAS D\'ERREUR </div>';
	}
	return $message;
}

function Nav(){
	$header='
	<!DOCTYPE html>
	<html lang="fr">
	<head>
	<title>Validator</title>
	  <link rel="stylesheet" type="text/css" href="/style/style.css">
	</head>
	<body>
	<h1>Validator</h1>

	<ul>
	  <li><a href="index.php">Accueil</a></li>
	  <li><a href="#propos">À propos</a></li>
	  <li><a href="#contact">Contact</a></li>
	  <li style="float:right"><a href="connexion.php">Connexion</a></li>
	  <li style="float:right"><a href="inscription.php">Inscription</a></li>
	</ul><div id="bodyofbody">';
	return $header;
}
function Footer(){
	$footer='</div>
	<footer><p>© 2021 - WASEF Alexandra & BELHOCINE Thilleli</p></footer>
	
	</body>
	</html>
	';
	return $footer;
}

function FormValidator(){
	$form = '<form action="index.php" method="post">
	<h2>Valide ton site</h2>
	<label>Entrez l\'url de votre site :</label>
    <input type="text" placeholder="https://example.com" name="url" id="url" required/> 
     <input type="hidden" name="formtype" value="validator" /> 
     <input type="submit" value="Valider" id="ButtonValid"/>
	</form>';

	return $form;
}


?>