<?php 
	//include_once 'nav.php';
	include_once './class/validator/errorhtml.php';
	include_once './class/validator/errorcss.php';
	include_once './class/validator/typeerror.php';
	include_once './class/validator/url.php';
	include_once './class/validator/warningcss.php';
	include_once 'function.php';
	include_once './class/validator/formvalidator.php';

 //----------------------------------------------------------------------------------------------
	echo Nav(); //Menu de navigation
	echo FormValidator();// Formulaire de validiation de site
	if ($_POST["formtype"] == "validator") {
	$FormValidator = New FormValidator($_POST["formtype"],$_POST["url"]);// Appel de la class
	$url = $FormValidator->GetUrl();//utilisation de ces fonctions
	$FormCheck = $FormValidator->CehckForm();//utilisation de ces fonctions
	}
	if($FormCheck != 'TRUE'){
		echo $FormCheck;// si l'url n'est pas valide cela affiche un message d'erreur 
	}
	else{//si non l'API corrige les pages
		//$url = 'http://mygame.alwaysdata.net/';
		$Taburl = getTabUrl($url);
		//var_dump($Taburl);
	 	
	 	//echo $lastChar;
		for ($x=0; $x < CountTabUrl($url) ; $x++) { 
			$urls = $Taburl[$x];

			$URLS = New URLS($urls);
			 /*$extention = substr( strrchr($urls, "."),1);
			 echo $extention;*/
			
		//---------------------------------------------------------------------------------------------------CSS--------------------------------------------------------------------------------------------
			$UrlValid = $URLS->ValideURL();
			if ($UrlValid) {

				echo "<h2><b>La page à corriger : </b>". $URLS->GetURL()."</h2>";

				//echo "<h3>Dans le code CSS :</h3>";
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
					//error_reporting(0);
					echo '<div class = "container">'.$ErrorCSS.'</div>';
				}
				for ($i=0; $i <$warningcount; $i++) {

					$line = $data["cssvalidation"]["warnings"][$i]['line'];
					$type = $data["cssvalidation"]["warnings"][$i]['type'];
					$message = $data["cssvalidation"]["warnings"][$i]['message'];
					$WarningCSS = New WarningCSS($line,$type,$message);
				
					echo '<div class = "container">'.$WarningCSS.'</div>';
				}
				//-------------------------------------------------------------------------------------------------------HTML--------------------------------------------------------------------------------------------------
			   	//Recupere l'API  du site W3C en JSON  // j'ai mis mon site http://yourgame.alwaysdata.net-
					//echo "<h3>Dans le code HTML :</h3>";
					$APIHTML = $URLS->GetURLValidatorHTML();
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

						$ErrorHTML = New ErrorHTML($type,$message,$extract,$lastLine,$firstLine,$lastColumn,$firstColumn);

						echo '<div class = "container">'.$ErrorHTML.'</div>';

					}
			}

		}
	}
	echo Footer();



 ?>
