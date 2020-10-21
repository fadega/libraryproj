<?php
/*
This is the simplest script in this application.
It destroys the session and logs out users

*/
session_start();
session_unset();
session_destroy();
header("Location:../templates/index.php?logout=success")

 ?>
