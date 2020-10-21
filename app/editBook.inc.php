<?php
/*
    This script enables us to edit/update data in the book table.
*/
//start by checking if the update button is clicked
if(isset($_POST['idupdateBook'])){

        require '../app/dbh.php';
        /** Get all passed book details into variables**/
        $bookTitle        =  $_POST['title'];
        $bookAuthor       =  $_POST['author'];
        $bookISBN         =  $_POST['isbn'];
        $bookPublisher    =  $_POST['publihser'];
        $bookCategory     =  $_POST['category'];
        $bookYear         =  $_POST['year'];
        $bookGenre        =  $_POST['genre'];
        $bookCover        =  $_POST['cover'];
        $bookPrice        =  $_POST['price'];
        $bookCondition    =  $_POST['condition'];
        $bookId           = $_POST['idupdateBook'];

        //Put details into associative array for easier binding
        $details = [
            'btitle' => $bookTitle,
            'bauthor' => $bookAuthor,
            'bisbn' => $bookISBN,
            'bpublisher'=> $bookPublisher,
            'bcategory'=> $bookCategory,
            'bgenre'=>$bookGenre,
            'byear'=> $bookYear,
            'bcover'=>$bookCover,
            'bprice'=>$bookPrice,
            'bcondition'=>$bookCondition,
            'bid' => $bookId
          ];
            //Run a update query in a try catch block
            try{
              $sql = "UPDATE book SET title =:btitle, author_id =:bauthor, ISBN =:bisbn, publisher_id =:bpublisher,
                                  category_id =:bcategory, genre_id =:bgenre, year =:byear, cover =:bcover,
                                  price =:bprice, condition =:bcondition
                                  WHERE book_id =:bid";
              $stmt= $conn->prepare($sql);
              $stmt->execute($details);
              //check number of affected rows - it should be 1 at most and 0 a least
              $count = $stmt->rowCount();

              //check if number of affected rows is 0 or 1
              if($count == 0){
                  $status = false;
              }
              else{
                  $status= true;
              }

              //if status is true(count ==1), update has been performed
              if($status){
                  header('Location:../templates/index.php?update=success&count='.$count);
                  exit();
              }else{
                //if status is false(count == 0), update has NOT been perofmed.
                header('Location:../templates/index.php?update=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
              //throw PDO exception if any during the update process
                header("Location:../templates/index.php?update=failed&errType=".$e->getMessage());
                exit();
            }?>
            <div class="">
              <?php
              //debug data
              //echo $status.'<br><pre>';
              //print_r($_POST); ?>

            </div>
            <?php

}else{
  //forbidden attempt to access this url
  header('Location:../templates/index.php?error=illegal-update-attempt');
  exit();
}
 ?>
