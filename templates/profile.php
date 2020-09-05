
<?php
require 'header.php';
require 'dbh.php';

?>
<?php
  //Check if user is authorized to access the page
  if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
        <div class="main-container">
          <h2><br>This is profile page!</h2><br>
          <?php echo 'User:'.$_SESSION['firstname'].'<br>';
                echo 'Email:'.$_SESSION['firstname'].'<br>';
                echo 'Status:Loggedin <br>';
                ?>
                <a href="../templates/signout.inc.php">Signout from here?</a>

        </div>
      <?php }else{
        //if a user isn't signedin, s/he will see this

           echo
              '  <h2><br>Access denied ..</h2>
                 <p><br>Oops! You are not authorized. Please signin
                 <a href="../templates/signin.php">here</a>
                 <span> Or singup <a href="../templates/signup.php">here</a> </span></p>';


           }//END of SESSION CHECK
          ?>



<?php require 'footer.php'; ?>
