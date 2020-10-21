
<?php
    /*
    This script enables authorized users to pass data to publisher.inc.php to insert details
    to publisher table. It also display publisher details if any exist already.
    */
    require '../app/header.php';
    require '../app/dbh.php';

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

        <form name="my-form" action="../app/publisher.inc.php" method="post">
            <h1>Add Publisher</h1>
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

        /*
          code block below will display publisher details if database contains publishers yet
        */

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
            <td><?php echo ucwords($row['pname']);?></td>
            <td><?php echo ucwords($row['city']);?></td>
            <td><?php echo ucwords($row['country']);?></td>
            <td>
               <a class="edit" href="../templates/editpublisher.php?id=<?php echo $row['publisher_id'];?>">Edit</a>
               <a class="delete" href="../app/deletepublisher.php?id=<?php echo $row['publisher_id'];?>">Delete</a>
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


           include '../templates/placeholder.html';
          ?>
    </main>>


<?php require '../app/footer.php';?>
