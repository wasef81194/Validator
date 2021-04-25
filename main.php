
<?php 

	include_once 'errorhtml.php';
	include_once 'errorcss.php';
	include_once 'typeerror.php';
	include_once 'url.php';
	include_once 'warningcss.php';
	include_once 'function.php';


	$url = 'http://mygame.alwaysdata.net/';
	$Taburl = getTabUrl($url);
	//var_dump($Taburl);
	for ($x=0; $x < CountTabUrl($url) ; $x++) { 
		$urls = $Taburl[$x];
		//echo $urls;

		$URLS = New URLS($urls);
		

	//---------------------------------------------------------------------------------------------------CSS--------------------------------------------------------------------------------------------
		echo "<h2><b>La page à corriger : </b>". $URLS->GetURL()."</h2>";

		$APICSS = $URLS->GetURLValidatorCSS();
		$recup_data = file_get_contents($APICSS);
		$data = json_decode($recup_data,TRUE);
		//var_dump($data);
		$errorcount = $data["cssvalidation"]["result"]["errorcount"];
		$warningcount = $data["cssvalidation"]["result"]["warningcount"];
		//echo $errorcount;
		for ($i=0; $i <$errorcount; $i++) {
			$line = $data["cssvalidation"]["errors"][$i]['line'];
			$context = $data["cssvalidation"]["errors"][$i]['context'];
			$type = $data["cssvalidation"]["errors"][$i]['type'];
			$message = $data["cssvalidation"]["errors"][$i]['message'];

			$ErrorCSS = New ErrorCSS($line,$context,$type,$message);

		
			echo $ErrorCSS;

		}
		for ($i=0; $i <$warningcount; $i++) {

			$line = $data["cssvalidation"]["warnings"][$i]['line'];
			$type = $data["cssvalidation"]["warnings"][$i]['type'];
			$message = $data["cssvalidation"]["warnings"][$i]['message'];
			$WarningCSS = New WarningCSS($line,$type,$message);
		
			echo $WarningCSS;
		}


		//-------------------------------------------------------------------------------------------------------HTML--------------------------------------------------------------------------------------------------
	   	//Recupere l'API  du site W3C en JSON  // j'ai mis mon site http://yourgame.alwaysdata.net-

		

		$APIHTML = $URLS->GetURLValidatorHTML();
		echo $APIHTML;
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
		$recup_data = file_get_contents($APIHTML, false, $context);

		$data = json_decode($recup_data ,true);// Récupre les donnnées json en php

		$number = count($data["messages"]);


		// Affiche les erreur html de la page  http://yourgame.alwaysdata.net


		for ($f=0; $f <$number ; $f++) {
			$type = $data["messages"][$f]['type'];
			$message = $data["messages"][$f]['message'];
			$extract = $data["messages"][$f]['extract'];
			$lastLine = $data["messages"][$f]['lastLine'];
			$firstLine = $data["messages"][$f]['firstLine'];
			$lastColumn =  $data["messages"][$f]['lastColumn'];
			$firstColumn = $data["messages"][$f]['firstColumn'];

			$ErrorHTML = New ErrorHTML($type,$message,/*extract*/'Extrait',$lastLine,$firstLine,$lastColumn,$firstColumn);

		
			echo $ErrorHTML;

		}



	}

	





 ?>