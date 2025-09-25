<?php // This open the php code section

session_start();

require_once "assets/dbconn.php";

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


echo "<h1> G Console </h1>";

echo "<br>";

echo "<p id='intro'>Welcome to the home of tracking the consoles you own</p>";

echo "<p id='usemenu'> Use the nav bar to navigate to the page you need </p>";

try {
    $conn = dbconnect_insert();
    echo"success";
}  catch (PDOException $e) {
    echo $e->getMessage();
}

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>