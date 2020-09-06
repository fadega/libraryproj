
<?php  require '../app/header.php';
    require '../app/dbh.php';

    $id= $_GET['id'];

    //To push data to the textfields from
    $sql = 'SELECT *FROM publisher WHERE publisher_id=:id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);



?>

<main>

  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>


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

        <form name="my-form" action="../app/editpublisher.inc.php" method="post">
            <h1>Add Publisher</h1>
            <div class="form-box">
                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" value="<?php echo $result['pname'] ;?>" required>
            </div>

            <div class="form-box">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo $result['city'] ;?>" required >
            </div>

            <div class="form-box">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" value="<?php echo $result['country'] ;?>" required >
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="updatepublisher" value="<?php echo$id;?>">Update Publisher</button>
                <!-- <span class="span"> Already have an account? <a href="signin.php">Singin here</a> </span> -->
            </div>

        </form>


        <br><hr><br>
        <h3>Publishers Table</h3>

        <table class="db-table">
        <tr>

            <th>ID </th>
            <th>Publisher name </th>
            <th>City </th>
            <th>Country </th>
            <th>Action</th>
        </tr>

        <?php

        $sql ='SELECT *FROM publisher';

        $res = $conn->prepare($sql);
        // $res = $conn->prepare('SELECT * FROM book');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($data);
        foreach($data as $row):?>
          <tr>

            <td><?php echo $row['publisher_id'];?></td>
            <td><?php echo $row['pname'];?></td>
            <td><?php echo $row['city'];?></td>
            <td><?php echo $row['country'];?></td>
            <td>
               <a class="edit" href="../templates/editpublisher.php?id=<?php echo $row['publisher_id'];?>">Edit</a>
               <a class="delete" href="../templates/deletepublisher.php?id=<?php echo $row['publisher_id'];?>">Delete</a>
            </td>
          </tr>

        <?php endforeach; ?>
        </table>

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
