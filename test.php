<?php
$url = 'http://mygame.alwaysdata.net';
$pattern = '#(?:src|href|path|xmlns(?::xsl)?)\s*=\s*(?:"|\')\s*(.+)?\s*(?:"|\')#Ui';
$subject = file_get_contents($url);
preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);

$nombre = count($matches[1]);
echo $url."/";
foreach($matches[1] as $match)
{
	echo $match.'</br>';
}

?>