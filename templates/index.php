
<?php
  /*
    This is the index page, it just includes many files and contains the
    advanced search fields
  */
  require '../app/header.php';
  require '../app/dbh.php';
  require '../app/libcommon.php';
?>


  <div class="main-container" >

   <?php include '../templates/herosection.php';


        // This query will pull  books, their publishers, categories, genre and price from different tables
        // $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname, cover
        //                 FROM book b, author a, publisher p, category c, genre g
        //                 WHERE b.author_id = a.author_id AND
        //                       b.publisher_id = p.publisher_id AND
        //                       b.category_id = c.category_id AND
        //                       b.genre_id = g.genre_id';
        //
        // $res = $conn->prepare($sql);
        // $res->execute();?>
          <p></p>


          <!-- This code block below is the front end for the advanced search fields -->
          <div class="advanced-search">
            <h2>Advanced search</h2>
            <form action="../templates/advancedresult.php" method="post">
              <div class="label-fields">
                <div class="labels">
                    <label for="searched-title">Title</label>
                    <label for="searched-author">Author</label>
                    <label for="searched-isbn">ISBN</label>
                </div>

                <div class="fields">
                  <input type="text" name="searched-title" placeholder="book title">
                  <input type="text" name="searched-author" placeholder="author name">
                  <input type="text" name="searched-isbn" placeholder="ISBN">
                </div>
              </div>
              <input type="submit" name="advanced-search" value="Search">
            </form>


          </div>


        <h3>Discount on new arrivals ..</h3>

        <?php include '../templates/booklist.php';
        include '../templates/placeholder.html';   ?>

  </div><!--END main-container-->

<?php include '../app/footer.php';?>
