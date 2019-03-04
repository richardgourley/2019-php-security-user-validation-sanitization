<?php
/**
* VALIDATE FORM DATA
* CHECK $_POST DATA IS CORRECT TYPE FROM A FORM.
*
*/

//Check input post array of the same type.
/* $_POST['score'] = 89; $_POST['test_number'] = 39; */
$post = filter_input_array(INPUT_POST, FILTER_VALIDATE_INT);
var_dump($post);
//output: 'score' => int 89,  'test_number' => 39





