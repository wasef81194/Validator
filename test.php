<?php
/*$url = 'https://www.google.com/';
$pattern = '#(?:src|href|path|xmlns(?::xsl)?)\s*=\s*(?:"|\')\s*(.+)?\s*(?:"|\')#Ui';
$subject = file_get_contents($url);
preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);

$nombre = count($matches[1]);
$taburl = [];

foreach($matches[1] as $match)
{
	$urls = $url;
	$urls .= $match;
	array_push($taburl,$urls);
	$urls ='';
}
echo $urls;
$number = count($taburl);
echo $number;
*/
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
//var_dump(getTabUrl('http://wasef.alwaysdata.net/'));

function CountTabUrl($url){
	$taburl = getTabUrl($url);
	$count = count($taburl);
	return $count;
}
//echo CountTabUrl('http://wasef.alwaysdata.net/');

//$url = getTabUrl('http://wasef.alwaysdata.net/');
//echo $url[0];

?>