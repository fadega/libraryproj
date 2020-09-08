
<?php
require '../app/header.php';
require '../app/dbh.php';


$authStmt = $conn->prepare('SELECT *FROM author');
$authStmt->execute();

$pubStmt = $conn->prepare('SELECT *FROM publisher');
$pubStmt->execute();

$catStmt = $conn->prepare('SELECT *FROM category');
$catStmt->execute();

$genStmt = $conn->prepare('SELECT *FROM genre');
$genStmt->execute();

// $res = $authStmt->fetch(PDO::FETCH_ASSOC);
// $id  = $res['author_id'];

?>

<main>
  <?php
    //Check if user is authorized to access the page
    if(isset($_SESSION['useremail'])||isset($_SESSION['emailId'])){?>

          <?php
        //  check for error messages
          if(isset($_GET['error'])){
            if($_GET['error']=="emptyfields"){
              echo '<p style="color:red">Fill required fields.</p>';
            }else if($_GET['error']=="invalidcharsintitle"){
              echo '<p style="color:red">Title may not contain special characters.</p>';
            }else if($_GET['error']=="invalidcharsinISBN"){
              echo '<p style="color:red">ISBN should only contain numbers, letters,and -</p>';
            }else if($_GET['error']=="invalidyear"){
              echo '<p style="color:red">Year you entered is invalid</p>';
            }else if($_GET['error']=="invalidprice"){
              echo '<p style="color:red">Price should contain numbers and a signle dot only.</p>';
            }
          }
          else if(isset($_GET['added'])){
            echo '<p style="color:green">Book added successfully!</p>';
          }


         ?>

        <form name="my-form" action="../app/book.inc.php" method="post">
          <h1>Add a book </h1>
            <div class="form-box">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Book Title" required >
            </div>

            <div class="form-box">
              <label for="author">Author</label>
                  <select name="author" id="author_id" required>
                    <option >Select author ...</option>
                    <?php
                    $id=0;
                      while($result = $authStmt->fetch(PDO::FETCH_ASSOC)){?>
                            <option value="<?php echo (int)$result['author_id'];?>"><?php echo $result['firstname'];?></option>

                  <?php }
                  $id = $result['author_id'];

                  ?>
                  </select>
            </div>

            <div class="form-box">
                <label for="ISBN">ISBN</label>
                <input type="text" id="isbn" name="isbn" placeholder="ISBN" required>
            </div>

            <div class="form-box">
              <label for="publisher">Publisher</label>
                  <select name="publihser" id="publishers_id" required>
                        <option >Select publisher</option>
                        <?php
                          while($result = $pubStmt->fetch(PDO::FETCH_ASSOC)){?>
                                <option value="<?php echo (int)$result['publisher_id'];?>"><?php echo $result['pname'];?></option>
                      <?php } ?>
                  </select>
            </div>

            <div class="form-box">
              <label for="category">Category</label>
                  <select name="category" id="category_id" required >
                      <option value="">Select a category..</option>
              <?php
                while($result = $catStmt->fetch(PDO::FETCH_ASSOC)){?>
                      <option value="<?php echo (int)$result['category_id'];?>"><?php echo $result['cname'];?></option>
            <?php } ?>

                  </select>
            </div>

            <div class="form-box">
              <label for="genre">Genre</label>
                  <select name="genre" id="genre_id" required>
                      <option value="">Select a genre..</option>
              <?php
                while($result = $genStmt->fetch(PDO::FETCH_ASSOC)){?>
                      <option value="<?php echo (int)$result['genre_id'];?>"><?php echo $result['gname'];?></option>
            <?php } ?>

                  </select>
            </div>

            <div class="form-box">
                <label for="year">Year</label>
                <input type="text" id="year_id" name="year" placeholder="Published year" required>
            </div>

            <div class="form-box">
                <label for="cover">Cover</label>
                <input type="text" id="cover" name="cover" placeholder="Cover /upload" >
            </div>

            <div class="form-box">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" placeholder="$Price" required>
            </div>

            <div class="form-box">
              <label for="condition">Condition</label>
                  <select name="condition" id="condition">
                        <option>Select condition ..</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                  </select>
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="save">Save Book</button>
                <span class="span"> You want to add an author? <a href="../templates/author.php">Add author</a> </span>
            </div>

        </form>

        <br>
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
      // This query will display books, their publishers, categories, genre and price from different tables
      $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname
                      FROM book b, author a, publisher p, category c, genre g
                      WHERE b.author_id = a.author_id AND
                            b.publisher_id = p.publisher_id AND
                            b.category_id = c.category_id AND
                            b.genre_id = g.genre_id';

      $res = $conn->prepare($sql);
      // $res = $conn->prepare('SELECT * FROM book');
      $res->execute();
      while($row = $res->fetch(PDO::FETCH_ASSOC)){?>
          <td><?= $row['title'];?></td>
          <td><?=  $row['firstname'];?></td>
          <td><?=  $row['pname'];?></td>
          <td><?=  $row['cname'];?></td>
          <td><?=  $row['gname'];?></td>
          <td><?= '$'.$row['price'];?></td>

          <td>
             <a class="edit" href="../templates/editbook.php?id=<?php echo $row['book_id'];?>">Edit</a>
             <a class="delete" href="../app/deletebook.php?id=<?php echo $row['book_id'];?>">Delete</a>
          </td>
        </tr>
      <?php  }?>

      </table>





      <?php }else{
        //if a user isn't signedin, s/he will see this

           echo
              '
                 <p><br> You are not signed in,but you can still see books. Please signin
                 <a href="../templates/signin.php">here</a>
                 <span> Or singup <a href="../templates/signup.php">here</a> </span></p>';



              ?>

        <br>
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
      // This query will display books, their publishers, categories, genre and price from different tables
      $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname
                      FROM book b, author a, publisher p, category c, genre g
                      WHERE b.author_id = a.author_id AND
                            b.publisher_id = p.publisher_id AND
                            b.category_id = c.category_id AND
                            b.genre_id = g.genre_id';

      $res = $conn->prepare($sql);
      // $res = $conn->prepare('SELECT * FROM book');
      $res->execute();
      while($row = $res->fetch(PDO::FETCH_ASSOC)){?>
          <td><?= $row['title'];?></td>
          <td><?=  $row['firstname'];?></td>
          <td><?=  $row['pname'];?></td>
          <td><?=  $row['cname'];?></td>
          <td><?=  $row['gname'];?></td>
          <td><?= '$'.$row['price'];?></td>

          <td>
             <a class="edit" href="../templates/editbook.php?id=<?php echo $row['book_id'];?>">Edit</a>
             <a class="delete" href="../app/deletebook.php?id=<?php echo $row['book_id'];?>">Delete</a>
          </td>
        </tr>
      <?php  }?>

      </table>


    <?php } // END of else-check  for the SESSION

    include '../templates/placeholder.html';
    ?>



    </main>


<?php require '../app/footer.php';?>
