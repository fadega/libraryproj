<?php
    session_start();
    $count=0;

    /*
this is the most used script along with footer script. This contains the menu,
the styles, ajax library link
    */
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
  </head>
  <body>
    <nav>
      <!-- This is the navigation bar - menu bar -->
      <div class="content">
        <h1><a href="../templates/index.php"> BookStore</a></h1>
        <div class="links">

          <?php
            // based on whether you're logged in or not, you will see different parts of the menu
            //Here is you are signed you will see signout, dashbaord and your name
            if(isset($_SESSION['useremail'])||isset($_SESSION['firstname'])){
              echo ' <a href="../app/signout.inc.php">Signout</a>';
              echo ' <a href="../templates/profile.php"><span> <img src="" alt=""></span> <b>'.$_SESSION['firstname'].'</b></a>';
              echo '<a href="../templates/dashboard.php">Dashboard<span class="cart-notify cart" id="cart-quantity"></span> </a>';
            }else{
              // if not loggedin you will see signin and singup buttons

              echo '<a name="signin-submit" href="../templates/signin.php">Signin</a>';
              echo '<a name="log-submit" href="../templates/signup.php">Signup</a>';
            }
             ?>

        </div>
        <!-- This icon for closing and opening menu for small devices -->
        <i class="material-icons menu button" onclick="collapse()">menu</i>
      </div>

      <!-- hamburger menu for small screens -->
      <div class="dropdown">

        <?php
          if(isset($_SESSION['useremail'])||isset($_SESSION['firstname'])){
            echo ' <a href="../app/signout.inc.php">Signout</a>';
            echo ' <a href="../templates/profile.php"><span> <img src="" alt=""></span>'.$_SESSION['firstname'].'</a>';
            echo '<a href="../templates/dashboard.php">Dashboard<span class="cart-notify cart"></span></a>';
          }else{
            echo '<a name="signin-submit" href="../templates/signin.php">Signin</a>';
            echo '<a name="log-submit" href="../templates/signup.php">Singup</a>';
          }
         ?>

      </div>
    </nav>

    <div class="secondary-menu" id="secondary-menu">
      <!-- This is the secondary menu for users to access all features if authorized -->
      <div id="link-wrapper">
          <a href="../templates/author.php">Authors</a>
          <a href="../templates/book.php">Books</a>
          <a href="../templates/publisher.php">Publishers</a>
          <a href="../templates/category.php">Categories</a>
          <a href="../templates/genre.php">Genre</a>
          

          <form class="search-from" action="../templates/searchResults.php" method="post">
              <input type="text" name="search"  id="search" placeholder="Search by title...">
              <input type="submit" name="submit" value="Search">
              <!-- <a href="../app/search.php" name="sumbit" class="btn-search-top" style="margin:15px 0px 0px -50px;border:none;"> <img src="../templates/imgs/search.png" style="margin:top:20px;" alt=""> </a> -->
          </form>

       </div>

       <div id="search-result">
         <div class=""></div>
         <div class="actual-result" id="show-list">
           <!-- Dynamic search list will show up here -->
         </div>

       </div>

    </div>

<?php

  ?>
