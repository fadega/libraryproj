
<?php require '../app/header.php'; ?>



<main>


      <?php
        //check for error messages
        if(isset($_GET['error'])){
              if($_GET['error']=="emptyfields"){
                echo '<p style="color:red">Both fields are required.</p>';
              }else if($_GET['error']=="invalidlogin"){
                  echo '<p style="color:red">Invalid login details.</p>';
              }else if($_GET['error']=="nosuchuser"){
                  echo '<p style="color:red">Oh, it doesn\'t seem you are registered, <a href="signup.php">signup here.</a></p>';
              }
          }
          else if(isset($_GET['login'])){
            if($_GET['login']=="success"){
              echo '<script> alert("Logged in successfuly, click to  continue!")</script>';
            }
          }

           ?>

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
           <!-- <div class="form-box">
               <label for="forgot"></label>
               <span  class="span-left"> Forgot <a href="../templates/forgot-password.php"> password?</a> </span>
           </div> -->




       </form>
   </main>




<?php  require '../app/footer.php'; ?>
