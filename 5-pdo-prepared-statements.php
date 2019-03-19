<?php
/*
* PREPARED STATEMENTS WITH PDO
* Binding parameters to prepared statements is the key to preventing SQL injection attacks!
* PDO is the newest class. MySqli can be used but PDO allows for connections to various databases - oracle, mariadb etc.
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
* PREPARED STATEMENTS - FIRST WAY - BIND USING '?' 
*/

$book_title = 'Food from around the world';
$year = 2008;

$query = "SELECT * FROM classics WHERE title = ? OR year = ?";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $book_title, PDO::PARAM_STR);
$stmt->bindParam(2, $year, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // use fetch() for single result. 

/*
* PREPARED STATEMENTS - SECOND WAY - BIND USING ':' 
*/

$author = "Claire"; $title = "Claire's book 3"; $book_year = 2013; $isbn = "734283489";

$query2 = "INSERT INTO classics (author, title, year, isbn) VALUES (:author, :title, :year, :isbn)";
$stmt2 = $conn->prepare($query2);
$stmt2->bindParam(':author', $author, PDO::PARAM_STR);
$stmt2->bindParam(':title', $title, PDO::PARAM_STR);
$stmt2->bindParam(':year', $book_year, PDO::PARAM_INT);
$stmt2->bindParam(':isbn', $isbn, PDO::PARAM_STR);

$success = $stmt2->execute(); // $success = boolean

//CLOSE CONNECTION
$conn = null;
$stmt = null;

