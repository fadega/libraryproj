<?php
  require 'dbh.php';

  if (isset($_POST['login']))
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT  *FROM `user` WHERE email = :email and password = :password LIMIT 1");
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password',  $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    //What the user typed/entered
/*
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT  *FROM `user` WHERE email = :email and password = :password LIMIT 1");
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password',  $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    */
   //  if(!empty($result)){
   //    header("Location:../templates/index.php");
   //   exit();
   // }else{
   //   echo "Email :".$result['email']."<br>";
   //   echo "email :".$result['password'];
   // }
    //What is coming from the database:
    // echo "Email :".$result['email']."<br>";
    // echo "email :".$result['password'];

    // if ($stmt->rowCount() > 0){
    //     $res = $stmt->fetch(PDO::FETCH_ASSOC);
    //     // $row_id = $check['id'];
    //     // do something
    //     echo "<pre>";
    //     print_r($res);
    // }else{
    //     echo "No user with such details";
    // }

//}else{
  //  echo "you came here illegally";
    //header("Location:../templates/index.php");
   // exit();
//}


?>
