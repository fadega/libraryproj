<?php

/*
 This script deletes an author from the author table
*/

require '../app/dbh.php';
if(isset($_GET['id'])){
  //get the id of the author to be deleted
  $id = $_GET['id'];

      $sql = 'DELETE FROM author WHERE author_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // Check if affected rows is greater than zero
       $count = $stmt->rowCount();
       if($count>0){
         header('Location:../templates/author.php?delete=success&deletedid='.$id);
         exit();
       }else{
         echo '<script>alert("Author not removed!")</script>';
         header('Location:../templates/author.php');
         exit();
       }


}else{
  header("Location:../templates/author.php?error=illegal-delete-request");
  exit();
}
 ?>
