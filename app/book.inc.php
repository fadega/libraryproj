<?php
		/*
			 This script receives user data, calls validate fuction(to validate user input), calls check function
			 to check if record already exists, and calls insert function to insert data to author table.
		*/

	if(ISSET($_POST['save'])){
    require_once 'dbh.php';
		require_once '../app/libcommon.php';

  //Accepting user input from the form
		$bookTitle        =  $_POST['title'];
		$bookAuthor       =  $_POST['author'];
		$bookISBN         =  $_POST['isbn'];
		$bookPublisher    =  $_POST['publihser'];
    $bookCategory     =  $_POST['category'];
    $bookYear         =  $_POST['year'];
    $bookGenre        =  $_POST['genre'];
    $bookPrice        =  $_POST['price'];
    $bookCondition    =  $_POST['condition'];


    /*These following three lines of code will receive cover photo for a book
			Note: I am not validating types of files to be uploaded / no part of the data is executed so no security risky
			The insertion of this cover image happens with the insert command down in this script
		*/
		$name = $_FILES['image']['name'];
		$type = $_FILES['image']['type'];
		$coverImage = file_get_contents($_FILES['image']['tmp_name']);

    //call a function to validate input- function in libcommon.php script
		$error = validateBook($bookTitle,$bookISBN,$bookYear,$bookPrice);

		if($error !==""){
				header('Location:../templates/book.php?error='.$error);
				exit();
		}
		else{
			//call a function that checks if the book already exists
				$query = "SELECT  *FROM `book` WHERE ISBN = :unique";
				$exist = checkRecord($query, $bookISBN);

			if($exist){
				header("Location:../templates/book.php?error=bookalreadyexists");
				exit();
			}else{
				/*if checkRecord function doesn't find previous record with the user input,
				a call to insertData function is made to  isert data (inserData is a function in libcommon.php script)
				*/
					try{
							insertData("INSERT INTO `book` (title, author_id, ISBN, publisher_id,category_id,genre_id,year,cover,price,condition)
							    VALUES(:tit, :auth, :isb, :pub,:cat,:gen, :yr,:covphoto,:prc,:cond)", array(
									':tit'=>$bookTitle,':auth'=>$bookAuthor,':isb'=>$bookISBN,':pub'=>$bookPublisher,
									':cat'=>$bookCategory,':gen'=>$bookGenre,':yr'=>$bookYear,':covphoto'=>$coverImage,':prc'=>$bookPrice,':cond'=>$bookCondition));

							header('Location:../templates/book.php?added=success');
							exit();
					}catch(Exception $e){
							header("Location:../templates/book.php?error=parameterIssue&PDOMessage=".$e->getMessage());
							exit();
					}
					//close connection
					$conn = null;
			}
		}


  }else{
		// if 'save' button is NOT  clicked, a forbidden attempt has taken place to reach the url
    echo "illegal access";
  }
