<?php
session_start();

session_destroy();

header("location:index.php?message=You have been logged out!");
