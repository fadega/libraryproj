
<?php  require '../app/header.php';
       require '../app/dbh.php';

       $stmt = $conn->prepare('SELECT *FROM book');
       $stmt->execute();
?>

<main>

  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
        <h1>Add comment </h1>
        <p style="color:#023047;">I know, commenting like this is weird but  we will pace this somewhere else later</p>

        <?php
          //check for error messages
          if(isset($_GET['error'])){
                if($_GET['error']=="emptyfields"){
                  echo '<p style="color:red">All fields are required.</p>';
                }else if($_GET['error']=="invaliddata"){
                    echo '<p style="color:red">Invalid data.</p>';
                }else if($_GET['error']=="genrealreadyexists"){
                    echo '<p style="color:red">Genre already exist.</p>';
                }
            }else if(isset($_GET['added'])){
              //echo '<script> alert("Genre added successfuly!")</script>';
              echo '<p style="color:green">Genre added successfuly!</p>';
            }

     ?>


        <form name="my-form" action="../app/comment.inc.php" method="post">
            <div class="form-box">
                <label for="user">Email</label>
                <input type="exmail" id="email" name="email" placeholder="youremail@example.com" required >
            </div>

            <div class="form-box">
              <label for="book">Book</label>
                  <select name="book" id="book_id">
                        <option>Select a book ..</option>
                        <?php while($res = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                            <option value=" <?php echo $res['book_id'] ?> "> <?php echo $res['title'] ?> </option>

                        <?php } ?>

                  </select>
            </div>

            <div class="form-box">
                <label for="comment">Comment</label>
                <textarea placeholder="Your comment ..." id="comment" name="comment" rows="4" cols="50" required></textarea>
            </div>



            <div class="form-box">
                <button type="submit" id="btnSend" name="submit">Publish comment</button>

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
