<?php
/*
 This script deletes an a book from the book table
*/
require '../app/dbh.php';

if(isset($_GET['id'])){
  //get the passed id of the book to be deleted
  $id = $_GET['id'];

      $sql = 'DELETE FROM book WHERE book_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // check if affected rows is greater than zero
       $count = $stmt->rowCount();
       if($count>0){
         header('Location:../templates/book.php?delete=success&deletedid='.$id);
         exit();
       }else{
         echo '<script>alert("Book not removed!")</script>';
         header('Location:../templates/book.php');
         exit();
       }

}else{
  //if a deleted was attempted from a forbidden url
  header("Location:../templates/book.php?error=illegal-delete-request");
  exit();
}
 ?>
