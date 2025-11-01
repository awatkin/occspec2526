<?php // This open the php code section

session_start();  # connect back to the session for data in there

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database

if (!isset($_SESSION['userid'])) {  # If they have managed to get to this page without loggining
    $_SESSION['usermessage'] = "ERROR: You are not logged in!"; // sets error messsge
    header("Location: login.php");  // redirects them
    exit;  // ensures no othetr code executes
} elseif($_SERVER["REQUEST_METHOD"] === "POST") {  // if the user has posted
    if(isset($_POST['appdelete'])){  // if they have clicked to delete the appointment
        try{
            if(cancel_appt(dbconnect_delete(), $_POST['apptid'])){  // try to cancel it
                audtitor(dbconnect_insert(), $_SESSION['userid'], "APC", "Cancelled their appointment");  // audit the cancellation
                $_SESSION['usermessage'] = "SUCCESS: Your Appointment was cancelled";  // Sets a user message
                header('Location: bookings.php');  // redirects them
                exit;  // ensures no other code executes
            } else {
                $_SESSION['usermessage'] = "ERROR: Could not able to execute complete this action";
                header('Location: bookings.php');  // redirects them
                exit;  // ensures no other code executes
            }

        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: bookings.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: bookings.php');  // redirects them
            exit;  // ensures no other code executes
        }
    } elseif (isset($_POST['appchange'])) {  // if the change appointment button was used
        $_SESSION['apptid'] = $_POST['apptid'];  // capture the appointment id from the from
        header('Location: alterbooking.php');  // send them to the alterbooking page
        exit;  // ensure no other code can execute
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



    echo "<h2> Primary Oaks - Your Bookings</h2>";  # sets a h2 heading as a welcome

echo "<br>";

echo usermessage();

echo "<br>";

    echo "<p class='content'> Below are your bookings </p>";
    $appts = appt_getter(dbconnect_select());
    if (!$appts) {
        echo "no appts found";
    } else {

        echo "<table id='bookings'>";

        foreach ($appts as $appt) {
            if ($appt['role'] = "doc") {
                $role = "Doctor";
            } elseif ($appt['role'] = "nur") {
                $role = "Nurse";
            }


            if($appt['status'] = "BKD") {
                $status = "Booked";
            } elseif($appt['status'] = "ATD") {
                $status = "Attended";
            } elseif($appt['status'] = "MSD") {
                $status = "Missed";
            } else {
                $status = "Unknown";
            }

            echo "<form action='' method='post'>";

            echo "<tr>";

            echo "<td> Date: " . date('M d, Y @ h:i A', $appt['appointmentdate']) . "</td>";
            echo "<td> Made on: " . date('M d, Y @ h:i A', $appt['bookedon']) . "</td>";
            echo "<td> With: " . $role . " " . $appt['fname'] . " " . $appt['sname'] . "</td>";
            echo "<td> in Room: " . $appt['room'] . "</td>";
            echo "<td> Status: " . $status . "</td>";
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