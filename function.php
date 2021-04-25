<?php

function getTabUrl($url){
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

function CountTabUrl($url){
	$taburl = getTabUrl($url);
	$count = count($taburl);
	return $count;
}

?>