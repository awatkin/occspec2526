<?php // This open the php code section

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> Mini Project 01</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<img id='formerslogo' src='images/formerslogo.webp' alt='Transformers Logo' />";  #sets a logo up for the top of each page
echo "<br>";  # line break for clarity and easy of reading.

echo "<table>";  #table used to help with layout of my hyperlinks
echo "<tr>";  # opens the table row (tr)
echo"<td class='linkbox'> <a href='characters.php'>Characters</a></td>"; #open a cell for a link to be housed
echo"<td class='linkbox'> <a href='plot.php'>Plot</a></td>";
echo "<td class='linkbox'> <a href='media.php'>Media</a></td>";
echo "<td class='linkbox'> <a href='mail.php'>Mail List</a></td>";
echo "</tr>";  # closes the row of the table.
echo "</table>";  # closes the table off

echo "<br>";

echo "<h2> Welcome to my Transformers Mini Project Website</h2>";  # sets a h2 heading as a welcome

# copied the embed code from youtube to host the video.

echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/D97zxcIwD4k?si=xlAHvgA7gReJxL3g' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";

echo "</body>";


echo "</html>";
?>