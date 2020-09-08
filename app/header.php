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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
  </head>
  <body>
    <nav>
      <div class="content">
        <h1><a href="../templates/index.php"> BookStore</a></h1>
        <div class="links">

          <!-- <input type="text" class="searchbox" id="search" placeholder="Search by Title, Author, or ISBN">
          <a href="../app/search.php" class="btn-search">Search</a> -->
          <?php
            if(isset($_SESSION['useremail'])||isset($_SESSION['firstname'])){
              echo ' <a href="../app/signout.inc.php">Signout</a>';
              echo ' <a href="../templates/profile.php"><span> <img src="" alt=""></span>'.$_SESSION['firstname'].'</a>';
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
            echo ' <a href="../templates/profile.php"><span> <img src="" alt=""></span>'.$_SESSION['firstname'].'</a>';
          }else{
            echo '<a name="signin-submit" href="../templates/signin.php">Signin</a>';
            echo '<a name="log-submit" href="../templates/signup.php">Singup</a>';
          }
         ?>
        <a href="#">Cart<span class="cart-notify">0</span></a>
      </div>
    </nav>

    <div class="secondary-menu" id="secondary-menu">

      <div id="link-wrapper">

          <a href="../templates/author.php">Authors</a>
          <a href="../templates/book.php">Books</a>
          <a href="../templates/publisher.php">Publishers</a>
          <a href="../templates/category.php">Categories</a>
          <a href="../templates/genre.php">Genre</a>
          <a href="../templates/comment.php">Comments</a>


          <form class="search-from" action="../templates/searchResults.php" method="post">
              <input type="text" name="search"  id="search" placeholder="Search ...">
              <input type="submit" name="submit" value="Search">
              <!-- <a href="../app/search.php" name="sumbit" class="btn-search-top" style="margin:15px 0px 0px -50px;border:none;"> <img src="../templates/imgs/search.png" style="margin:top:20px;" alt=""> </a> -->
          </form>

       </div>

       <div id="search-result">
         <div class=""></div>
         <div class=""></div>
         <div class=""></div>
         <div class="actual-result" id="show-list">
           <!-- <li> Dynamic search list will show up here</li> -->
         </div>

       </div>

    </div>

<?php



  ?>
  <script>
    // AJAX call for autocomplete

    $(document).ready(function () {
      // Send Search Text to the server
      $("#search").keyup(function () {
        let searchText = $(this).val();
        if (searchText != "") {
          $.ajax({
            url: "../app/search.php",
            method: "post",
            data: {
              query: searchText,
            },
            success: function (response) {
              $("#show-list").html(response);
            },
          });
        } else {
          $("#show-list").html("");
        }
      });
      // Set searched text in input field on click of search button
      $(document).on("click", "li", function () {
        $("#search").val($(this).text());
        $("#show-list").html("");
      });
    });


    </script>
