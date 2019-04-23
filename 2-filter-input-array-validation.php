<?php
/**
* VALIDATE FORM DATA
* CHECK $_POST DATA IS CORRECT TYPE FROM A FORM INPUT.
*/

$post = filter_input_array(INPUT_POST, FILTER_VALIDATE_INT); 
var_dump($post);
//EXAMPLE INPUTS:
// "Hello world"  = boolean false 
// 25 = int 25


$post2 = filter_input_array(INPUT_POST, FILTER_VALIDATE_FLOAT); 
var_dump($post2);
//EXAMPLE INPUTS:
// 25 = float 25
// 25.7 = float 25.7
// true = boolean false

$post3 = filter_input_array(INPUT_POST, FILTER_VALIDATE_EMAIL);
var_dump($post3);
//EXAMPLE INPUTS:
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
*
* FILTER_NULL_ON FAILURE
* In this example, the flag 'FILTER_NULL_ON_FAILURE' returns 'null' instead of a boolean. Useful for database work.
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
* FILTER_REQUIRE_SCALAR
* Useful if you want to make sure the input is not an array of values.
*/

$args3 = array(
   'name'   => FILTER_REQUIRE_SCALAR,
);

$post6 = filter_input_array(INPUT_POST, $args3);
var_dump($post6);
//EXAMPLE INPUTS
// name - "Hello" = string 'Hello'. 
// array('a','b','c') = boolean false.








