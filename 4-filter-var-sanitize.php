<?php
/**
* FILTER_VAR_SANITIZE
* Validation is a priority, use sanitization alongside validation in dealing with user input.
* Sanitization has to be chosen depending on your requirements, eg. you want to save HTML or other characters.
* See 4-pdo-prepared-statements.php. ALWAYS use prepared statements after validation and sanitization.
*/

// Any parameters you send when using a prepared statement will just be treated as strings
// MySQL extension, which was deprecated in PHP 5.5.0 and removed entirely in PHP 7.0.0.
// mysql_query("INSERT INTO `table` (`column`) VALUES ('$unsafe_variable')");

function test_string_filters($str){
   var_dump(filter_var($str, FILTER_SANITIZE_STRING));
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW)); 
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)); 
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_BACKTICK));
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH)); 
   var_dump(filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP)); 
}

//test_string_filters("<script>alert('Hello world'<script>");
test_string_filters("<script>alert('Hello')<script>"); // all return ''alert(&#39;Hello&#39;)'' except FILTER_FLAG_NO_ENCODE_QUOTES returns 'alert('Hello')'
test_string_filters("` `"); // only FILTER_FLAG_BACKTICK returns ''
test_string_filters('&'); // only FILTER_FLAG_ENCODE_AMP returns '&#38;'
test_string_filters('É'); // only FILTER_FLAG_STRIP_LOW returns ''
// only FILTER_FLAG_ENCODE_LOW returns '&#195;&#137;'

/*
* STRIP_TAGS vs FILTER_SANITIZE_STRING
* Note how the less than symbol is still allowed in strip tags.
*/

var_dump(strip_tags('<h1>10 < 5</h1>')); // '10 < 5'
var_dump(filter_var('<h1>10 < 5</h1>', FILTER_SANITIZE_STRING)); // '10 '


/*
* FILTER SANITIZE NUMBER INT, FILTER_SANITIZE_NUMBER_FLOAT all return a string
*/

var_dump(filter_var(25, FILTER_SANITIZE_NUMBER_INT)); // string '25'


