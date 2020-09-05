
<?php  require '../app/header.php';?>

<main>

  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
        <h1>Add Publisher</h1>

        <?php
          //check for error messages
          if(isset($_GET['error'])){
                if($_GET['error']=="emptyfields"){
                  echo '<p style="color:red">Fill all required fieldsss.</p>';
                }else if($_GET['error']=="invaliddata"){
                    echo '<p style="color:red">Invalid data.</p>';
                }else if($_GET['error']=="publisheralreadyexists"){
                    echo '<p style="color:red">Publisher already exist.</p>';
                }
            }else if(isset($_GET['added'])){
              echo '<p style="color:green">Publisher added successfuly!</p>';
            }

     ?>

        <form name="my-form" action="../app/publisher.inc.php" method="post">
            <div class="form-box">
                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" placeholder="Publisher Name" >
            </div>

            <div class="form-box">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="City /Town" >
            </div>

            <div class="form-box">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" placeholder="Country" >
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="submit">Add Publisher</button>
                <!-- <span class="span"> Already have an account? <a href="signin.php">Singin here</a> </span> -->
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
