
<?php

require '../app/header.php';?>

<main>

  <?php if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
     <h1>Add Author</h1>
        <?php
          //check for error messages
          if(isset($_GET['error'])){
            if($_GET['error']=="emptyfields"){
              echo '<p style="color:red">All fields are required.</p>';
            }else if($_GET['error']=="invaliddata"){
              echo '<p style="color:red">Invalid data, check your entries.</p>';
            }else if($_GET['error']=="invalidfname"){
              echo '<p style="color:red">First name should not contain numbers or special characters</p>';
            }else if($_GET['error']=="invalidlname"){
              echo '<p style="color:red">Last name should not contain numbers or special characters</p>';
            }else if($_GET['error']=="invalidEmail"){
              echo '<p style="color:red">Invalid email.</p>';
            }else if($_GET['error']=="authoralreadyexist"){
              echo '<p style="color:red">Author with this email arlready exists.</p>';
            }
          }else if(isset($_GET['adding'])){
            echo '<p style="color:green">Author added successfully!</p>';
          }


         ?>

        <form name="my-form" action="../app/author.inc.php" method="post">
            <div class="form-box">
                <label for="fname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="First name" required >
            </div>

            <div class="form-box">
                <label for="lname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Last name" required>
            </div>
            <div class="form-box">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Author email" required>
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="add-author">Add Author</button>
                <span class="span"> You want to add a book? <a href="../templates/book.php">Add book</a> </span>
            </div>


        </form>
      <?php }else{
        //if a user isn't signedin, s/he will see this

           echo
              '  <h2><br>Access denied ..</h2>
                 <p><br>Oops! You are not authorized. Please signin
                 <a href="../templates/signin.php">here</a>
                 <span> Or singup <a href="../templates/signup.php">here</a> </span></p>';


           }//END of SESSION CHECK
          ?>
    </main>>


<?php require '../app/footer.php';?>
