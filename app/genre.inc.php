<?php


	if(ISSET($_POST['submit-genre'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

    //get user input
		$genre     =  strtolower($_POST['genre']);
		$category  =  $_POST['category'];



 	//Call function validateCategory to validate the input
		$error = validateGenre($genre,$category);

	 if($error !==""){
		  //if error exists, notify the user  the specific error
		   header("Location:../templates/genre.php?error=".$error);
			 exit();
	  }else {
  			//call a function that checks if the user already exists
				$query = "SELECT  *FROM `genre` WHERE cname = :unique";
				$exist = checkRecord($query, $genre);

			if($exist){
					print_r($exist);
          header("Location:../templates/genre.php?error=genrealreadyexists");
          exit();
        }else{
             try{
							 //call function to insert data
								insertData("INSERT INTO `genre` (cname, category_id) VALUES(:name, :category_id)", array(
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
