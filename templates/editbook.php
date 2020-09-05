
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


$id= $_GET['id'];

//To push data to the textfields from
$sql = 'SELECT *FROM book WHERE book_id=:id';
$stmt = $conn->prepare($sql);
$stmt->execute([':id'=>$id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$isbn = $result['ISBN'];
$year = $result['year'];
$year = $result['year'];
$cover = $result['cover'];
$price = $result['price'];
$condition = $result['condition'];

$bid = $_GET['id'];

?>

<main>
        <h1>Update book </h1>
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

        <form name="my-form" action="../app/editBook.inc.php" method="post">
            <div class="form-box">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $result['title'] ;?>" required >
            </div>

            <div class="form-box">
              <label for="author">Author</label>
                  <select name="author" id="author_id" required>
                    <?php
                    $id=0;
                      while($result = $authStmt->fetch(PDO::FETCH_ASSOC)){?>
                            <option value="<?php echo (int)$result['author_id'];?>"><?php echo $result['firstname'];?></option>

                  <?php }  ?>
                  </select>
            </div>

            <div class="form-box">
                <label for="ISBN">ISBN</label>
                <input type="text" id="isbn" name="isbn" value = "<?php echo (isset($isbn))?$isbn:'';?>"  required >
            </div>

            <div class="form-box">
              <label for="publisher">Publisher</label>
                  <select name="publihser" id="publishers_id" required>
                        <?php
                          while($result = $pubStmt->fetch(PDO::FETCH_ASSOC)){?>
                                <option value="<?php echo (int)$result['publisher_id'];?>"><?php echo $result['pname'];?></option>
                      <?php } ?>
                  </select>
            </div>

            <div class="form-box">
              <label for="category">Category</label>
                  <select name="category" id="category_id" required >
                  <?php
                      while($result = $catStmt->fetch(PDO::FETCH_ASSOC)){?>
                            <option value="<?php echo (int)$result['category_id'];?>"><?php echo $result['cname'];?></option>
            <?php } ?>

                  </select>
            </div>

            <div class="form-box">
              <label for="genre">Genre</label>
                  <select name="genre" id="genre_id" required>
                    <?php
                    while($result = $genStmt->fetch(PDO::FETCH_ASSOC)){?>
                          <option value="<?php echo (int)$result['genre_id'];?>"><?php echo $result['gname'];?></option>
            <?php } ?>

                  </select>
            </div>

            <div class="form-box">
                <label for="year">Year</label>
                <input type="text" id="year_id" name="year" value="<?php echo (isset($year))?$year:'';?>" required>
            </div>

            <div class="form-box">
                <label for="cover">Cover</label>
                <input type="text" id="cover" name="cover" value="<?php echo (isset($cover))?$cover:'';?>" >
            </div>

            <div class="form-box">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="<?php echo (isset($price))?$price:'';?>" required>
            </div>

            <div class="form-box">
              <label for="condition">Condition</label>
                  <select name="condition" id="condition">
                        <?php
                            if($condition=='Used'){?>
                              <option  value="<?php echo $condition;?>"><?php echo $condition ;?></option>
                              <option  value="New">New</option>
                            <?php }else{?>
                              <option  value="<?php echo $condition;?>"><?php echo $condition ;?></option>
                              <option  value="Used">Used</option>
                          <?php  }   ?>

                  </select>
            </div>

            <div class="form-box">
                <button type="submit" id="btnSend" name="idupdateBook"  value="<?php echo $bid;?>">Update Book</button>
                <!-- <span class="span"> You want to add an author? <a href="../templates/author.php">Add author</a> </span> -->
            </div>


        </form>
    </main>


<?php require '../app/footer.php';?>
