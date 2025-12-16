<?php
echo "<div class='navi'>";

    echo "<nav>";  #decales

        echo "<ul>";  #declares an unordered list


            echo "<li class='linkbox'> <a href='index.php'>Home</a></li>"; #open a cell for a link to be housed

            if(!isset($_SESSION['userid'])){

                echo "<li class='linkbox'> <a href='register.php'>Register</a></li>";
                echo "<li class='linkbox'> <a href='login.php'>Login</a></li>";

            } else {

                echo "<li class='linkbox'> <a href='wishlist.php'>Wish List</a></li>";
                echo "<li class='linkbox'> <a href='addgift.php'>Add a Gift</a></li>";
                echo "<li class='linkbox'> <a href='behave.php'>Nice / Naughty</a></li>";
                echo "<li class='linkbox'> <a href='logout.php'>Logout</a></li>";
            }
        echo "</ul>";  # closes the row of the table.

    echo "</nav>";

echo "</div>";