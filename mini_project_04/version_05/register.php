<?php // This open the php code section

session_start();  // connect to the session to get important informaiton

require_once "assets/common.php";  // bring in the common functions
require_once "assets/dbconn.php";  // bring in the dbconnection, not ideal way to execute

if (isset($_SESSION['userid'])) {  // Looks for if the user is already logged in
    $_SESSION['usermessage'] = "ERROR: You have already logged in!";  // tells them they are logged in and redirect to index
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // checks for post condition
        if ($_POST['password'] != $_POST['password_confirm']) {  // checks for passwords match in form
            $_SESSION['usermessage'] = "ERROR: Passwords do not match!";  // error message set
            header("Location: register.php");  // sends them back to register
            exit;  // this ensure the redirect works and stops any further code executing.
        } else {
            try{  // if passwords matched, try catch block to register
            if(onlyuser(dbconnect_select(),$_POST['email']) && reg_user(dbconnect_insert())) {  // ensures they are the only user and then registers them
                audtitor(dbconnect_insert(),getnewuserid(dbconnect_select(),$_POST['email']),"REG", "Registration of new user"); // sets an audit message
                $_SESSION['usermessage'] = "SUCCESS: YOU have been registered!";  // confirmation message set
                header("Location: login.php");  // redirects them to login page
                exit;  // ensures no other code in executed
            }
            } catch (PDOException $e) {  // catch database error
                $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();  // sets it to user message with a redirect
                header("Location: register.php");  // sends them back to same page with user error set
                exit;
            } catch (Exception $e){
                $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();}  // catches any other error and redirects them to reg page
        }
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> version 2</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";  // brings in the standard top bar

require_once "assets/nav.php";  // brings in the standard nav bar.

echo "<div class='content'>";
echo "<br>";

echo "<h2> Primary Oaks - User registration system</h2>";  # sets a h2 heading as a welcome

echo "<br>";
echo usermessage();  // echos out user messaging to ensure they see it.
echo "<br>";

echo "<p class='content'> Please complete the below form to register for our system </p>";

echo "<form action='' method='post'>";
echo"<br>";
echo "<input type='email' name='email' placeholder='E-mail Address' required/>";
echo"<br>";
echo "<input type='password' name='password' placeholder='Password' required/>";
echo"<br>";
echo "<input type='password' name='password_confirm' placeholder='Confirm Password' required/>";
echo"<br>";
echo "<input type='text' name='fname' placeholder='Firstname' required/>";
echo"<br>";
echo "<input type='text' name='sname' placeholder='Surname' required/>";
echo"<br>";
echo "<input type='date' name='dob' value=". date('Y-m-d')." required/>";  // presets the dob picker to be todays date.
echo"<br>";
echo "<input type='text' name='addressln1' placeholder='Address Line 1' required/>";
echo"<br>";
echo "<input type='text' name='addressln2' placeholder='Address Line 2' />";
echo"<br>";
echo "<input type='text' name='postcode' placeholder='Postcode' required/>";
echo"<br>";
echo "<input type='text' name='county' placeholder='County' required/>";
echo"<br>";
echo "<input type='text' name='phone' placeholder='Phone Number' required/>";
echo"<br>";
echo "<input type='submit' name='submit' value='Register' />";
echo"<br>";
echo "</form>";

echo "<br>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>