<?php

	/*
		This script checks for user input in the username and password fields and
	*/


	if(ISSET($_POST["login"])){

		// In the line below, we are requiring
		require_once 'dbh.php';

	    //get user input
		$email      = strtolower($_POST['emailId']);
		$password   =  $_POST['pwd'];


			//This if statement checks if password or email is empty, throws error if any field is empty
	    if(empty($email)||empty($password)){
	     	 header("Location:../templates/signin.php?error=emptyfields&email=".$email);
	      	exit();
	    }else{
	      //check if the user exists in the user table
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
	      	if(!empty($result)){ //Check if a result has returned (user with such email)
				//check uf
				if (!password_verify($password, $result['password'])) {
					header("Location:../templates/signin.php?error=invalidlogin");
					exit();
				}else{

					//The user exists, create a session and log the user
					session_start();
					$_SESSION['userId']    = $result['user_id'];
					$_SESSION['useremail'] = $result['email'];
					$_SESSION['firstname'] = $result['firstname'];

					echo "<script> alert(".$result['level'].")</script>";
					if($result['level']=='admin'){
						header("Location:../templates/dashboard.php?adminlogin=success");
					}else{
						header("Location:../templates/index.php?userlogin=success");
					}
				}
	     	}else{
				//if no user exists with such details, redirect back to signin and pass nosuchuser parameter
				header("Location:../templates/signin.php?error=nosuchuser");
				exit();
			}

	    } //END OF ELSE for the the password and username empty check



	}else{ // IF $_POST['login'] is not set, then redirect user to index
		  header("Location:../templates/index.php?error=illegalloginrequest");
      exit();
	}
