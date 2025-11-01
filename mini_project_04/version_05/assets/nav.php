<?php
echo "<div class='navi'>";
echo "<nav>";  #decales

echo "<ul>";  #declares an unordered list


echo "<li class='linkbox'> <a href='index.php'>Home</a></li>"; #open a cell for a link to be housed
if(!isset($_SESSION['userid'])){
    echo "<li class='linkbox'> <a href='login.php'>Login</a></li>";
    echo "<li class='linkbox'> <a href='register.php'>Register</a></li>";
} else {
    echo "<li class='linkbox'> <a href='book.php'>Book</a></li>";
    echo "<li class='linkbox'> <a href='bookings.php'>Bookings</a></li>";
    echo "<li class='linkbox'> <a href='auditlog.php'>Audit Log</a></li>";
    echo "<li class='linkbox'> <a href='logout.php'>Logout</a></li>";
}
echo "</ul>";  # closes the row of the table.

echo "</nav>";

echo "</div>";