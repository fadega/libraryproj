<?php


	if(ISSET($_POST["login"])){
    require_once 'dbh.php';

    //get user input
		$email      = strtolower($_POST['emailId']);
		$password   =  $_POST['pwd'];
		echo '<script> alert($password) ;</script>';

    if(empty($email)||empty($password)){
      header("Location:../templates/signin.php?error=emptyfields&email=".$email);
      exit();
    }else{
      //check if the user exists in our user table
      try{
      $stmt = $conn->prepare("SELECT  *FROM `user` WHERE email =:email LIMIT 1");
      $stmt->bindValue(':email', $email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
			echo '<script> alert("PDO Exception") ;</script>';
      echo "PDO Execution Error ".$e->getMessage();
      header("Location:../templates/index.php?error=sqlError");
    }
      if(!empty($result)){//Check if a result has returned (user with such email)
					echo '<script> alert("userfound") ;</script>';
        if (!password_verify($password, $result['password'])) {
          header("Location:../templates/signin.php?error=invalidlogin");
        }else{
          //The user exists, create a session and log the user
          session_start();
          $_SESSION['userId']    = $result['user_id'];
          $_SESSION['useremail'] = $result['email'];
					$_SESSION['firstname'] = $result['firstname'];
          header("Location:../templates/index.php?login=success");
        }
      }else{
				//if no user exists with such details
				header("Location:../templates/signin.php?error=nosuchuser");
				exit();
			}

    }



}else{
  header("Location:../templates/index.php?error=illegalloginrequest");
  exit();
}
