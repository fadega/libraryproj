<?php
  require_once '../app/dbh.php';

  if (isset($_POST['submit'])) {
    $title = $_POST['search'];

    //$sql = 'SELECT * FROM book WHERE title = :title';
    // $sql ="SELECT book_id,title ,year, price, firstname, pname
    //                 FROM book b, author a, publisher p
    //                 WHERE b.author_id = a.author_id AND
    //                       b.publisher_id = p.publisher_id AND
    //                       b.title =b.title";

    $sql = "SELECT *
                  FROM book
                  LEFT JOIN author
                  ON book.author_id = author.author_id
                  LEFT JOIN publisher
                  ON book.publisher_id = publisher.publisher_id
                  WHERE book.title = '{$title}'
                  OR author.firstname = '{$title}'
                  OR publisher.pname ='{$title}'";
                  // '{$module}'

                   // "SELECT width FROM modules WHERE code = '".$module."'"

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // ['title' => $title]
    $row = $stmt->fetch();
  } else {
    header('location: .');
    exit();
  }
?>
<?php require '../app/header.php'; ?>


        <div class="main-container">
          <h2>Result for your search ...</h2>
          <div id = "book-details">
            <p><b>Title</b>: <span><?php echo $row['title']; ?></span></p>
            <p><b>Author</b>: <span><?php echo $row['firstname']; ?></span></p>
            <p><b>Publisher</b>: <span><?php echo $row['pname']; ?></span></p>
            <p><b>Year</b>: <span><?php echo $row['year']; ?></span></p>
            <p><b>Price</b>: <span><?php echo '$'.$row['price']; ?></span></p>

          </div>
          <?php include '../templates/placeholder.html'; ?>
      </div>

<?php require '../app/footer.php'; ?>
