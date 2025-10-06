<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

    echo "<head>";  # opens the head section

        echo "<title> Mini Project 03</title>";  # sets the title of the page (web browser tab)
        echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

    echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

    require_once "assets/topbar.php";

    require_once "assets/nav.php";

echo "<div class='content'>";
    echo "<br>";

    echo "<h2> Welcome to Primary Oaks - Your Health is our Concern</h2>";  # sets a h2 heading as a welcome

    echo "<p class='content'> Boiler plate text about the doctors surgery </p>";

echo "<p class='content'> You have to be registered to login and book </p>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>