
<?php
  /*
    This script will receive user data for logging and perform basic forntend
    validation before it passes the data to corresponding script(signin.inc.php)
    which performs serverside validation and executes the loggin process.
  */
  require '../app/header.php'; ?>

<main>

      <?php
        //check for error messages - basic front end validation
        if(isset($_GET['error'])){
          //if any error is found, redirect to login again,
              if($_GET['error']=="emptyfields"){
                echo '<p style="color:red">Both fields are required.</p>';
              }else if($_GET['error']=="invalidlogin"){
                  echo '<p style="color:red">Invalid login details.</p>';
              }else if($_GET['error']=="nosuchuser"){
                  echo '<p style="color:red">Oh, it doesn\'t seem you are registered, <a href="signup.php">signup here.</a></p>';
              }
          } //if no error during loggin attempt, then login the user.
          else if(isset($_GET['login'])){
            if($_GET['login']=="success"){
              echo '<script> alert("Logged in successfuly, click to  continue!")</script>';
            }
          }

           ?>
        <!-- This contains the signin form -->
       <form name="my-form" action="../app/signin.inc.php" method="post">
         <h1>Sign in</h1>
           <div class="form-box">
               <label for="email">Email</label>
               <input type="email" id="email" name="emailId" placeholder="Email" required>
           </div>
           <div class="form-box">
               <label for="pass">Password</label>
               <input type="password" id="pass" name="pwd" placeholder="Password" required>
           </div>

           <div class="form-box">
               <button type="submit" id="btnSend" name="login">Signin</button>
               <span class="span"> Don't have an account? <a href="signup.php">Signup here</a> </span>
           </div>


       </form>

       <?php include '../templates/placeholder.html'; ?>
   </main>




<?php  require '../app/footer.php'; ?>
