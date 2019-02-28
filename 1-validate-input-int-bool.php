<?php
/**
* VALIDATE ANY USER INPUT
* Check the type entered is the type you expect.
*
*/

/**
* BASIC CHECKS
*/

$num1 = "679";
if(is_numeric($num1)){ echo "Valid number"; } //is_numeric returns true if var can be parsed to an int

$num2 = 679;
if(is_int($num2)){ echo "Valid int"; } //is_float() is_double() available

$bool1 = true;
if(is_bool($bool1)){ echo "Valid bool"; }

$bool2 = 0;
if(is_bool((bool)$bool2)){ echo "Can be parsed to a boolean"; } // (bool)$var - see if $var can be passed to bool.

/**
*
* FILTER_VAR VALIDATION
*
*/

echo filter_var('679', FILTER_VALIDATE_INT); // output: 679 - validates is_numeric, returns as int
var_dump(filter_var('679', FILTER_VALIDATE_INT)); //output: int 679

//SET RANGE FOR INTEGER
echo filter_var(289, FILTER_VALIDATE_INT, array("options" => array("min_range" => 100, "max_range" => 1000)));
//output: 289
echo filter_var(1200, FILTER_VALIDATE_INT, array("options" => array("min_range" => 100, "max_range" => 1000)));
//output: false (out of range)

/**
* BOOLEANS
* THESE VALUES RETURN TRUE: 1, "1", "yes", "true", "on", TRUE
* THESE VALUES RETURN FALSE: 0, "0", "no", "false", "off", "", NULL, FALSE
*/
var_dump(filter_var(0, FILTER_VALIDATE_BOOLEAN)); //output: boolean false 
var_dump(filter_var('on', FILTER_VALIDATE_BOOLEAN)); //output: boolean true


// Use FILTER_REQUIRE_ARRAY to specify an array is being filtered.
$array_bools = array(0, "yes", "1", NULL);
var_dump(filter_var($array_bools, FILTER_VALIDATE_BOOLEAN, FILTER_REQUIRE_ARRAY)); //output: false, true, true, false






