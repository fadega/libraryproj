<?php
  require_once '../app/dbh.php';

  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT title FROM book WHERE title LIKE :country';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['country' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<li>'.$row['title'].'</li>';
        
      }
    } else {
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }
?>
