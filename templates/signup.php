
<?php  require '../app/header.php';?>

<main>
        <h1>Sign up</h1>


        <?php
          //check for error messages
          if(isset($_GET['error'])){
              if($_GET['error']=="emptyfields"){
                echo '<p style="color:red">Fill all required fields.</p>';
              }else if($_GET['error']=="invaliddata"){
                echo '<p style="color:red">Invalid data.</p>';
              }else if($_GET['error']=="invalidfname"){
                echo '<p style="color:red">First name should not contain numbers or special characters</p>';
              }else if($_GET['error']=="invalidlname"){
                echo '<p style="color:red">Last name should not contain numbers or special characters</p>';
              }else if($_GET['error']=="invalidEmail"){
                echo '<p style="color:red">Invalid email.</p>';
              }else if($_GET['error']=="useralreadyexists"){
                echo '<p style="color:red">A user with this email arlready exists.</p>';
              }else if($_GET['error']=="minpasswordleng"){
                echo '<p style="color:red">Password should be at least 8 characters long.</p>';
              }else if($_GET['error']=="passwordmismatch"){
                echo '<p style="color:red">Passwords your entered doesn\'t match.</p>';
              }
          }else if(isset($_GET['signup'])){
            echo '<p style="color:green">Signup successful!</p>';
          }


         ?>

        <form name="my-form" action="../app/signup.inc.php" method="post">
            <div class="form-box">
                <label for="fname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="First name" >
            </div>

            <div class="form-box">
                <label for="lname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Last name" required>
            </div>

            <div class="form-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-box">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="password" placeholder="Password" required>
            </div>
            <div class="form-box">
                <label for="repeat-pass">Repeat pass</label>
                <input type="password" id="repeat-pass" name="repeat-pass" placeholder="Repeat password" required>
            </div>
            <div class="form-box">
                <button type="submit" id="btnSend" name="submit">Singup</button>
                <span class="span"> Already have an account? <a href="../templates/signin.php">Singin here</a> </span>
            </div>




        </form>

        <?php include '../templates/placeholder.html'; ?>
    </main>>


<?php require '../app/footer.php';?>
