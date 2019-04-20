<?php
/**
* FILTER_VAR
* Always validate data.
* Check it is the type or format you expect.
*/

$num = "29";
$returned_num = filter_var($num, FILTER_VALIDATE_INT);
var_dump($returned_num); // int 29 (checks is int, converts to int, returns int)

$bool = "test";
$returned_bool = filter_var($bool, FILTER_VALIDATE_BOOLEAN);
$returned_bool_null_on_failure = filter_var($bool, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE); // Flag passed in as 3rd parameter.
var_dump($returned_bool); // boolean false.
var_dump($returned_bool_null_on_failure); // null

$string = "I am a string";
$returned_string = filter_var($string, FILTER_UNSAFE_RAW); // FILTER_UNSAFE_RAW means no filter applied.
var_dump($returned_string); // string 'I am a string'

/*
* PASS FLAGS AS AN ARRAY
* You can pass flags as an array as required, if you have multiple flags etc.
*/

$octal_number = '0755';
$options = array(
   'flags' => FILTER_FLAG_ALLOW_OCTAL
);
$octal_number_validated = filter_var($another_number, FILTER_VALIDATE_INT, $options);
var_dump($octal_number_validated); // int 493

/*
* PASS OPTIONS - SET A DEFAULT
* You can set a default to be returned if the validation fails
*/ 

$var_input = "Steve";
$more_options = array(
   'options' => array(
      'default'   => 50,
      'min_range' => 3
   )
);
$var_input_validated = filter_var($var_input, FILTER_VALIDATE_INT, $more_options);
var_dump($var_input_validated); // int 50

/*
* FILTER_CALLBACK
* You have the flexibility to create your own filters as required.
*/

$username = "steveB1986!";
$checked_username = filter_var($username, FILTER_CALLBACK, array('options' => 'check_username'));
var_dump($checked_username); // boolean false

function check_username($username){
   if(strlen($username) > 12 || strpos($username, '!')){
      return false;
   }

   return true;
}

/*
* FILTER_VAR_ARRAY
* Pass in an array of arguments to check each variable in the array
*/

$my_arguments = array(
   'id_num'                => FILTER_VALIDATE_INT,
   'website'               => FILTER_VALIDATE_URL,
   'programming_languages' => array('flags' => FILTER_FORCE_ARRAY)
);
$employee_details = array(
   'id_num'                => 7465,
   'website'               => 'https://www.mysuperwebsite.com',
   'programming_languages' => array(
      'Java',
      'Python',
      'PHP'
   )
);

$filtered_employee_details = filter_var_array($employee_details, $my_arguments);
var_dump($filtered_employee_details); 

/*
* FILTER_VAR_ARRAY and FILTER_VALIDATE_URL
* Another example of array validation using URLs.
*/

$my_urls = array(
   'url1' => 'www.mysuperwebsite.com',
   'url2' => 'https://www.mysuperwebsite.com'
);

$my_urls_validated = filter_var_array($my_urls, FILTER_VALIDATE_URL);
var_dump($my_urls_validated);
// 'url1' => boolean false
// 'url2' => string 'https://www.mysuperwebsite'

//NOTE: USE FILTER FLAGS WITH URLs:
/*
* FILTER_FLAG_SCHEME_REQUIRED
* FILTER_FLAG_HOST_REQUIRED
* FILTER_FLAG_PATH_REQUIRED
* FILTER_FLAG_QUERY_REQUIRED
*/

/*
* FILTER_FORCE_ARRAY returns an array even if with one element.
* FILTER_REQUIRE_ARRAY used to ensure only an array is filtered.
*/

$var_to_test = "yes";
$var_to_test_array = filter_var($var_to_test, FILTER_VALIDATE_BOOLEAN, FILTER_FORCE_ARRAY);
var_dump($var_to_test_array); // array 0 => boolean true

$test_email = 'dave1@mail.com';
$checked_test_string = filter_var($test_email, FILTER_VALIDATE_EMAIL, FILTER_REQUIRE_ARRAY);
var_dump($checked_test_string); // boolean false (array not passed in.)
