
<?php
// logout.php


// Start session to manage logout
session_start();


// Destroy session and redirect to the home page
session_destroy();
header("Location: ../templates/index.html");
exit();
?>
