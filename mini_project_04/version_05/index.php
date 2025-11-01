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

        echo "<title> Version 2</title>";  # sets the title of the page (web browser tab)
        echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

    echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

    require_once "assets/topbar.php";  // brings in the top bar, so unified branding is applied throughout

    require_once "assets/nav.php";  // brings in the nav bar, so one place to change, reflected throughout

echo "<div class='content'>";
    echo "<br>";

    echo "<h2> Welcome to Primary Oaks - Your Health is our Concern</h2>";  # sets a h2 heading as a welcome

    echo "<p class='content'> Boiler plate text about the doctors surgery </p>";

echo "<p class='content'> You have to be registered to login and book </p>";

echo "<br>";

if (!$message){  # gets the message from the url if applicable or echos out user message
    echo usermessage();
} else {
    echo $message;
}

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>