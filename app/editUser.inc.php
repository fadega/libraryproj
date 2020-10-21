<?php

/*
    This script updates the user data in user table
*/

if(isset($_POST['firstname'])&& isset($_POST['lastname']) && isset($_POST['email'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        $firstname  =    $_POST['firstname'];
        $lastname   =    $_POST['lastname'];
        $email      =    $_POST['email'];
        $id         =    $_POST['idupdate'];


        $details = [
            'fname' => $firstname,
            'lname' => $lastname,
            'emailId' => $email,
            'uid' => $id
          ];

            try{
              $sql = "UPDATE user SET firstname=:fname, lastname=:lname, email=:emailId WHERE user_id=:uid";
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
                  header('Location:../templates/index.php?update=success&count='.$count);
                  exit();
              }else{
                header('Location:../templates/index.php?update=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
                // header("Location:../templates/index.php?update=failed&errType=".$e->getMessage());
                // exit();
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
