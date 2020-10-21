<?php
  require_once '../app/dbh.php';

  /*
    This is the script that performs the autocomplete feature along
    with the javascript code in main.js.
  */

  if (isset($_POST['query'])) {
    //receive every input that user types on a text field through ajax
    $inpText = $_POST['query'];
    $sql = 'SELECT title FROM book WHERE title LIKE :title';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['title' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    //if there is a match, loop through it and display it on the front end as a list
    if ($result) {
      foreach ($result as $row) {
        echo '<li>'.$row['title'].'</li>';

      }
    } else {
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }


?>
