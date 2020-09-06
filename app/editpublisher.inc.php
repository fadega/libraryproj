<?php


if(isset($_POST['publisher'])&& isset($_POST['city']) && isset($_POST['country']) && isset($_POST['updatepublisher'])){
        // require '../templates/libcommon.php';
        require '../app/dbh.php';
        $publisher  =    $_POST['publisher'];
        $city       =    $_POST['city'];
        $country    =    $_POST['country'];
        $id         =    $_POST['updatepublisher'];


        $details = [
            'publisher' => $publisher,
            'city' => $city,
            'country' => $country,
            'uid' => $id
          ];

            try{
              $sql = "UPDATE publisher SET pname=:publisher, city=:city, country=:country WHERE publisher_id=:uid";
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
                  header('Location:../templates/publisher.php?publisherupdate=success&count='.$count);
                  exit();
              }else{
                header('Location:../templates/publisher.php?publisherupdate=failed&count='.$count);
                exit();
              }

            }catch(PDOException $e){
                header("Location:../templates/publisher.php?publisherupdate=dberr&errType=".$e->getMessage());
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
