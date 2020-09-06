
<?php  require '../app/header.php';
       require '../app/dbh.php';

       $stmt = $conn->prepare('SELECT *FROM book');
       $stmt->execute();
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


        <form name="my-form" action="../app/comment.inc.php" method="post">
            <h1>Add comment </h1>
            <p style="color:#023047;">I know, commenting like this is weird but  we will pace this somewhere else later</p>

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

        <br><hr><br>
        <h3>Comment - Table</h3>

        <table class="db-table">
        <tr>

            <th>ID </th>
            <th>User </th>
            <th>Comment </th>
            <th>Book</th>
            <th>Date Written</th>
            <th>Action</th>
        </tr>

        <?php

        $sql ='SELECT comment_id,comment,firstname,title,dateWritten
                        FROM comment c, user u, book b
                        WHERE c.user_id = u.user_id AND
                              c.book_id = b.book_id';

        $res = $conn->prepare($sql);
        // $res = $conn->prepare('SELECT * FROM book');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($data);
        foreach($data as $row):?>
          <tr>

            <td><?php echo $row['comment_id'];?></td>
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['comment'];?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['dateWritten'];?></td>
            <td>
               <a class="edit" href="../templates/editcomment.php?id=<?php echo $row['comment_id'];?>">Edit</a>
               <a class="delete" href="../templates/deletecomment.php?id=<?php echo $row['comment_id'];?>">Delete</a>
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
