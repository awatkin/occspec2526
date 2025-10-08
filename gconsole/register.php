<?php // This open the php code section

session_start();

require_once "assets/common.php";
require_once "assets/dbconn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(!only_user(dbconnect_insert(), $_POST["username"])){

        if(reg_user(dbconnect_insert(),$_POST)) {
            audtitor(dbconnect_insert(),getnewuserid(dbconnect_insert(), $_POST['username']), "reg","New user registered");
            $_SESSION["usermessage"] = "USER CREATED SUCCESSFULLY";
            header("Location: login.php");
            exit;

        } else {
            $_SESSION["usermessage"] = "ERROR: USER REGISTRATION FAILED";
        }
    } else {
        $_SESSION["usermessage"] = "ERROR: USERNAME CANNOT BE USED";
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


echo "<h1> G Console Register </h1>";

echo "<br>";

echo "<p id='intro'>Welcome to the home of tracking the consoles you own</p>";

echo "<form method='post' action=''>";

echo "<input type='text' name='username' placeholder='Username'>";
echo "<br>";
echo "<input type='password' name='password' placeholder='Password'>";
echo "<br>";
echo "<input type='text' name='signup' placeholder='Sign Up Date'>";
echo "<br>";
echo "<input type='text' name='dob' placeholder='Date of Birth'>";
echo "<br>";
echo "<input type='text' name='country' placeholder='Country'>";
echo "<br>";
echo "<input type='submit' name='submit' value='Register'>";

echo "</form>";

echo "<br>";
echo "<br>";

echo user_message();


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>