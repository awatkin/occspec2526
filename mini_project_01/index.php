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

echo "<p class='content'> The Transformers film is an 1980s animated feature length movie based on the TV shop of the same name. The movie screened in Cinemas from 12th December 1986 in the UK.</p>";

echo "<p class='content'> The movie, with its powerful 80s rock soundtrack follows the exploits of Hotrod and the rest of the Autobots against the newly formed Galvatron and the decepticons. </p>";

echo "<img src=images/movie_cover.jpg>";  # image added to improve the appearance of the index page.

echo "</body>";


echo "</html>";
?>