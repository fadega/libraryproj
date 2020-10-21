<?php
 /**
  * libcommon.php: this script contains my functions that interact with different parts of the web app.
  * It consists of functions that perform many tasks including userdata validation, insertion of data to all tables,
  */

  /* This function will enter data to any table specified in the query parameter */
function insertData($query, $params=array()){
      $stmt = $GLOBALS['conn']->prepare($query);
      $stmt->execute($params);
}

//This function validates user detailss
function validateUser($firstname, $lastname, $email, $password,$repatePass){
        $error = "";
        if(empty($firstname)|| empty($lastname) || empty($email) || empty($password)){
          $error = "emptyfields";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z\s]+$/',$firstname) && !preg_match('/^[a-zA-Z\s]+$/',$lastname) ){
          $error = "invaliddata";
        }else if(!preg_match('/^[a-zA-Z\s]+$/', $firstname)){
          $error = "invalidfname";
        }else if(!preg_match('/^[a-zA-Z\s]+$/', $lastname)){
          $error = "invalidlname";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $error = "invalidEmail";
        }else if(strlen($password)<4){
          $error = "minpasswordleng";
        }else if ($password !== $repatePass){
          $error = "passwordmismatch";
        }

        return $error;
} // ****END of  validateUser function **//

//This function checks if a record exists(user, author, publisher, etc ..)
function checkRecord($query, $uniqueField){
      try{
          $stmt = $GLOBALS['conn']->prepare($query);
          $stmt->bindValue(':unique', $uniqueField);
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);

      }catch(Exception $e){
          //echo "ISSUE PREPARING STATEMENT : ".$e->getMessage();
          header("Location:../templates/book.php?error=sqlerror&Message=".$e->getMessage());
          exit();
      }
      if(!empty($result)){
          return $result;
          // return true;
      }else{
        return false;
      }

}// ****END of  userExit function **//



/**    Validate author details  **/
function validateAuthor($firstname, $lastname, $email){
      $error = "";
     if(empty($firstname)|| empty($lastname) || empty($email)){
          $error="emptyfields";
      }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z\s]+$/',$firstname) && !preg_match('/^[a-zA-Z\s]+$/',$lastname) ){
         $error = "invaliddata";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$firstname)){//Check for characters outside the alphabets
         $err = "invalidfname";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$lastname)){ //Check for characters outside the regular alphabets
         $error = "invalidlname";
      }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//Validate email
         $error = "invalidEmail";
      }
      return $error;
} /*** END of validateAuthor fucntion **/


//validate publisher
function validatePublisher($publisher, $city, $country){
      $error = "";
      if(empty($publisher)|| empty($city) || empty($country)){
        $error="emptyfields";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$publisher)|| !preg_match('/^[a-zA-Z\s]+$/',$city) || !preg_match('/^[a-zA-Z\s]+$/',$country)){
        $error = "invaliddata";
      }
      return $error;
} /*** END of validateAuthor fucntion **/

/** validate Category */
function validateCategory($category){
      $error ="";
      if(empty($category)){
        $error = "emptyfields";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$category) ){
        $error = "invaliddata";
      }

      return $error;
}

//validate genre
function validateGenre($genre,$category){
      $error ="";
      if(empty($genre) || empty($category)){
        $error = "emptyfields";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$genre) ){
        $error = "invaliddata";
      }

      return $error;
}

//Validate book
function validateBook($title,$ISBN,$year,$price){
      $error = "";
      if(empty($title) || empty($ISBN) || empty($year) || empty($price)){
        $error="emptyfields";
      }else if(!preg_match('/^[a-zA-Z\&\'\s]+$/',$title)){
        $error ="invalidcharsintitle";
      }else if(!preg_match('/^[a-zA-Z0-9\-]+$/',$ISBN)){
        $error ="invalidcharsinISBN";
      }else if($year>2020 || $year<1900){
        $error = "invalidyear";
      }else if(!preg_match("/^[0-9]+(\.[0-9]{2})?$/",$price)){
        $error ='invalidprice';
      }
      return $error;
}

//validate comment
function  validateComment($comment, $user_id, $book_id){
      $error ="";
      if(empty($comment) || empty($user_id)||empty($book)){
        $error = "emptyfields";
      }else if(!preg_match('/^[a-zA-Z\s]+$/',$comment) ){
        $error = "invaliddata";
      }

      return $error;
}
