<?php


	if(ISSET($_POST['submit'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

    //get user input
		$category   =  strtolower($_POST['category']);



 	//Call function validateCategory to validate the input
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
					// print_r($exist);
          header("Location:../templates/category.php?error=categoryalreadyexists");
          exit();
        }else{
          //hash password before your push it to database
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
  header("Location:../templates/index.php?error=tried-illegal-access");
  exit();
}

?>
