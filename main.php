
<?php 

	include_once 'errorhtml.php';
	include_once 'typeerror.php';

	include_once 'url.php';

   //Recupere l'API  du site W3C en JSON  // j'ai mis mon site http://yourgame.alwaysdata.net

	$URLS = New URLS('http://yourgame.alwaysdata.net/inscription.php');

	$url = $URLS->GetURLValidator();

	$options = array(
	  'http'=>array(
	    'method'=>"GET",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
	              "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36\r\n" // i.e. An iPad 
	  )
	);
	// reprise du code de l'ancien projet permettant de retrouerner l'url s'éléctionner JSON en Tableau
	$context = stream_context_create($options);
	$recup_data = file_get_contents($url, false, $context);

	$data = json_decode($recup_data ,true);// Récupre les donnnées json en php

	$number = count($data["messages"]);


	// Affiche les erreur html de la page  http://yourgame.alwaysdata.net
	echo "<p><b>La page à corriger : </b>".$data["url"]."</p>";


	for ($i=0; $i <$number ; $i++) {
		$type = $data["messages"][$i]['type'];
		$message = $data["messages"][$i]['message'];
		$extract = $data["messages"][$i]['extract'];
		$lastLine = $data["messages"][$i]['lastLine'];
		$firstLine = $data["messages"][$i]['firstLine'];
		$lastColumn =  $data["messages"][$i]['lastColumn'];
		$firstColumn = $data["messages"][$i]['firstColumn'];

		$ErrorHTML = New ErrorHTML($type,$message,$extract,$lastLine,$firstLine,$lastColumn,$firstColumn);

	
		echo $ErrorHTML;

	}
/*lien d'aide: https://github.com/validator/validator/wiki/Service-%C2%BB-HTTP-interface*/
 ?>