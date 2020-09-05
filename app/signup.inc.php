templates<?php


	if(ISSET($_POST['submit'])){
    require_once 'dbh.php';
		require_once 'libcommon.php';

    //get user input
		$firstname  =  $_POST['firstname'];
		$lastname   =  $_POST['lastname'];
		$email      =  strtolower($_POST['email']);
		$password   =  $_POST['password'];
    $repatePass =  $_POST['repeat-pass'];

	  //hash password using BCRYPT
		$hashedPass = password_hash($password, PASSWORD_DEFAULT);

		//Call function validateUser to validate user input
		$error = validateUser($firstname, $lastname, $email, $password,$repatePass);

	 if($error !==""){
		   header("Location:../templates/signup.php?error=".$error);
			 exit();
	  }else {
  			//call a function that checks if the user already exists
				$query = "SELECT  *FROM `user` WHERE email = :unique";
				$exist = checkRecord($query, $email);

			if($exist){
          header("Location:../templates/signup.php?error=useralreadyexists");
          exit();
        }else{
          //hash password before your push it to database
          try{
						$dt = date('d/m/Y');
						$level = "standard";

						insertData("INSERT INTO `user` (firstname, lastname, email, password,level,regDate) VALUES(:firstname, :lastname, :email, :password, :level,:regDate)", array(
							':firstname'=>$firstname,':lastname'=>$lastname,':email'=>$email,':password'=>$hashedPass,':level'=>$level,':regDate'=>$regDate));

            //signup successful - redirect user to profile.php
						session_start();
						$_SESSION['emailId']   = $_POST['email'];
						$_SESSION['password']  = $_POST['password'];
						$_SESSION['firstname'] = $_POST['firstname'];
            header('Location:../templates/index.php?signup=success');
          }catch(Exception $e){
            header("Location:../templates/signup.php?error=parameterIssue&PDOMessage=".$e->getMessage());
            exit();
          }
          //close connection anywhere
            $conn = null;

        }

    } //Validations last "else" block

} //End of "ISSET" block
else{
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
