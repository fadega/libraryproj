<?php

  /*
    This is the page that display search results for the simple search. This is
    linked with the autocomplete search feature. The search is based on book title
  */
  require_once '../app/dbh.php';

  if (isset($_POST['submit'])) {
    $title = $_POST['search'];

    // query the database with data that the user has entered
    $sql = "SELECT *
                  FROM book
                  LEFT JOIN author
                  ON book.author_id = author.author_id
                  LEFT JOIN publisher
                  ON book.publisher_id = publisher.publisher_id
                  WHERE book.title = '{$title}'
                  OR author.firstname = '{$title}'
                  OR publisher.pname ='{$title}'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
  } else {
    header('location: .');
    exit();
  }
?>
<?php require '../app/header.php'; ?>


        <div class="main-container">
          <h2>Result for your search ...</h2>
          <div id = "book-searched">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['cover'] ).'"/>';?>
            <p><b>Publisher</b>: <span><?php echo $row['pname']; ?></span></p>
            <p><b>Year</b>: <span><?php echo $row['year']; ?></span></p>
            <p><b>Price</b>: <span><?php echo '$'.$row['price']; ?></span></p>


          </div>


        <?php include '../templates/placeholder.html'; ?>
      </div>

      <script>

      </script>

<?php require '../app/footer.php'; ?>
