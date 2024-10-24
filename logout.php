<?php
session_start(); // Start the session

// Destroy the session
session_destroy();

// Redirect to signin page
header('Location: signin.php');
exit();
?>
