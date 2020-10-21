<?php

/*
   this script updates the category table
*/
if(isset($_POST['category'])&& isset($_POST['updatecategory'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';

        //Get user data from the fields into the vairables
        $category  =    $_POST['category'];
        $id         =    $_POST['updatecategory'];

        //put the data into associative array for easier binding
        $details = [
            'category' => $category,
            'uid' => $id
          ];

            //attempt to update table inside try-catch block
            try{
              $sql = "UPDATE category SET cname=:category WHERE category_id=:uid";
              $stmt= $conn->prepare($sql);
              $stmt->execute($details);
              $count = $stmt->rowCount();

              //check if the number of affected rows is 1 or 0
              if($count == 0){
                  $status = false;
              }
              else{
                  $status= true;
              }
              if($status){ //an update has been performed
                  header('Location:../templates/category.php?categoryupdate=success&count='.$count);
                  exit();
              }else{ //no update has been performed
                header('Location:../templates/category.php?categoryupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
              //throw any PDO related exception during the execution of the update command 
                header("Location:../templates/category.php?categoryupdate=dberr&errType=".$e->getMessage());
                exit();
            }?>
            <div class="">
              <?php
              //debug data
              // echo $status.'<br><pre>';
              // print_r($_POST); ?>

            </div>
            <?php

}else{
  header('Location:../templates/index.php?error=illegal-update-attempt');
  exit();
}
 ?>
