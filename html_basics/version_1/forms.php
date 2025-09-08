<?php // This open the php code section

echo "<!DOCTYPE html>";

echo "<html>";

echo "<head>";

    echo "<title> watkin</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";

echo "</head>";

echo "<body>";


echo "<h1> Watkin </h1>";
echo "<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo "Your name: " . $_POST['name'];
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