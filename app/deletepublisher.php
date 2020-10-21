<?php
/*
 This script deletes an a publisher from the publisher table
*/
require '../app/dbh.php';
if(isset($_GET['id'])){
  //get publisher id
  $id = $_GET['id'];

      $sql = 'DELETE FROM publisher WHERE publisher_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       $count = $stmt->rowCount();
       //check if the number of affected rows in >0
       if($count>0){
         header('Location:../templates/publisher.php?delete=success&deletedid='.$id);
         exit();
       }else{
         echo '<script>alert("publisher not removed!")</script>';
         header('Location:../templates/publisher.php');
         exit();
       }

}else{
  header("Location:../templates/publisher.php?error=illegal-delete-request");
  exit();
}
 ?>
