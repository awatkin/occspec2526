<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";

echo "<head>";

    echo "<title> watkin</title>";  # sets the title of the page (web browser tab)
    echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";

echo "<body>";


echo "<h1> Watkin </h1>";
echo "<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)
    echo "Your name: " . $_POST['name'];  # uses the full stop to concatenate the text and the post value from the form
    echo "<br>";
    echo "Your email: "  . $_POST['email'];
    echo "<br>";
    echo "Your password: "  . $_POST['pwd'];
    echo "<br>";
    echo "Your password confirmed: "  . $_POST['pwd2'];
}


    echo "<br>";
echo "<form method='post' action=''>";

echo "<input type='text' name='name' placeholder='Name' />";
echo "<br>";
echo "<input type='email' name='email' placeholder='Email' />";
echo "<br>";
echo "<input type='password' name='pwd' placeholder='Password' />";
echo "<br>";
echo "<input type='password' name='pwd2' placeholder='Confirm Password' />";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";


echo "</form>";

echo "</body>";


echo "</html>";
?>