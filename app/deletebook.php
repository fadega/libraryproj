<?php

require '../app/dbh.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];

      $sql = 'DELETE FROM book WHERE book_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // return $stmt->rowCount();
       $count = $stmt->rowCount();
       header('Location:../templates/book.php?delete=success&deletedid='.$id);
       exit();

}else{
  header("Location:../templates/book.php?error=illegal-delete-request");
  exit();
}
 ?>
