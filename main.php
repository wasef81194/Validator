
<?php 


   //Recupere l'API  du site W3C en JSON  // j'ai mis mon site http://yourgame.alwaysdata.net


	$recup_data = file_get_contents('https://validator.w3.org/nu/?doc=http://cinemaneverland.alwaysdata.net&out=json');

	$data = json_decode($recup_data ,true);// Récupre les donnnées json en php
	//var_dump($data);
	$number = count($data["messages"]);

	//echo $number;

	// Affiche les erreur html de la page  http://yourgame.alwaysdata.net
	echo "<p><b>La page à corriger : </b>".$data["url"]."</p><p>";
	for ($i=0; $i <$number ; $i++) {

	echo "Type d'erreur : ".$data["messages"][$i]['type']."</p><p>";
	echo "Message d'erreur : ".$data["messages"][$i]['message']."</p><p>";
	if (isset($data["messages"][$i]['extract'])) {
		echo "Extrait  : ".$data["messages"][$i]['extract']."</p>";
	}
	if (isset($data["messages"][$i]['lastLine'])) {
	echo "<p>Dernière Ligne  : ".$data["messages"][$i]['lastLine']."</p>";// a dernière ligne (incluse) sur laquelle tombe la plage source associée au message.
	}
	if (isset($data["messages"][$i]['firstLine'])) {
	echo "<p>Première Ligne  : ".$data["messages"][$i]['firstLine']."</p>";//indique la première ligne sur laquelle tombe la plage source associée au message
	}
	if (isset($data["messages"][$i]['lastColumn'])) {
	echo "<p>Dernière Colonne : ".$data["messages"][$i]['lastColumn']."</p>";// indique la dernière colonne (incluse) sur laquelle la plage source associée au message tombe sur la dernière ligne sur laquelle se trouve.
	}
	if (isset($data["messages"][$i]['firstColumn'])) {
	echo "<p>Première Colonne  : ".$data["messages"][$i]['firstColumn']."</p>";// indique la première colonne sur laquelle tombe la plage source associée au message sur la première ligne sur laquelle tombe.
	}
	echo "</br></br>";

	}
/*lien : https://github.com/validator/validator/wiki/Service-%C2%BB-HTTP-interface*/
 ?>