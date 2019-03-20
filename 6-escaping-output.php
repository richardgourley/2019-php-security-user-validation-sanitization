<?php
/*
* ESCAPING OUTPUT
* Escaping refers to handling the output of data, which you aren't 100% is safe. 
* If someone fills in a name in a form or adds a comment it gets saved in your database.
* You have to assume that when you output that data, it could contain script tags that you do not want to run.
* The main aim of escaping output is to prevent html or bad scripts running (known as XSS or cross site scripting)
*/

/*
* HTML ENTITIES vs. HTML SPECIAL CHARS
* Both are similar but hmtlspecialchars only converts selected characters.
* Html entities converts everything such as symbols or accented letters eg: © ¥ Â Σ √
* The choices are everything (entities) or "special" characters, like ampersand, double and single quotes, less than, and greater than (specialchars).
*
* SUMMARY: Use htmlentities() if you have Unicode or uncommon symbols...
* ...otherwise htmlspecialchars() works in most cases.
*/

/*
* HTML ENTITIES
* Sometimes you want to display certain characters which won't work such as < and &, so you need to use html entities 
* to display them.
*/

$string_containing_less_than = 'It is a fact that 5 < 8';
$string_containing_h1 = '<h1>This is a title</h1>';
$string_containing_script = "<script>alert('Hello!');</script>";
$string_containing_ampersand = '&';
$string_containing_symbols = '©ª«¬ ®âã';

function htmlentities_vs_htmlspecialchars($str){
	echo "BASIC STRING: " . $str;
	var_dump($str);
	echo "STRING WITH HTMLENTITIES: " . htmlentities($str);
	var_dump(htmlentities($str));
	echo "STRING WITH HTMLSPECIALCHARS: " . htmlspecialchars($str);
	var_dump(htmlspecialchars($str));
}

htmlentities_vs_htmlspecialchars($string_containing_less_than); // BOTH print to screen but encodes to 'It is a fact that 5 &lt; 8'
htmlentities_vs_htmlspecialchars($string_containing_h1); // BOTH prints the html literally to the screen eg. <h1>This is a title</h1>. Doesn't run the html. Encodes to '&lt;h1&gt;This is a title&lt;/h1&gt;'
htmlentities_vs_htmlspecialchars($string_containing_script); // BOTH prevents script running but prints script on screen.
htmlentities_vs_htmlspecialchars($string_containing_ampersand); // BOTH prints correctly to screen but encodes to '&amp;'
htmlentities_vs_htmlspecialchars($string_containing_symbols); // ENTITIES gives '&copy;&ordf;&laquo;&not; &reg;&acirc;&atilde;' whereas SPECIALCHARS gives '©ª«¬ ®âã'

/*
* ENT QUOTES
* See example with and without ENT_QUOTES - Ensures that single quotes gets encoded safely. 
*/

$string_single_quote = "He is known as the 'Clever One'";
echo htmlentities($string_single_quote); // 'He is known as the 'Clever One'' 
echo "<br>" . htmlentities($string_single_quote, ENT_QUOTES); // 'He is known as the 'Clever One'' 

var_dump(htmlentities($string_single_quote)); // 'He is known as the 'Clever One'' 
var_dump(htmlentities($string_single_quote, ENT_QUOTES)); // 'He is known as the &#039;Clever One&#039;'


