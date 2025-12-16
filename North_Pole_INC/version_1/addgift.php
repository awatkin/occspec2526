<?php // This open the php code section

session_start();

require_once "assets/common.php";
require_once "assets/dbconn.php";

if (!isset($_SESSION['userid'])) {
    $_SESSION['usermessage'] = "ERROR: You are not logged in!";
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{
            if(reg_gift(dbconnect())) {
                $_SESSION['usermessage'] = "SUCCESS: You have added a gift to the database!";
                audtitor(dbconnect(),$_SESSION['userid'],"GRG", "Registered a new gift to the system");
                header("Location: wishlist.php");
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
            header("Location: wishlist.php");
            exit;
        } catch (Exception $e){
            $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();}
            header("Location: wishlist.php");
            exit;
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> North Pole Inc</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";
echo "<br>";

echo "<h2> Add a gift to the Gift Database </h2>";  # sets a h2 heading as a welcome

echo "<p class='content'> Please complete the below form to register a new gift </p>";

echo "<form action='' method='post'>";
echo"<br>";
echo "<input type='text' name='name' placeholder='Gift Name' required/>";
echo"<br>";
echo "<input type='text' name='description' placeholder='Gift Description' required/>";
echo"<br>";
echo "<input type='submit' name='submit' value='Submit' />";
echo"<br>";
echo "</form>";

echo "<br>";

echo usermessage();

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>