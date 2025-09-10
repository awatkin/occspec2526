<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Mini Project 01</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

include_once "assets/topbar.php";

include_once "assets/nav.php";

echo "<div class='content'>";

echo "<h2> Join The Transformers Movie mailing list below</h2>";  # sets a h2 heading as a welcome

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)
    echo "<h2> Your mailing list information confirmed </h2>";
    echo "Your name: " . $_POST['fname']. " ". $_POST['sname'];  # uses the full stop to concatenate the text and the post value from the form
    echo "<br>";
    echo "Your email: "  . $_POST['email']. " email confirmed ". $_POST['emailc'];  # shows the entered email addresses
    echo "<br>";
}

echo "<form method='post' action=''>";

echo "<input type='text' name='fname' placeholder='First Name' />";  # text for name
echo "<br>";
echo "<input type='text' name='sname' placeholder='Surname' />"; # text for surname
echo "<br>";
echo "<input type='email' name='email' placeholder='Email' />"; #email box for email
echo "<br>";
echo "<input type='email' name='emailc' placeholder='Confirm email' />";  # email again for confirming
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";  # submit button to call the page and send the data

echo "</div>";
echo "</div>";

echo "</body>";


echo "</html>";
?>