<?php

require '../app/dbh.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];

      $sql = 'DELETE FROM genre WHERE genre = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // return $stmt->rowCount();
       $count = $stmt->rowCount();
       header('Location:../templates/genre.php?delete=success&deletedid='.$id);
       exit();

}else{
  header("Location:../templates/genre.php?error=illegal-delete-request");
  exit();
}
 ?>
