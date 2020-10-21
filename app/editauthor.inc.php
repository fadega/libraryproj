<?php

/*
This script performs an update/edit on the data stored in the authors table
*/
//First check if the fields are set - required fields(all of them - hence the && instead of || )
if(isset($_POST['firstname'])&& isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['update-author'])){

        require '../app/dbh.php';
        //store data in variables
        $firstname  =    $_POST['firstname'];
        $lastname   =    $_POST['lastname'];
        $email      =    $_POST['email'];
        $id         =    $_POST['update-author'];

        //store the variable data into an array
        $details = [
            'fname' => $firstname,
            'lname' => $lastname,
            'emailId' => $email,
            'uid' => $id
          ];

            //attempt to update with UPDATE command inside try-catch block
            try{
              $sql = "UPDATE author SET firstname=:fname, lastname=:lname, email=:emailId WHERE author_id=:uid";
              $stmt= $conn->prepare($sql);
              $stmt->execute($details);
              $count = $stmt->rowCount();
              //count is the number of affected rows by the command, if 0 - no update has taken place
              if($count == 0){
                  $status = false;
              }
              else{
                  $status= true;
              }
              if($status){
                //if statusis true (number of affected rows is >0), data has been updated
                  header('Location:../templates/author.php?authorupdate=success&count='.$count);
                  exit();
              }else{
                //if status is true (number of affected rows is >0), data has NOT been updated
                header('Location:../templates/author.php?authorupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
              //throw exception if it occurs during the update attempt
                header("Location:../templates/author.php?authorupdate=dberr&errType=".$e->getMessage());
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
  //a trial to access this url in a forbidden way
  header('Location:../templates/index.php?error=illegal-update-attempt');
  exit();
}
 ?>
