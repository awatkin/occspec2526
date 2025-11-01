<?php // This open the php code section

session_start();  # connect back to the session for data in there

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database

if (!isset($_SESSION['userid'])) {  # If they have managed to get to this page without loggining
    $_SESSION['usermessage'] = "ERROR: You are not logged in!"; // sets error messsge
    header("Location: login.php");  // redirects them
    exit;  // ensures no othetr code executes
}


echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Version 5</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";



echo "<h2> Primary Oaks - Your Audit Log</h2>";  # sets a h2 heading as a welcome

echo "<br>";

echo usermessage();

echo "<br>";

echo "<p class='content'> Below is your audit log </p>";

echo "<form action='' method='post'><table>";
echo "<tr>";
echo"<td> FILTER BY:  <input type='submit' name='LOG' value='Login'> <input type='submit' name='APB' value='Appt Book'> <input type='submit' name='LOG' value='Login'></td>";

echo"</table></form>";
try{
    if(!isset($_SESSION['auditfilter'])) {
        $audits = audit_getter(dbconnect_select(), "");
    } else {
        $audits = audit_getter(dbconnect_select(), $_SESSION['auditfilter']);
    }
}  catch (PDOException $e) {
    $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
    header("Location: index.php");
    exit;
} catch (Exception $e) {
    $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
    header("Location: index.php");
    exit;
}

if (!$audits) {
    echo "no audits found";
} else {

    echo "<table id='bookings'>";

    foreach ($audits as $audit) {  // starts loop to work through each audit

        if ($audit['code'] == "REG") {
            $code = "Registration";
        } elseif ($audit['code'] == "LGI") {
            $code = "Logged In";
        } elseif ($audit['code'] == "LGO") {
            $code = "Logged Out";
        } elseif ($audit['code'] == "FLG") {
            $code = "Failed Logging in";
        } elseif ($audit['code'] == "APB") {
            $code = "Appointment Booked";
        } elseif ($audit['code'] == "UPB") {
            $code = "Updated a booking";
        } elseif ($audit['code'] == "APC") {
            $code = "Appointment Cancelled";
        }


        echo "<tr>";

        echo "<td> Date: " . date('M d, Y @ h:i A', $audit['date']) . "</td>";
        echo "<td> Action: " . $code . "</td>";
        echo "<td> Description: " . $audit['auditdescrip'] . "</td>";

        echo "</tr>";

    }

    echo "</table>";
}
echo "<br>";



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?><?php
