<?php // This open the php code section

session_start();

require_once "assets/common.php";
require_once "assets/dbconn.php";

if (isset($_SESSION['userid'])) {
    $_SESSION['usermessage'] = "ERROR: You have already logged in!";
    header("Location: index.php");
    exit;
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usr = login(dbconnect_insert(), $_POST["email"]);

    if ($usr && password_verify($_POST["password"], $usr["password"])) { // verifies the password is matched
        $_SESSION["userid"] = $usr["userid"];
        $_SESSION['usermessage'] = "SUCCESS: User Successfully Logged In " . $_SESSION['userid'];
        audtitor(dbconnect_insert(),$_SESSION["userid"],"log", "User has successfully logged in");
        header("location:index.php");  //redirect on success
        exit;
    } elseif(!$usr) {
        $_SESSION['usermessage'] = "ERROR: User not found";
        header("Location: login.php");
        exit; // Stop further execution
    }else {
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

echo "<title>Version 2</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";
echo "<br>";

echo "<h2> Primary Oaks - User Login System</h2>";  # sets a h2 heading as a welcome

echo "<p class='content'> Please Enter the needed credentials below! </p>";

echo "<form action='' method='post'>";
echo"<br>";
echo "<input type='email' name='email' placeholder='E-mail Address' required/>";
echo"<br>";
echo "<input type='password' name='password' placeholder='Password' required/>";
echo"<br>";

echo "<input type='submit' name='submit' value='Login' />";

echo "</form>";

echo "<br>";

echo usermessage();

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>