<?php

require '../app/dbh.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];

      $sql = 'DELETE FROM publisher WHERE publisher_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // return $stmt->rowCount();
       $count = $stmt->rowCount();
       header('Location:../templates/publisher.php?delete=success&deletedid='.$id);
       exit();

}else{
  header("Location:../templates/publisher.php?error=illegal-delete-request");
  exit();
}
 ?>
