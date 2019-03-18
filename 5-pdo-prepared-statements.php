<?php
/*
* PREPARED STATEMENTS WITH PDO
* The majority of developers recommend using PDO instead of MySqli, although MySqli can still be used.
* Binding parameters to prepared statements is the key to preventing SQL injection attacks:
* Any parameters you send when using a prepared statement will just be treated as strings
*/

$lh = 'localhost'; //name of localhost 
$db = 'publications'; //database name 
$un = 'root'; //username 
$pw = ''; //password

$conn = "";
//try catch block gives devs more specific errors.
try{
	$conn = new PDO("mysql:host=" . $lh . ";dbname=" . $db, $un, $pw);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // real prepared statements not used by default - fixes this.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // gives more detailed error messages.
}catch(PDOException $e){
	throw new Exception($e);
}

/*
* PREPARED STATEMENTS - FIRST WAY - BIND USING '?' AND BINDPARAM
*/

$book_title = 'Food from around the world';
$year = 2008;

$query = "SELECT * FROM classics WHERE title = ? OR year = ?";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $book_title, PDO::PARAM_STR);
$stmt->bindParam(2, $year, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // use fetch() for a single result. Use FETCH_NUMERIC instead of an assoc array.
var_dump($results);

/*
* PREPARED STATEMENTS - SECOND WAY - BIND USING ':' AND BINDVALUE()
*/

$author = "Claire"; $title = "Claire's book 3"; $book_year = 2013; $isbn = "734283489";

$query2 = "INSERT INTO classics (author, title, year, isbn) VALUES (:author, :title, :year, :isbn)";
$stmt2 = $conn->prepare($query2);
$stmt2->bindValue(':author', $author, PDO::PARAM_STR);
$stmt2->bindValue(':title', $title, PDO::PARAM_STR);
$stmt2->bindValue(':year', $book_year, PDO::PARAM_INT);
$stmt2->bindValue(':isbn', $isbn, PDO::PARAM_STR);

$success = $stmt2->execute();
var_dump($success); // boolean true
//$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); 

//CLOSE CONNECTION
$conn = null;
$stmt = null;

//var_dump($results);
//var_dump($results2);