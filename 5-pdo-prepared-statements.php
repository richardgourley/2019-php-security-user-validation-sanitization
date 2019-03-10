<?php
/*
* PREPARED STATEMENTS WITH PDO
* The majority of developers recommend using PDO instead of MySqli, although MySqli can still be used.
* Binding parameters to prepared statements is the key to preventing SQL injection attacks:
* Any parameters you send when using a prepared statement will just be treated as strings
*/

$lh = ''; //name of localhost 
$db = ''; //database name 
$un = ''; //username 
$pw = ''; //password

$conn = new PDO("mysql:host=" . $lh . ";dbname=" . $db,$un,$pw);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // real prepared statements not used by default - fixes this.
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //optional, gives more detailed error messages.

/*
* PREPARED STATEMENTS - FIRST WAY - BIND USING '?'
*/

$book_title = '15 minute meals';
$id_num = 275;

$query = "SELECT * FROM books WHERE book_title = ? OR id_num = ?";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $book_title, PDO::PARAM_STR);
$stmt->bindParam(2, $book_title, PDO::PARAM_INT);

/*
* PREPARED STATEMENTS - SECOND WAY - BIND USING ':'
*/

$query = "SELECT * FROM books WHERE book_title = :book_title OR category_id = :category_id";
$stmt = $conn->prepare($query);
$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);
$stmt->bindValue(':category_id', $id_num, PDO::PARAM_INT);

/*
* EXECUTE STATEMENT AND GET RESULTS
*/

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // use fetch() for a single result. Use FETCH_NUMERIC instead of an assoc array.
$conn = null;
$stmt = null;