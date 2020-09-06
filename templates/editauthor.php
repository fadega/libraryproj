
<?php

require '../app/header.php';
require '../app/dbh.php';

$id= $_GET['id'];

//To push data to the textfields from
$sql = 'SELECT *FROM author WHERE author_id=:id';
$stmt = $conn->prepare($sql);
$stmt->execute([':id'=>$id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<main>

  <?php if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>

        <?php

        //Update related error checks and messages
          if(isset($_GET['authorupdate'])){
            if(GET['authorupdate']=="success"){
              echo '<p style="color:green">Author details updated successfully!</p>';


            }else if($_GET['authorupdate']=="failed"){
              echo '<p style="color:red">Oops! Author details weren\'t updated - update failed!</p>';

            }else if($_GET['authorupdate']=="dberr"){
              echo '<p style="color:red">Error: database related error!</p>';

            }
          }

         ?>

        <form name="my-form" action="../app/editauthor.inc.php" method="post">
           <h1>Edit Author</h1>
            <div class="form-box">
                <label for="fname">First name</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $result['firstname'] ;?>" required >
            </div>

            <div class="form-box">
                <label for="lname">Last name</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $result['lastname'] ;?>" required>
            </div>
            <div class="form-box">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $result['email'] ;?>" required>
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="update-author" value="<?php echo$id;?>">Update Author</button>
                <!-- <span class="span"> You want to add a book? <a href="../templates/book.php">Add book</a> </span> -->
            </div>


        </form>

        <br><hr><br>
        <h3>Authors-Table</h3>

        <table class="db-table">
        <tr>

            <th>ID </th>
            <th>First name </th>
            <th>Last name </th>
            <th>Email </th>
            <th>Action</th>
        </tr>

        <?php

        $sql ='SELECT *FROM author';

        $res = $conn->prepare($sql);
        // $res = $conn->prepare('SELECT * FROM book');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($data);
        foreach($data as $row):?>
          <tr>

            <td><?php echo $row['author_id'];?></td>
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['lastname'];?></td>
            <td><?php echo $row['email'];?></td>
            <td>
               <a class="edit" href="../templates/editauthor.php?id=<?php echo $row['author_id'];?>">Edit</a>
               <a class="delete" href="../templates/deleteauthor.php?id=<?php echo $row['author_id'];?>">Delete</a>
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
