<?php
session_start();

// will unset the session once the user logs out 
if (isset($_SESSION["llwuser"])) {
    unset($_SESSION["llwuser"]);
}

// will unset the session once the admin logs out
if (isset($_SESSION["llwadmin"])) {
    unset($_SESSION["llwadmin"]);
}

// after logout will redirect back to the login page
header("Location: login.php");
