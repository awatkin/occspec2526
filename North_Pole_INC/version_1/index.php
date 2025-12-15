<?php // This open the php code section

if (!isset($_GET['message'])) {
    session_start();
    $message = false;
} else {
    // Decode the message for display
    $message = htmlspecialchars(urldecode($_GET['message']));
}
require_once "assets/common.php";

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

echo "<h2> Welcome to the North Pole Inc Wishlist system!</h2>";  # sets a h2 heading as a welcome
echo "<br>";
if (!$message){
    echo usermessage();
} else {
    echo $message;
}
echo "<br>";

echo "<p class='content'> Use the menu at the top to access the features you want, but ensure you are signed up first! </p>";

echo "<p class='content'> You have to be registered first to use our system! </p>";

echo "<br>";

echo "<img src=assets/index_img.png>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>