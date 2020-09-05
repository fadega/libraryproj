<?php


	if(isset($_POST['submit'])){
    require_once '../app/dbh.php';
		require_once '../app/libcommon.php';

    //get user input
    $comment  =  $_POST['comment'];
		$email  =  strtolower($_POST['email']);
		$book_id  =  $_POST['book'];
    $date     =  date("d-m-Y");
		print_r($_POST);


 	//Call function calidateComment to validate the input
		$error = validateComment($comment,$user_id,$book_id);

	 if($error !==""){
		  //if error exists, notify the user  the specific error
		   header("Location:../templates/comment.php?error=".$error);
			 exit();
	  }else {
  			//call a function that checks if the user already exists
				$query = "SELECT  *FROM `genre` WHERE gname = :unique";
				$exist = checkRecord($query, $genre);

			if($exist){
					print_r($exist);
          header("Location:../templates/comment.php?error=genrealreadyexists");
          exit();
        }else{
             try{
							 //call function to insert data
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
