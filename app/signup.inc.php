<?php


	if(ISSET($_POST['submit'])){
    require_once 'dbh.php';
		require_once 'libcommon.php';

    //get user input from the frontend
		$firstname  =  $_POST['firstname'];
		$lastname   =  $_POST['lastname'];
		$email      =  strtolower($_POST['email']);
		$password   =  $_POST['password'];
    $repatePass =  $_POST['repeat-pass'];

	  //hash password using BCRYPT
		$hashedPass = password_hash($password, PASSWORD_DEFAULT);

		//Call function validateUser to validate user input - the function is in libcommon.php
		$error = validateUser($firstname, $lastname, $email, $password,$repatePass);

	 if($error !==""){
		 //if error is returned from the validate function, then respond with the error and redirect
		   header("Location:../templates/signup.php?error=".$error);
			 exit();
	  }else {
  			//get the user and check it against the existing users -by checkRecord function
				$query = "SELECT  *FROM `user` WHERE email = :unique";
				$exist = checkRecord($query, $email);

			if($exist){
				//if user already exist, let the user know and redirect
          header("Location:../templates/signup.php?error=useralreadyexists");
          exit();
        }else{
          // if user doesn't  exist yet, hash password before your push it to database
          try{
						//get current date and static user level
						$dt = date('d/m/Y');
						$level = "standard";
						//call insertData function and store data
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
