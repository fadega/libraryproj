<?php
	/*
		 This script receives user data, calls validate fuction(to validate user input), calls check function
		 to check if record already exists, and calls insert function to insert data to author table.
	 */

	if(ISSET($_POST['submit'])){
	    require_once 'dbh.php';
			require_once '../app/libcommon.php';

	    //get user input [conversion of the user input to small letters for checking purposes]
			$category   =  strtolower($_POST['category']);



	 	//Call function validateCategory to validate the input \ the function is in libcommon.php script
			$error = validateCategory($category);

		 if($error !==""){
			  //if error exists, notify the specific error to user
			   header("Location:../templates/category.php?error=".$error);
				 exit();
		  }else {
	  			//call a function that checks if the user already exists
					$query = "SELECT  *FROM `category` WHERE cname = :unique";
					$exist = checkRecord($query, $category);

				if($exist){
							//if a category already exits, then it will notify the user that it exists
		          header("Location:../templates/category.php?error=categoryalreadyexists");
		          exit();
	        }else{
	          //if no such category is already in the database, it will call the insertData function in libcommon
		          try{
									insertData("INSERT INTO `category` (cname) VALUES(:name)", array(
										':name'=>$category));

			            header('Location:../templates/category.php?added=success');

						  }catch(Exception $e){

			            header("Location:../templates/category.php?error=parameterIssue&PDOMessage=".$e->getMessage());
			            exit();
		          }

	          //close connection
	            $conn = null;

	        }

	    } //End of Error checker if block

} //End of "ISSET" block
else{
	//access of the file without clicking the submit button is forbidden
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
