<?php
/** This script create the SQLiteDatabase */

$conn = new PDO('sqlite:../app/bookstore.sqlite3');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
if($conn){
  //echo "1. Database creation : Success!\n";
}else{
  echo "Database creation failed!\n";
}
