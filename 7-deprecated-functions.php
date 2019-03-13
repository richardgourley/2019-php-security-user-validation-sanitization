<?php
/*
* DEPRECATED FUNCTIONS
* Never use the following functions!  They have been deprecated and are no longer used or considered safe.
* The PDO class is the preferred method for interaccting with databases.
* These are from older versions of PHP. PHP 7 no longer has these functions.
*/

//1. MYSQL CLASS
// MySQL extension, which was deprecated in PHP 5.5.0 and removed entirely in PHP 7.0.0.
// NEVER USE: mysql_query("INSERT INTO `table` (`column`) VALUES ('$unsafe_variable')");

//2. MAGIC QUOTES
// Deprecated - one size fits all sanitization of data caused problems.
// magic_quotes_gpc()