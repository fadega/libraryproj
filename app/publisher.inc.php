<?php


	if(ISSET($_POST['submit'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

    //get user input
		$publisher  =  strtolower($_POST['publisher']);
		$city       =  strtolower($_POST['city']);
		$country    =  strtolower($_POST['country']);


 	//Call function validatePublisher to validate the input
		$error = validatePublisher($publisher, $city, $country);

	 if($error !==""){
		  //if error exists, notify the specific error to user
		   header("Location:../templates/publisher.php?error=".$error);
			 exit();
	  }else {
  			//call a function that checks if the user already exists
				$query = "SELECT  *FROM `publisher` WHERE pname = :unique";
				$exist = checkRecord($query, $publisher);

			if($exist){
					print_r($exist);
          header("Location:../templates/publisher.php?error=publisheralreadyexists");
          exit();
        }else{
          //hash password before your push it to database
          try{
						insertData("INSERT INTO `publisher` (pname, city, country) VALUES(:name, :city, :country)", array(
							':name'=>$publisher,':city'=>$city,':country'=>$country));

            header('Location:../templates/publisher.php?added=success');
          }catch(Exception $e){
            header("Location:../templates/publisher.php?error=parameterIssue&PDOMessage=".$e->getMessage());
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
