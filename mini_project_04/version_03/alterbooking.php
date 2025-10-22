<?php // This open the php code section

session_start();  # connect back to the session for data in there

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database

if (!isset($_SESSION['userid'])) {  # If they have managed to get to this page without loggining
    $_SESSION['usermessage'] = "ERROR: You are not logged in!";
    header("Location: login.php");
    exit;
} elseif($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['appdelete'])){
        try{
            if(cancel_appt(dbconnect_delete(), $_POST['apptid'])){
                $_SESSION['message'] = "SUCCESS: Your Appointment was cancelled";
            } else {
                $_SESSION['message'] = "ERROR: Could not able to execute complete this action";
            }

        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
        }
    }
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

    echo "<head>";  # opens the head section

        echo "<title> Version 3</title>";  # sets the title of the page (web browser tab)
        echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

    echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

    require_once "assets/topbar.php";

    require_once "assets/nav.php";

echo "<div class='content'>";



    echo "<br>";

    echo "<h2> Primary Oaks - Your Bookings</h2>";  # sets a h2 heading as a welcome

echo usermessage();

    echo "<p class='content'> Adjust your booking below </p>";

    $appts = appt_getter(dbconnect_select());

echo "<form action='' method='post'>";

$staff = staf_geter(dbconnect_select());


echo "<label for='appt_time'> Appointment Time:</label>";
echo "<input type='time' name='appt_time' required>";

echo "<br>";
echo "<label for='appt_date'> Appointment Date:</label>";
echo "<input type='date' name='appt_date' required>";

echo "<br>";
echo "<select name='staff'>";

foreach ($staff as $staf){

    if ($staf['role'] = "doc"){
        $role = "Doctor";
    } else if ($staf['role'] = "nur"){
        $role = "Nurse";
    }
    echo "<option value =".$staf['staffid']. ">" .$role." ".$staf['sname']." ".
        $staf['fname']." Room ".$staf['room']."</option>";
}

# USE "SELECTED" TO SET WHICH DOC / NURSE

echo "</select>";

echo "<br>";


echo "<input type='submit' name='submit' value='Book Appointment' />";

echo "</form>";




echo "<br>";



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>