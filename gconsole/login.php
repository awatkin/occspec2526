<?php // This open the php code section
session_start();

require_once"assets/dbconn.php";
require_once"assets/common.php";

if (isset($_SESSION['user'])){
    $_SESSION['usermessage'] = "ERROR: You are already logged in!";
    header("Location: index.php");
    exit; // Stop further execution
}
elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usr = login(dbconnect_insert(), $_POST["username"]);

    if ($usr && password_verify($_POST["password"], $usr["password"])) { // verifies the password is matched
        $_SESSION["user"] = true;  // sets up the session variables
        $_SESSION["userid"] = $usr["user_id"];
        $_SESSION['usermessage'] = "SUCCESS: User Successfully Logged In";
        audtitor(dbconnect_insert(),$_SESSION["userid"],"log", "User has successfully logged in");
        header("location:index.php");  //redirect on success
        exit;
    } else {
        $_SESSION['usermessage'] = "ERROR: User login passwords not match";
        if($usr["user_id"]){
            audtitor(dbconnect_insert(),$usr["user_id"],"flo", "User has unsuccessfully logged in");
        }
        header("Location: login.php");
        exit; // Stop further execution
    }
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> GConsole</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";


echo "<h1> G Console Login </h1>";

echo "<br>";

echo "<p id='intro'>Welcome to the home of tracking the consoles you own</p>";

echo "<form method='post' action=''>";

echo "<input type='text' name='username' placeholder='Username'>";
echo "<br>";
echo "<input type='password' name='password' placeholder='Password'>";
echo "<br>";
echo "<input type='submit' name='submit' value='Login'>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>