<?php

//math : fonction de puissance
function sd_square($x, $mean) 
{ 
	return pow($x - $mean,2); 
}

//calcule l'écart type d'un tableau de valeurs
function ecart_type($array) 
{
	if (count($array) < 2) return 0;
	return ceil(sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1)));
}

//coefficient de variation CV : il représente une sorte d'écart-type relatif pour comparer les dispersions indépendamment des valeurs de la variable. Il s'exprime souvent en pourcentage.
function cv($tableau)
{
	if (empty($tableau)) return 0;
	return floor(100*(ecart_type($tableau)/moyenne($tableau)));
}

//calcule la moyenne d'un tableau de valeurs
function moyenne($tableau)
{
	if (empty($tableau)) return 0;
	return array_sum($tableau)/count($tableau);
}

//calcule la médiane d'un tableau de valeurs
function mediane ($t)
{
	$n = ceil(count($t)/2);
	if ($n == 0) return 0;
	sort($t, SORT_NUMERIC) or die("tri échoué !");
	//pair
	if (count($t)%2 == 0) return ceil(($t[$n-1]+$t[$n])/2);
	//impair
	else return $t[$n-1];
}

//Le test de Dixon examine si la valeur soupçonnée d'être aberrante peut appartenir avec un risque donné à une population normale : il exige donc une distribution normale des valeurs.
function dixon_mini($t)
{
	$n = count($t);
	if ($n <= 5) return 0;
	sort($t, SORT_NUMERIC) or die("tri échoué !");
	if ($n <= 10) return ceil((($t[1]-$t[0])/($t[$n-1]-$t[0]))*100);
	else return ceil((($t[2]-$t[0])/($t[$n-3]-$t[0]))*100);
}

function dixon_maxi($t)
{
	$n = count($t);
	if ($n <= 5) return 0;
	sort($t, SORT_NUMERIC) or die("tri échoué !");
	if ($n <= 10) return ceil((($t[$n-1]-$t[$n-2])/($t[$n-1]-$t[0]))*100);
	else return ceil((($t[$n-1]-$t[$n-3])/($t[$n-1]-$t[2]))*100);
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
