<?php


if(isset($_POST['genre'])&& isset($_POST['updategenre']) && isset($_POST['category'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        $genre    =    $_POST['genre'];
        $category = $_POST['category'];
        $id       =    $_POST['updategenre'];

        print_r($_POST);


        $details = [
            'genre' => $genre,
            'category'=>$category,
            'uid' => $id
          ];

            try{
              $sql = "UPDATE genre SET gname=:genre,category_id=:category WHERE genre_id=:uid";
              $stmt= $conn->prepare($sql);
              $stmt->execute($details);
              $count = $stmt->rowCount();
              if($count == 0){
                  $status = false;
              }
              else{
                  $status= true;
              }
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
              echo $status.'<br><pre>';
              print_r($_POST); ?>

            </div>
            <?php

}else{
  header('Location:../templates/index.php?error=illegal-update-attempt');
  exit();
}
 ?>
