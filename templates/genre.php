
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
          <h1>Add Genre</h1>
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

        <br><hr><br>
        <h3>Genre - Table</h3>

        <table class="db-table">
        <tr>

            <th>ID </th>
            <th>Genre </th>
            <th>Category </th>
            <th>Action</th>
        </tr>

        <?php

        $sql ='SELECT genre_id, gname, cname
                        FROM genre g, category c
                        WHERE g.category_id = c.category_id';

        $res = $conn->prepare($sql);
        // $res = $conn->prepare('SELECT * FROM book');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($data);
        foreach($data as $row):?>
          <tr>

            <td><?php echo $row['genre_id'];?></td>
            <td><?php echo  ucfirst($row['gname']);?></td>
            <td><?php echo  ucfirst($row['cname']);?></td>
            <td>
               <a class="edit" href="../templates/editgenre.php?id=<?php echo $row['genre_id'];?>">Edit</a>
               <a class="delete" href="../app/deletegenre.php?id=<?php echo $row['genre_id'];?>">Delete</a>
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
