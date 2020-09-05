<?php
    session_start();
    $count=0;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>BookStore</title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
      <link rel="stylesheet" href="../css/menu.css">
      <link rel="stylesheet" href="../css/master.css">
      <link rel="stylesheet" href="../css/dashboard.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
      </script>
  </head>
  </head>
  <body>
    <nav>
      <div class="content">
        <h1><a href="../templates/index.php"> BookStore</a></h1>
        <div class="links">
          <input type="text" class="searchbox" placeholder="Search by Title, Author, or ISBN">
          <a href="../app/search.php" class="btn-search">Search</a>
          <?php
            if(isset($_SESSION['useremail'])||isset($_SESSION['firstname'])){
              echo ' <a href="../app/signout.inc.php">Signout</a>';
              echo ' <a href="../app/profile.php"><span> <img src="" alt=""></span>'.$_SESSION['firstname'].'</a>';
            }else{
              // echo '<a href="#" id="showmodal" name="button">Modal </a>';
              echo '<a name="signin-submit" href="../templates/signin.php">Signin</a>';
              echo '<a name="log-submit" href="../templates/signup.php">Signup</a>';
            }
           ?>
          <a href="#">Cart<span class="cart-notify">0</span> </a>
        </div>
        <i class="material-icons menu button" onclick="collapse()">menu</i>
      </div>

      <div class="dropdown">
        <input type="text" class="searchbox" placeholder="Search by Title, Author, or ISBN">
        <a href="../app/search.php">Search</a>
        <?php
          if(isset($_SESSION['useremail'])||isset($_SESSION['firstname'])){
            echo ' <a href="../app/signout.inc.php">Signout</a>';
            echo ' <a href="../app/profile.php"><span> <img src="" alt=""></span>'.$_SESSION['firstname'].'</a>';
          }else{
            echo '<a name="signin-submit" href="../templates/signin.php">Signin</a>';
            echo '<a name="log-submit" href="../templates/signup.php">Singup</a>';
          }
         ?>
        <a href="#">Cart<span class="cart-notify">0</span></a>
      </div>
    </nav>