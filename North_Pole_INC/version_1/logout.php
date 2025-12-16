<?php
session_start();

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database
try {
    audtitor(dbconnect_insert(), $_SESSION["userid"], "LGO", "User has successfully logged out");
} catch (Exception $e){
    $_SESSION['usermessage'] = $e->getMessage();
    header("Location: index.php");
    exit;
}

session_destroy();

header("location: index.php?message=SUCCESS: You have been logged out!");
