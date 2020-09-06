<?php


if(isset($_POST['firstname'])&& isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['update-author'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        $firstname  =    $_POST['firstname'];
        $lastname   =    $_POST['lastname'];
        $email      =    $_POST['email'];
        $id         =    $_POST['update-author'];


        $details = [
            'fname' => $firstname,
            'lname' => $lastname,
            'emailId' => $email,
            'uid' => $id
          ];

            try{
              $sql = "UPDATE author SET firstname=:fname, lastname=:lname, email=:emailId WHERE author_id=:uid";
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
                  header('Location:../templates/author.php?authorupdate=success&count='.$count);
                  exit();
              }else{
                header('Location:../templates/author.php?authorupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
                header("Location:../templates/author.php?authorupdate=dberr&errType=".$e->getMessage());
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
