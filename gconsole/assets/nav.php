<?php
echo "<div class='navi'>";
echo "<nav>";  #decales

    echo "<ul>";  #declares an unordered list


        echo "<li> <a href='index.php'>Home</a> </li>"; #open a cell for a link to be housed

        if(!isset($_SESSION['user'])) {
            echo "<li> <a href='login.php'>Login</a> </li>";
            echo "<li> <a href='register.php'>Register</a> </li>";
        } else {

        echo "<li> <a href='consolereg.php'>Console Register</a> </li>";
        echo "<li> <a href='logout.php'>Logout</a> </li>";
        }

    echo "</ul>";  # closes the row of the table.

echo "</nav>";

echo "</div>";