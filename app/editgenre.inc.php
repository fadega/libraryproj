<?php
/*
  this script updates the genre table
*/
// all fields are required and ussing && instead of ||
if(isset($_POST['genre'])&& isset($_POST['updategenre']) && isset($_POST['category'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        //get data on fields into variables
        $genre    =    $_POST['genre'];
        $category = $_POST['category'];
        $id       =    $_POST['updategenre'];

        //debug code
        //print_r($_POST);

        //put field data into an array for easy binding during execute() statement
        $details = [
            'genre' => $genre,
            'category'=>$category,
            'uid' => $id
          ];

          //try catch block of update command to the genre table
            try{
              $sql = "UPDATE genre SET gname=:genre,category_id=:category WHERE genre_id=:uid";
              $stmt= $conn->prepare($sql);
              $stmt->execute($details);
              $count = $stmt->rowCount();

              //check if number of affected rows
              if($count == 0){
                  $status = false;
              }
              else{
                  $status= true;
              }

              //check if number of rows is 1 or 0
              if($status){
                  header('Location:../templates/genre.php?genreupdate=success&count='.$count);
                  exit();
              }else{
                header('Location:../templates/genre.php?genreupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
                header("Location:../templates/genre.php?genreupdate=dberr&errType=".$e->getMessage());
                exit();
            }?>
            <div class="">
              <?php
              //debug code
              // echo $status.'<br><pre>';
              // print_r($_POST); ?>

            </div>
            <?php

}else{
  header('Location:../templates/index.php?error=illegal-update-attempt');
  exit();
}
 ?>
