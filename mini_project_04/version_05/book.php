<?php // This open the php code section

session_start();  // connects to session to get important session data
require_once "assets/common.php";  // connects to the common functions
require_once "assets/dbconn.php";  // brings in the database connection

if (!isset($_SESSION['userid'])) {  // checks to ensure they are logged in,
    $_SESSION['usermessage'] = "ERROR: You are not logged in!"; // if not, error message set
    header("Location: login.php");  // redirected to login as only logged in users can book
    exit;  // stops any other code executing.
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){  // if they are logged in and posted

    try {

        $tmp = $_POST["appt_date"] . ' ' . $_POST["appt_time"];  // gets appropriate date and time in needed format
        $epoch_time = strtotime($tmp);  // converts to needed time and date
        if(commit_booking(dbconnect_insert(),$epoch_time)){  // calls commit booking
            audtitor(dbconnect_insert(), $_SESSION['userid'], "APB", "Updated their booking for a new time / date");  // audits the booking
            $_SESSION['usermessage'] = "SUCCESS: YOUR Booking has been made!";  // sets user success message
            header("Location: bookings.php");  // sends them to bookings to see their bookings
            exit;  // stops any other code executing
        } else {
            $_SESSION['usermessage'] = "ERROR: Booking has failed!";
            header("Location: book.php");  // sends them to back to book with error message
            exit;  // stops any other code executing
        }

    }
    catch (PDOException $e){
        $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
        header("Location: book.php");  // sends them to back to book with error message
        exit;  // stops any other code executing
    } catch(Exception $e){
        $_SESSION['usermessage'] = "ERROR: " . $e->getMessage();
        header("Location: book.php");  // sends them to back to book with error message
        exit;  // stops any other code executing
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

    echo "<h2> Primary Oaks - Appointment Booking System</h2>";  # sets a h2 heading as a welcome

echo "<br>";
echo usermessage();  // outputs any relevant error or success messages
echo "<br>";

echo "<form action='' method='post'>";  // starts form to book appointments


echo "<label for='appt_time'> Appointment Time:</label>";   // allow choosing of appointment time
echo "<input type='time' name='appt_time' required>";

echo "<br>";
echo "<label for='appt_date'> Appointment Date:</label>";  // allows choosing of appointment date
echo "<input type='date' name='appt_date' required>";

echo "<br>";
echo "<select name='admin'>";  // generates a select box of staff with role and room number
try {
    $staff = staf_geter(dbconnect_select()); // gets list of staff from database}
}  catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
    header("Location: index.php");  // sends them to back to book with error message
    exit;  // stops any other code executing
} catch(Exception $e){
    echo "ERROR: " . $e->getMessage();
    header("Location: index.php");  // sends them to back to book with error message
    exit;  // stops any other code executing
}


foreach ($staff as $staf){

    if ($staf['role'] = "doc"){
        $role = "Doctor";
    } else if ($staf['role'] = "nur"){
        $role = "Nurse";
    }
    echo "<option value =".$staf['staffid']. ">" .$role." ".$staf['sname']." ".
        $staf['fname']." Room ".$staf['room']."</option>";
}

echo "</select>";

echo "<br>";


echo "<input type='submit' name='submit' value='Book Appointment' />";

echo "</form>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
