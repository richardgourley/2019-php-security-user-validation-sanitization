<?php
/**
* VALIDATE ANY USER INPUT
* Check the type entered is the type you expect.
*
*/

//BASIC CHECKS
$str = "Test";
if(is_string($str)){ echo "Valid string";}

$num1 = "679";
if(is_numeric($num1)){ echo "Valid number"; } //is_numeric returns true if can be parsed to an int

$num2 = 679;
if(is_int($num2)){ echo "Valid int"; } //is_float() is_double() available.

$bool1 = true;
if(is_bool($bool1)){ echo "Valid bool"; }

$bool2 = 0;
if(is_bool((bool)$bool2)){ echo "Can be parsed to a boolean"; } // (bool)$var - see if $var can be passed to bool.

//CHECKING WITH FILTER VAR
















