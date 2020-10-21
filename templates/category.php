
<?php
 require '../app/header.php';
 require '../app/dbh.php';

 /*
    This script enables authorized users to pass data to category table to be inserted
    This is the gateway script to the actual script that executes the insert command.
 */
?>

<main>
  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>

        <?php
          //check for error messages
          if(isset($_GET['error'])){
                if($_GET['error']=="emptyfields"){
                  echo '<p style="color:red">The field is required.</p>';
                }else if($_GET['error']=="invaliddata"){
                    echo '<p style="color:red">Invalid data.</p>';
                }else if($_GET['error']=="categoryalreadyexists"){
                    echo '<p style="color:red">Category already exist.</p>';
                }
            }else if(isset($_GET['added'])){
              echo '<p style="color:green">Category added successfuly!</p>';
            }

     ?>

        <form name="my-form" action="../app/category.inc.php" method="post">
          <h1>Add Category</h1>

            <div class="form-box">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" placeholder="Category Name" >
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="submit">Add Category</button>
                <!-- <span class="span"> Already have an account? <a href="signin.php">Singin here</a> </span> -->
            </div>

        </form>

        <br><hr><br>
        <h3>Category - Table</h3>

        <table class="db-table">
        <tr>

            <th>ID </th>
            <th>Category name </th>
            <th>Action</th>

        </tr>

        <?php

        $sql ='SELECT *FROM category';

        $res = $conn->prepare($sql);
        // $res = $conn->prepare('SELECT * FROM book');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($data as $row):?>
          <tr>

            <td><?php echo $row['category_id'];?></td>
            <td><?php echo $row['cname'];?></td>

            <td>
               <a class="edit" href="../templates/editcategory.php?id=<?php echo $row['category_id'];?>">Edit</a>
               <a class="delete" href="../app/deletecategory.php?id=<?php echo $row['category_id'];?>">Delete</a>
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
