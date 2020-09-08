
<?php
require '../app/header.php';
require '../app/dbh.php';
require '../app/libcommon.php';
?>


  <div class="main-container" >
   <?php  include '../templates/herosection.php';?>



          <?php
          if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>
                <p>Welcome, you're loggedin</p>
                <h3>Users-Table</h3>
                <table class="db-table">
                  <tr>
                      <th> ID </th>
                      <th> First Name </th>
                      <th> Last Name </th>
                      <th> Email </th>
                      <th> Level </th>
                      <th> Action </th>
                  </tr>

                <?php

                $res = $conn->prepare('SELECT * FROM user');
                $res->execute();
                $data = $res->fetchAll(PDO::FETCH_ASSOC);


               foreach($data as $row):?>
                    <tr>
                      <td><?php echo $row['user_id'];?></td>
                      <td><?php echo $row['firstname'];?></td>
                      <td><?php echo $row['lastname'];?></td>
                      <td><?php echo $row['email'];?></td>
                      <td><?php echo $row['level'];?></td>
                      <td>
                         <a class="edit" href="editUser.php?id=<?php echo $row['user_id'];?>">Edit</a>
                         <a class="delete" href="deleteUser.php?id=<?php echo $row['user_id'];?>">Delete</a>
                      </td>
                    </tr>

                  <?php endforeach; ?>
                </table>

                  <br><hr>





            <?php

          }else{
            echo '<p>Not loggedin <a href="../templates/signup.php"> signup</a> to see data!</p>';
            echo '<p>Please run the install script(once) to be able to signup and signin to see data or sign up in the above link</p>';
            ?>

            <h3>Books-Table</h3>
            <table class="db-table">
              <tr>

                  <th>Title </th>
                  <th>Author </th>
                  <th>Publisher </th>
                  <th>Category </th>
                  <th>Genre</th>
                  <th>Year</th>
                  <!-- <th>Price</th> -->
                  <th>Action</th>
              </tr>

            <?php

            $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname
                            FROM book b, author a, publisher p, category c, genre g
                            WHERE b.author_id = a.author_id AND
                                  b.publisher_id = p.publisher_id AND
                                  b.category_id = c.category_id AND
                                  b.genre_id =g.genre_id';

            $res = $conn->prepare($sql);
            // $res = $conn->prepare('SELECT * FROM book');
            $res->execute();
            $data = $res->fetchAll(PDO::FETCH_ASSOC);
            // echo '<pre>';
            // print_r($data);
           foreach($data as $row):?>
                <tr>

                  <td><?php echo $row['title'];?></td>
                  <td><?php echo $row['firstname'];?></td>
                  <td><?php echo $row['pname'];?></td>
                  <td><?php echo $row['cname'];?></td>
                  <td><?php echo $row['gname'];?></td>
                  <!-- <td><?php //echo $row['year'];?></td> -->
                  <td><?php echo '$'.$row['price'];?></td>

                  <td>
                     <a class="edit" href="../templates/editbook.php?id=<?php echo $row['book_id'];?>">Edit</a>
                     <a class="delete" href="../app/deletebook.php?id=<?php echo $row['book_id'];?>">Delete</a>
                  </td>
                </tr>

              <?php endforeach; ?>
            </table>

          <?php //include '../templates/dashboard.php';
          }

  include '../templates/placeholder.html';
        ?>

  </div><!--END main-container-->

<?php include '../app/footer.php';?>
