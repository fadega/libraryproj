<?php
/*
 This script deletes an a category from the category table
*/
require '../app/dbh.php';
if(isset($_GET['id'])){
  //get the id of the category to be deleted
  $id = $_GET['id'];

      $sql = 'DELETE FROM category WHERE category_id = :id';

       $stmt = $conn->prepare($sql);
       $stmt->bindValue(':id', $id);

       $stmt->execute();

       // check if the number of affected rows are greater than zero
       $count = $stmt->rowCount();
       if($count>0){
         header('Location:../templates/category.php?delete=success&deletedid='.$id);
         exit();
       }else{
         echo '<script>alert("Category not removed!")</script>';
         header('Location:../templates/category.php');
         exit();
       }

}else{
  header("Location:../templates/category.php?error=illegal-delete-request");
  exit();
}
 ?>
