<?php

/*
	This script populates the genre table
*/
	if(ISSET($_POST['submit-genre'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

    //get user input from the frontend(fields)
		$genre     =  strtolower($_POST['genre']);
		$category  =  $_POST['category'];



 	//Call function validateCategory to validate the input
		$error = validateGenre($genre,$category);

	 if($error !==""){
		  //if error exists, notify the user  the specific error
		   header("Location:../templates/genre.php?error=".$error);
			 exit();
	  }else {
				//Check if this genre is already inserted
				$query = "SELECT  *FROM `genre` WHERE gname = :unique";
				$exist = checkRecord($query, $genre);

				if($exist){
						//if genre exist in the table no need to insert it again
	          header("Location:../templates/genre.php?error=genrealreadyexists");
	          exit();
	        }else{
	             try{
								 //if genre isn't in the genre table, call a function to insert the data
									insertData("INSERT INTO `genre` (gname, category_id) VALUES(:name, :category_id)", array(
										':name'=>$genre,':category_id'=>$category));
			            header('Location:../templates/genre.php?added=success');

	        }catch(Exception $e){
		            header("Location:../templates/genre.php?error=parameterIssue&PDOMessage=".$e->getMessage());
		            exit();
	          }
	          //close connection
	            $conn = null;

	        }

    } //End of Error checker if block

} //End of "ISSET" block
else{
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
