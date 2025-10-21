<?php // This open the php code section

session_start();
require_once "assets/common.php";
require_once "assets/dbconn.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $tmp = $_POST["appt_date"]. ' ' . $_POST["appt_time"];
    $epoch_time = strtotime($tmp);

    echo $epoch_time;
    echo time();


//    try{
//        book_appointment(dbconnect_insert());
//        $_SESSION['usermessage'] = "SUCESS: You have booked your appointment on ". $_POST['date'] ." at ". $_POST['time'];
//        header("location: book.php");
//        exit;
//    } catch(PDOException $e){
//        $_SESSION['usermessage'] = $e->getMessage();
//        header("location: book.php");
//        exit;
//    } catch(Exception $e){
//        $_SESSION['usermessage'] = $e->getMessage();
//        header("location: book.php");
//        exit;
//    }

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

echo "</select>";

echo "<br>";


echo "<input type='submit' name='submit' value='Book Appointment' />";

echo "</form>";

echo "<br>";

echo usermessage();

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>