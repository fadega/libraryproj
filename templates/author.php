
<?php

require '../app/header.php';
require '../app/dbh.php';

?>

<main>

  <?php if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>

        <?php
          //check for error messages
          if(isset($_GET['error'])){
            if($_GET['error']=="emptyfields"){
              echo '<p style="color:red">All fields are required.</p>';
            }else if($_GET['error']=="invaliddata"){
              echo '<p style="color:red">Invalid data, check your entries.</p>';
            }else if($_GET['error']=="invalidfname"){
              echo '<p style="color:red">First name should not contain numbers or special characters</p>';
            }else if($_GET['error']=="invalidlname"){
              echo '<p style="color:red">Last name should not contain numbers or special characters</p>';
            }else if($_GET['error']=="invalidEmail"){
              echo '<p style="color:red">Invalid email.</p>';
            }else if($_GET['error']=="authoralreadyexist"){
              echo '<p style="color:red">Author with this email arlready exists.</p>';
            }
          }else if(isset($_GET['adding'])){
            echo '<p style="color:green; margin-left:2rem;">Author added successfully!</p>';
          }


         ?>

        <form name="my-form" action="../app/author.inc.php" method="post">
           <h1>Add Author</h1>
            <div class="form-box">
                <label for="fname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="First name" required >
            </div>

            <div class="form-box">
                <label for="lname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Last name" required>
            </div>
            <div class="form-box">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Author email" required>
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="add-author">Add Author</button>
                <span class="span"> You want to add a book? <a href="../templates/book.php">Add book</a> </span>
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
               <a class="delete" href="../app/deleteauthor.php?id=<?php echo $row['author_id'];?>">Delete</a>
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
