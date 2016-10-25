<?php

function sd_square($x, $mean) 
{ 
	return pow($x - $mean,2); 
}

function ecart_type($array) 
{
	return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
}

function moyenne($tableau)
{
	return array_sum($tableau)/count($tableau);
}

function mediane ($t)
{
	sort($t, SORT_NUMERIC) or die("tri échoué !");
	$n = floor ((count($t)+1)/2);
	if (count($t)%2 == 0) return (moyenne(array_slice($t, 0, $n)) + moyenne(array_slice($t, $n)))/2;
	else return $t[$n-1];
}

//exemples avec cette liste de valeurs
$l = "41 62 60 60 63 62 65 65 66 65 72 70 72 72 72 72 70 75 75 75 75 76 75 75 75 75 78 80 80 80 89 88 88 92";
//les fonctions attendent un tableau de valeurs, alors on formatte comme attendu
$t = explode(' ', $l);
//appels des fonctions
echo "écart-type=" . ecart_type($t) . "<br>";
echo "moyenne=" . moyenne($t) . "<br>";
echo "mediane=" . mediane($t) . "<br>";
 

?>
