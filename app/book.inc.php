<?php


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
    $bookCover        =  $_POST['cover'];
    $bookPrice        =  $_POST['price'];
    $bookCondition    =  $_POST['condition'];

    //call a function to validate input- function in libcommon.php script
		$error = validateBook($bookTitle,$bookISBN,$bookYear,$bookPrice);

		if($error !==""){
			header('Location:../templates/book.php?error='.$error);
			exit();
		}else{
			//call a function that checks if the book already exists
			$query = "SELECT  *FROM `book` WHERE ISBN = :unique";
			$exist = checkRecord($query, $bookISBN);

			if($exist){
				header("Location:../templates/book.php?error=bookalreadyexists");
				exit();
			}else{
				//call a function to isert data - inserData is a function in libcommon.php script
				try{
					insertData("INSERT INTO `book` (title, author_id, ISBN, publisher_id,category_id,genre_id,year,cover,price,condition)
					    VALUES(:tit, :auth, :isb, :pub,:cat,:gen, :yr,:covphoto,:prc,:cond)", array(
						':tit'=>$bookTitle,':auth'=>$bookAuthor,':isb'=>$bookISBN,':pub'=>$bookPublisher,
						':cat'=>$bookCategory,':gen'=>$bookGenre,':yr'=>$bookYear,':covphoto'=>$bookCover,':prc'=>$bookPrice,':cond'=>$bookCondition));


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
    echo "illegal access";
  }
