<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Mini Project 01</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

include_once "assets/topbar.php";

include_once "assets/nav.php";

echo "<div class='content'>";

echo "<h2> Charactes of The Transformers Movie</h2>";  # sets a h2 heading as a welcome

echo "<p class='cont'> Below is the Characters from the movie and the actor that portrayed them.</p>";  # p tag to store some intro information

echo "<table id='autobots'>";  # opens the table for autobots, id used for styling seperate.

    echo "<tr>";  # row for headings
        echo "<td>Character</td>";
        echo "<td>Faction</td>";
        echo "<td>Actor</td>";
        echo "<td>Profile</td>";
    echo "</tr>";

    echo "<tr>";  # row for optius
        echo "<td>Optimus Prime</td>";
        echo "<td><img class='autolog' src='images/autologo.png'</td>"; # added a class to allow across the board styling
        echo "<td>Peter Cullen</td>";
        echo "<td>The leader of the Autobots, doomed to die early in the movie</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Hot Rod</td>";
        echo "<td><img class='autolog' src='images/autologo.png'</td>";
        echo "<td>Judd Nelson</td>";
        echo "<td>A headstrong, cavalier Autobot warrior unknowingly destined to unleash the power of Matrix.</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Kup</td>";
        echo "<td><img class='autolog' src='images/autologo.png'</td>";
        echo "<td>Lionel Stander</td>";
        echo "<td>A gruff, elderly Autobot warrior and mentor to Hot Rod.</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Ultra Magnus</td>";
        echo "<td><img class='autolog' src='images/autologo.png'</td>";
        echo "<td>Robert Stack</td>";
        echo "<td>An elite soldier who takes Optimus's place as the Autobot commander and the bearer of the Matrix of Leadership.</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Arcee</td>";
        echo "<td><img class='autolog' src='images/autologo.png'</td>";
        echo "<td>Susan Blu</td>";
        echo "<td>A highly skilled female Autobot</td>";
    echo "</tr>";

    echo "</table>";  # close of autobot table

    echo "<h2> Decepticons </h2>";  # clear h2 title to split the tables

    echo "<table id='decepticons'>";  # sets tables as different style with new id

    echo "<tr>";
        echo "<td>Character</td>";
        echo "<td>Faction</td>";
        echo "<td>Actor</td>";
        echo "<td>Profile</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Optimus Prime</td>";
        echo "<td><img class='autolog' src='images/deceplogo.png'</td>";
        echo "<td>Peter Cullen</td>";
        echo "<td>The leader of the Autobots, doomed to die early in the movie</td>";
    echo "</tr>";


echo "</table>";

echo "</div>";
echo "</div>";

echo "</body>";


echo "</html>";
?>