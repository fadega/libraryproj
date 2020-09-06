<?php


if(isset($_POST['category'])&& isset($_POST['updatecategory'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        $category  =    $_POST['category'];
        $id         =    $_POST['updatecategory'];


        $details = [
            'category' => $category,
            'uid' => $id
          ];

            try{
              $sql = "UPDATE category SET cname=:category WHERE category_id=:uid";
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
                  header('Location:../templates/category.php?categoryupdate=success&count='.$count);
                  exit();
              }else{
                header('Location:../templates/category.php?categoryupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
                header("Location:../templates/category.php?categoryupdate=dberr&errType=".$e->getMessage());
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
