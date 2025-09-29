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
echo "<td class='linkbox'> <a href='characters.php'>Characters</a></td>"; #open a cell for a link to be housed
echo "<td class='linkbox'> <a href='checker.php'>Plot</a></td>";
echo "<td class='linkbox'> <a href='media.php'>Media</a></td>";
echo "<td class='linkbox'> <a href='mail.php'>Mail List</a></td>";
echo "</tr>";  # closes the row of the table.
echo "</table>";  # closes the table off

echo "<br>";

echo "<h2> The Transformers Movie Plot</h2>";  # sets a h2 heading as a welcome

# used class to style all certain p tags in the same style.

echo "<p class='content'> In 2005, the evil Decepticons have conquered the Autobots' home planet of Cybertron. The heroic Autobots, operating from Cybertron's two moons, prepare a counteroffensive. The Autobot leader, Optimus Prime, sends a shuttle to Autobot City on Earth for supplies. The Decepticons discover their plan, kill several Autobots, and hijack the ship. </p>";

echo "<p class='content'> In Autobot City, Hot Rod is fishing with Daniel Witwicky (son of Spike Witwicky). Daniel spots a hole in the hijacked shuttle, Hot Rod sees the Decepticons and attacks, and the Decepticons leap into battle. Optimus arrives with reinforcements and engages the Decepticon leader, Megatron, in combat. Both are mortally wounded, forcing the Decepticons to retreat to space in Astrotrain. Optimus passes the Matrix of Leadership to Ultra Magnus, telling him that its power will light the Autobots' darkest hour, and dies. </p>";

echo "<p class='content'> To conserve fuel, the Decepticons jettison their wounded, including Megatron, abandoned by his treacherous second-in-command, Starscream. Drifting in space, the wounded Decepticons are found by Unicron, a sentient planet who consumes other worlds. Unicron offers Megatron a new body in exchange for destroying the Matrix, which has the power to destroy Unicron. Megatron reluctantly agrees and is remade into Galvatron, while the other jettisoned Decepticons are converted into his new troops. </p>";

echo "<p class='content'> On Cybertron, Galvatron disrupts Starscream's coronation as Decepticon leader and kills him. Unicron consumes the moons of Cybertron, including the secret bases with Autobots and Spike, although they escape. Retaking command of the Decepticons, Galvatron leads his forces to seek out Ultra Magnus at the ruined Autobot City. </p>";

echo "<p class='content'> The surviving Autobots escape in separate shuttles, which are shot down by the Decepticons and crash on different planets. Hot Rod and Kup are taken prisoner by the Quintessons, tyrants who hold kangaroo courts and execute prisoners by feeding them to the Sharkticons. Hot Rod and Kup learn of Unicron from Kranix, a lone survivor of Lithone, a planet devoured by Unicron. After Kranix is executed, Hot Rod and Kup escape, aided by the Dinobots and the small Autobot Wheelie, who helps them find an escape ship. </p>";

echo "<p class='content'> The other Autobots land on the Planet of Junk, and they decide to use the junk to repair the ship until Galvatron and his forces arrive. Ultra Magnus secures the remaining Autobots but fails to release the power of the Matrix. He is destroyed by Galvatron, who seizes the Matrix, which he intends to use to control Unicron. The Autobots find Ultra Magnus' body and are attacked by the native Junkions led by Wreck-Gar, who had hidden when Galvatron arrived with his forces. </p>";

echo "<p class='content'> The arriving Autobots from Quintesson led by Hot Rod befriend Wreck-Gar and the Junkions, who in return rebuild Ultra Magnus. Realizing Galvatron now has the Matrix, the Autobots and the Junkions fly to Cybertron. Galvatron attempts to threaten Unicron, but like Ultra Magnus, cannot activate the Matrix. In response, Unicron transforms into a colossal robot and begins to dismember Cybertron. When Galvatron attacks him, Unicron swallows him and the Matrix whole. </p>";

echo "<p class='content'> The Autobots arrive at the scene while Unicron continues to battle Decepticons, Junkions, and other defenders of Cybertron. Hot Rod's ship is damaged and he and his group of Autobots crash into Unicron's left eye. Daniel saves his father from Unicron's digestive system, and the group rescues several Autobots. Galvatron attempts to ally with Hot Rod, but Unicron forces him to attack. Hot Rod is almost killed but recovers and activates the Matrix, becoming Rodimus Prime, the new Autobot leader. Rodimus tosses Galvatron into space and uses the Matrix's power to destroy Unicron, then escapes with the other Autobots through Unicron's remaining eye. With the Decepticons in disarray, the Autobots celebrate the war's end and the retaking of their home planet while Unicron's severed head orbits Cybertron. </p>";

echo "</body>";


echo "</html>";
?>