<?php
function gof_shorten_string($string, $wordsreturned) {
	/*  Returns the first $wordsreturned out of $string.  If string
	contains fewer words than $wordsreturned, the entire string
	is returned.
	*/
	$retval = $string; //Just in case of a problem
	$array = explode(" ", $string);
	if (count($array)<=$wordsreturned)/* Already short enough, return the whole thing */{
		$retval = $string;
	}
	else { /* Need to chop of some words */
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array)."...";
	}
	return $retval;
}
function gof_generateRandomString($length = 3) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
 ?>