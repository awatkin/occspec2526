<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Mini Project 03</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.
echo "<div class='container'>";

include_once "assets/topbar.php";

include_once "assets/nav.php";

echo "<div class='content'>";
echo "<br>";

echo "<h2> Password Strength Checker</h2>";  # sets a h2 heading as a welcome

echo "<h3> Enter your password below to have it rated!";

echo "<form action='' method='post'>";

echo "<input type='password' name='password' placeholder='Password'>";

echo "<input type='submit' name='submit' value='Submit'>";

echo "</form>";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result= pwd_checker($_POST["password"]);

}


echo "</div>";

echo "</div>";

echo "</body>";


echo "</html>";
?>