<?php // This open the php code section

session_start();  // connects to the session for session inforamtion.

require_once "assets/common.php";
require_once "assets/dbconn.php";

if (isset($_SESSION['userid'])) {  // checks to see if already logged in
    $_SESSION['usermessage'] = "ERROR: You have already logged in!";  // redirects them with an errory message if they are.
    header("Location: index.php");
    exit;  // this is needed to ensure that no other code executes.
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
    $usr = login(dbconnect_insert(), $_POST["email"]);  // does it here to ensure we can use parts of the data if successful

    if ($usr && password_verify($_POST["password"], $usr["password"])) { // verifies the password is matched
        audtitor(dbconnect_insert(),$usr["userid"],"LGI", "User has successfully logged in");  // audit logs the login
        $_SESSION["userid"] = $usr["userid"];  // stores the user ID in the session data
        $_SESSION['usermessage'] = "SUCCESS: User Successfully Logged In";  // sets a success message
        header("location:index.php");  //redirect on success
        exit;  // ensures no other code it attempted.
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
    } catch(PDOException $e) {
        $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
        header("Location: login.php");
        exit;
    } catch(Exception $e) {
        $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
        header("Location: login.php");
        exit;
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

echo "<br>";

echo usermessage();

echo "<br>";

echo "<p class='content'> Please Enter the needed credentials below! </p>";

echo "<form action='' method='post'>";
echo"<br>";
echo "<input type='email' name='email' placeholder='E-mail Address' required/>";
echo"<br>";
echo "<input type='password' name='password' placeholder='Password' required/>";
echo"<br>";

echo "<input type='submit' name='submit' value='Login' />";

echo "</form>";



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>