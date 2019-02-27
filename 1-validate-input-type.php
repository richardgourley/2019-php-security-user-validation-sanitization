<?php
/**
* VALIDATE ANY USER INPUT
* Check the type entered is the type you expect.
*
*/

/**
*
* BASIC CHECKS
*
*/

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

/**
*
* FILTER_VAR VALIDATION
*
*/

echo filter_var($num1, FILTER_VALIDATE_INT); // output: 679 - validates is int and returns int
var_dump(filter_var($num1, FILTER_VALIDATE_INT)); //output: int 679

echo filter_var($num1, FILTER_VALIDATE_INT, array("options" => array("min_range" => 100, "max_range" => 1000)));
//output: 679 (bool false returned if number out of range.)

/**
* BOOLEANS
* THESE VALUES RETURN TRUE: 1, "1", "yes", "true", "on", TRUE
* THESE VALUES RETURN FALSE: 0, "0", "no", "false", "off", "", NULL, FALSE
*/
var_dump(filter_var($bool2, FILTER_VALIDATE_BOOLEAN)); //output: boolean false 
var_dump(filter_var('on', FILTER_VALIDATE_BOOLEAN)); //output: boolean true

/**
* FILTER_REQUIRE_ARRAY
* Specifies if the assessed $var is an array
*/ 
$array_bools = array(0, 22, "1", NULL);
var_dump(filter_var($array_bools, FILTER_VALIDATE_BOOLEAN, FILTER_REQUIRE_ARRAY)); //output: false, false, true, false























