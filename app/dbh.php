<?php
/*
  This one of main scripts of the web application. It handles the creation of
  Sqlite3 database in the app folder
  It runs before all other scripts when the "install.php" script is executed.
  'install.php' is supposed to be executed before anything else or accessing the index.php on a web

 */

$conn = new PDO('sqlite:../app/bookstore.sqlite3');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
if($conn){
  //echo "1. Database creation : Success!\n";
}else{
  echo "Database creation failed!\n";
}
