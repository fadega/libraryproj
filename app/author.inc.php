<?php
 		/*
  		This script receives user data, calls validate fuction(to validate user input), calls check function
			to check if record already exists, and calls insert function to insert data to author table.
 		*/

	if(isset($_POST['add-author'])){
	    require_once '../app/dbh.php';
			require_once '../app/libcommon.php';

	    //Accepting user input from the form
			$firstname  =  $_POST['firstname'];
			$lastname   =  $_POST['lastname'];
			$email      =  $_POST['email'];


    /* Basic validation Rules
		 	call validateAuthor - function in libcommo.php to valid user input. If this function return no error,
			then a checkRecord function is called
		*/
		$error = validateAuthor($firstname, $lastname, $email);
	  if ($error !== ""){
				header("Location:../templates/author.php?error=".$error);
				exit();
		}
		else {
	      //if no error during input validation - create a 	query and call checkRecord function from libcommon.php to check if record already exists
					$query = "SELECT  *FROM `author` WHERE email = :unique";
					//checkRecord is a function that will check if a user with such email already exists
					$exist = checkRecord($query, $email);

				if($exist){
					  //if a user with such email is found,  a redirect will take place
						header("Location:../templates/author.php?error=authoralreadyexist");
	          exit();
				}else{

	          try{
							//If no record with the similar details exist already - insertData function is called (libcommon.php)
							insertData("INSERT INTO `author` (firstname, lastname, email) VALUES(:firstname, :lastname, :email)", array(
								':firstname'=>$firstname,':lastname'=>$lastname,':email'=>$email));

					    header('Location:../templates/author.php?adding=success');
	          }catch(Exception $e){
							//echo "Issue inserting ".$e->getMessage();
	            header("Location:../templates/author.php?error=parameterIssue");
	            exit();
	          }
	          //close connection anywhere
            $conn = null;

        }

    } //End of Validations last "else" block

} //End of "ISSET" block
else{
	//Client side validation will not allow user to pass and get to this point, but in case he did, he will be redirected
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
