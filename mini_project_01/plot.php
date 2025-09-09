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
echo"<td> <a href='characters.php'>Characters</a></td>"; #open a cell for a link to be housed
echo"<td> <a href='plot.php'>Plot</a></td>";
echo "<td> <a href='media.php'>Media</a></td>";
echo "<td> <a href='mail.php'>Mail List</a></td>";
echo "</tr>";  # closes the row of the table.
echo "</table>";  # closes the table off

echo "<br>";

echo "<h2> Plot of The Transformers Movie";  # sets a h2 heading as a welcome


echo "</body>";


echo "</html>";
?>