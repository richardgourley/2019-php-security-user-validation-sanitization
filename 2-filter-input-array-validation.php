<?php
/**
* VALIDATE FORM DATA
* CHECK $_POST DATA IS CORRECT TYPE FROM A FORM INPUT.
*
*/

$post = filter_input_array(INPUT_POST, FILTER_VALIDATE_INT); 
var_dump($post);
// "Hello world"  = boolean false 
// 25 = int 25


$post2 = filter_input_array(INPUT_POST, FILTER_VALIDATE_FLOAT); 
var_dump($post2);
// 25 = float 25
// 25.7 = float 25.7
// true = boolean false

$post3 = filter_input_array(INPUT_POST, FILTER_VALIDATE_EMAIL);
var_dump($post3);
// dave@mail.com = string 'dave@mail.com'
// dave@mail = boolean false

/*
* ARRAY OF ARGS 
* You can pass in an array of args which specify which type you expect for each form input.
*/

//EXAMPLE FORM FIELDS - 'quantity' and 'email' fields 
$args = array(
   'quantity' => FILTER_VALIDATE_INT,
   'email' => FILTER_VALIDATE_EMAIL
);
$post4 = filter_input_array(INPUT_POST, $args);


/*
* FITLERS AND FLAGS
* You can specify more detailed FLAGS and FILTERS for validating individual array items.
* You can also set OPTIONS to combine other filters.  See example below.
*/


$args2 = array(
   'yes_or_no' => array(
      'filter' => FILTER_VALIDATE_BOOLEAN,
      'flags' => FILTER_NULL_ON_FAILURE
   ),
   'file_size' => array(
      'filter' => FILTER_VALIDATE_INT,
      'options' => array('min_range' => 50, 'max_range' => 200)
   )

);
$post5 = filter_input_array(INPUT_POST, $args2);
var_dump($post5);
// 'yes_or_no' - 25 = null. "Hello" = null. NO INPUT = bool false. "yes" = bool true. 1 = bool true. 
// 'file_size' - 30 = bool false. 174 = int 174.

/*
* OTHER COMMON FLAGS
* FILTER_VALIDATE_INT = FILTER_ALLOW_OCTAL, FILTER_FLAG_ALLOW_HEX
* FILTER_VALIDATE_URL = FILTER_FLAG_HOST_REQUIRED, FILTER_FLAG_PATH_REQUIRED
* 
*/

?>






