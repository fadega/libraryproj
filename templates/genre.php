
<?php  require '../app/header.php';
       require '../app/dbh.php';

       $stmt = $conn->prepare('SELECT *FROM category');
       $stmt->execute();
       // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // echo '<pre>';
       // print_r($res);
?>


<main>

  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
        <h1>Add Genre</h1>

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


        <form name="my-form" action="../app/genre.inc.php" method="post">
            <div class="form-box">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" placeholder="Enter genre name..." >
            </div>

            <div class="form-box">
              <label for="genre">Category</label>
                  <select name="category" id="category_id">
                    <option>Select category..</option>
                        <?php
                           while($res = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                              <option value="<?php echo $res['category_id'] ;?>"><?php echo $res['cname'] ;?></option>
                        <?php } ?>

                    </select>
            </div>
            <div class="form-box">
                <button type="submit" id="btnSend" name="submit-genre">Add Genre</button>
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
