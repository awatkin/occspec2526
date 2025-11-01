<?php // This open the php code section

session_start();

require_once "assets/staffcommon.php";
require_once "assets/dbconn.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['usermessage'] = "ERROR: Passwords do not match!";
            header("Location: staffregister.php");
            exit;
        } else {
            try{
            if(onlystaffuser(dbconnect_select(),$_POST['email']) && staffreg_user(dbconnect_insert())) {
                $_SESSION['usermessage'] = "SUCCESS: Staff have been registered!";
                audtitor(dbconnect_insert(),getnewstaffid(dbconnect_select(),$_POST['email']),"sre", "Registration of new admin");
                header("Location: staffregister.php");
                exit;
            }
            } catch (PDOException $e) {
                $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
                header("Location: staffregister.php");
                exit;
            } catch (Exception $e){
                $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();}
        }
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> version 3</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='../css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";
echo "<br>";

echo "<h2> Primary Oaks - ADMIN Add admin</h2>";  # sets a h2 heading as a welcome

echo "<p class='content'> Please complete the below form to register for our system </p>";

echo "<form method='post' action=''>";
echo"<br>";
echo "<input type='text' name='role' placeholder='3 letter role code' required/>";
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
echo "<input type='number' name='roomno' required/>";
echo"<br>";

echo "<input type='submit' name='submit' value='Register' />";
echo"<br>";
echo "</form>";

echo "<br>";

echo usermessage();

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>