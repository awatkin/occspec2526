<?php // This open the php code section

session_start();

require_once "assets/common.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)

    $_SESSION['msg'] = $_POST['message'];

}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Session Work</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";

echo usr_msg();

echo "<h2> Session Work </h2>";

echo "This is where I will be putting some work in to working on session variable data";

#this form will take user input and store it in SESSION for output elsewhere



echo "<form method='post' action=''>";

echo "<input type='text' name='message' placeholder='Enter a message here'>";

echo "<input type='submit' name='submit' value='submit'>";

echo "</form>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>