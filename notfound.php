<?php
require '../app/header.php';
require '../app/dbh.php';

?>

<div class="main-container">
  <div style="text-align:center;">
    <h2 >404 - The page your requested doesn't exist.</h2>
    <a href="../templates/index.php">Return to home page</a>
  </div>

</div>

<?php
require '../app/footer.php';
?>

<?php
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
include("notFound.php");
?>
