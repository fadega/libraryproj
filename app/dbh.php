<?php
/*
  This one of main scripts of the web application. It handles the creation of
  Sqlite3 database in the app folder
  It runs before all other scripts when the "install.php" script is executed.
  'install.php' is supposed to be executed before anything else or accessing the index.php on a web

 */
//SQLITE CONNECTION
$conn = new PDO('sqlite:../app/bookstore.sqlite3');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
if($conn){
  //echo "1. Database creation : Success!\n";
}else{
  echo "Database creation failed!\n";
}

//MySQL CONNECTION - testing purposes 
$servername = "localhost";
$username = "root";
$password = "passme2020";
$dbname = "ytcommentsystem";

try {
  $mySqlCon = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $mySqlCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "<b>Connected successfully to MySQL db - wow</b>";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

