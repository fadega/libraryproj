<?php

	if(ISSET($_POST['add-author'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

    //get user input
		$firstname  =  $_POST['firstname'];
		$lastname   =  $_POST['lastname'];
		$email      =  $_POST['email'];


    //1. Basic validation Rules
		$error = validateAuthor($firstname, $lastname, $email);
	  if ($error !== ""){
			header("Location:../templates/author.php?error=".$error);
			exit();

		}
		else {
	      //create a 	query and call a function to check if record already exists
				$query = "SELECT  *FROM `author` WHERE email = :unique";
				$exist = checkRecord($query, $email);

				if($exist){
					header("Location:../templates/author.php?error=authoralreadyexist");
          exit();
				}else{

          try{
						//call function to insert data to author table
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

    } //Validations last "else" block

} //End of "ISSET" block
else{
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
