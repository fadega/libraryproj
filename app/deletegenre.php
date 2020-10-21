<?php
/*
 This script deletes an a genre from the genre table
*/
require '../app/dbh.php';
if(isset($_GET['id'])){
  //get the id of the genre to be deleted
  $id = $_GET['id'];

      $sql = 'DELETE FROM genre WHERE genre = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // check the number of the affected rows
       $count = $stmt->rowCount();
       if($count>0){
         header('Location:../templates/genre.php?delete=success&deletedid='.$id);
         exit();
       }else{
         echo '<script>alert("Genre not removed!")</script>';
         header('Location:../templates/genre.php');
         exit();
       }


}else{
  header("Location:../templates/genre.php?error=illegal-delete-request");
  exit();
}
 ?>
