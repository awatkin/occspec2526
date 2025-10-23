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
                $_SESSION['usermessage'] = "SUCCESS: Your Appointment was cancelled";
            } else {
                $_SESSION['usermessage'] = "ERROR: Could not able to execute complete this action";
            }

        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
        }
    } elseif (isset($_POST['appchange'])) {
        $_SESSION['apptid'] = $_POST['apptid'];
        header('Location: alterbooking.php');
        exit;
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

echo usermessage();

    echo "<br>";

    echo "<h2> Primary Oaks - Your Bookings</h2>";  # sets a h2 heading as a welcome

    echo "<p class='content'> Below are your bookings </p>";
    $appts = appt_getter(dbconnect_select());
    if (!$appts) {
        echo "no appts found";
    } else {

        echo "<table id='bookings'>";

        foreach ($appts as $appt) {
            if ($appt['role'] = "doc") {
                $role = "Doctor";
            } else if ($appt['role'] = "nur") {
                $role = "Nurse";
            }

            echo "<form action='' method='post'>";

            echo "<tr>";
            echo "<td> Date: " . date('M d, Y @ h:i A', $appt['appointmentdate']) . "</td>";
            echo "<td> Made on: " . date('M d, Y @ h:i A', $appt['bookedon']) . "</td>";
            echo "<td> With: " . $role . " " . $appt['fname'] . " " . $appt['sname'] . "</td>";
            echo "<td> in: " . $appt['room'] . "</td>";
            echo "<td><input type='hidden' name='apptid' value=".$appt['bookid']."> 
                   <input type='submit' name='appdelete' value='Cancel Appt' />
                   <input type='submit' name='appchange' value='Change Appt' /></td>";

            echo "</tr>";
            echo "</form>";

        }


        echo "</table>";
    }
echo "<br>";



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>