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
echo "<br>";

echo "<h2> Welcome to my Transformers Mini Project Website</h2>";  # sets a h2 heading as a welcome

# copied the embed code from youtube to host the video.

echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/D97zxcIwD4k?si=xlAHvgA7gReJxL3g' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";

echo "</div>";
echo "</div>";

echo "</body>";


echo "</html>";
?>