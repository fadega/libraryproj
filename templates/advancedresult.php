<?php
require '../app/header.php';
require '../app/dbh.php';
require '../app/libcommon.php';

/*
 This script handles advanced search results. Users can search by book Title,
 author, isbn or all. Using this feature without specifying input will result
 getting all the data in the book table.

 This is one of the scripts that implement tricky feature

*/
?>


<div class="main-container">
<h2> Advanced Search Results</h2>

<?php
  if(isset($_POST['advanced-search'])){
      //Get user search input
      $title = $_POST['searched-title'];
      $author = $_POST['searched-author'];
      $isbn = $_POST['searched-isbn'];

      //check if title is being searched
      if(isset($_POST['searched-title'])){

        //Query the tables with the user input title
        $sqlTitle = 'SELECT * From book WHERE title LIKE :title';
        $stmTitle = $conn->prepare($sqlTitle);
        $stmTitle->execute(['title' => '%'.$title.'%']);
        $resTitle= $stmTitle->fetchAll();
        ?>
        <div class="book-container">

        <?php
        //if the query returns a result, display relevant information
        if ($resTitle) {

          foreach ($resTitle as $rowT) {

            //For each result, display the cover, title,and ISBN from table book
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $rowT['cover'] ).'" class="responsive"/><br>' . $rowT['title'].'<br>'. $rowT['ISBN'].'<br>';

            //the search also should include firstname from the author  table
            $auth_id = $rowT['author_id'];
            $sql = 'SELECT firstname FROM author WHERE author_id LIKE :authorid';
            $stmAuthor = $conn->prepare($sql);
            $stmAuthor->execute(['authorid' => '%'.$auth_id.'%']);
            $resAuthor = $stmAuthor->fetchAll(PDO::FETCH_ASSOC);

            //For each result in the book table, its matching author from author's table will be fetched and the loop exist
            foreach($resAuthor as $row){
               echo $row['firstname'].'<br>';
               break; //break to go the next Title which will match the next author(firstname)
             }


          }
        } else {
          echo '<p>No Results</p>';
            }

      }else if(isset($_POST['searched-author'])){
          $sqlAuth = 'SELECT * From author WHERE firstname LIKE :name';
          $stmAuth = $conn->prepare($sqlAuth);
          $stmAuth->execute(['name' => '%'.$author.'%']);
          $resAuth= $stmAuth->fetchAll();
          ?>
          <div class="book-container">

          <?php

          if ($resAuth) {

            foreach ($resAuth as $row) {
              $count=0;
              $auth_id = $row['author_id'];
              $sql = 'SELECT * FROM book WHERE title LIKE :title';
              $stmTitle = $conn->prepare($sql);
              $stmTitle->execute(['title' => '%'.$title.'%']);
              $resTitle = $stmTitle->fetchAll(PDO::FETCH_ASSOC);
              foreach($resTitle as $rowT){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $rowT['cover'] ).'" class="responsive"/><br>' . $rowT['title'].'<br>'. $rowT['ISBN'].'<br>';
                break;
              }
              echo $row['firstname'].'<br>';

            }
        } else {
            echo '<p>No Results</p>';
              }

    }


  }?>
</div>


</div> <!--END of Main container -->
