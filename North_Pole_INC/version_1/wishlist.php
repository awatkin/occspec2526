<?php // This open the php code section

session_start();  # connect back to the session for data in there

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database

if (!isset($_SESSION['userid'])) {  # If they have managed to get to this page without loggining

    $_SESSION['usermessage'] = "ERROR: You are not logged in!"; // sets error messsge
    header("Location: login.php");  // redirects them
    exit;  // ensures no othetr code executes

} elseif($_SERVER["REQUEST_METHOD"] === "POST") {  // if the user has posted
    if(isset($_POST['addgift'])){  // if they have clicked to wish for a gift
        try{
            if(wish_gift(dbconnect(), $_POST['gift_select'])){  // try to cancel it
                audtitor(dbconnect(), $_SESSION['userid'], "WGT", "Wished for a new gift");  // audit the cancellation
                $_SESSION['usermessage'] = "SUCCESS: You have wished for a new gift";  // Sets a user message
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            } else {
                $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            }

        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        }
    } elseif (isset($_POST['appendgift'])) {  // if the change appointment button was used
        try{
            if(reg_gift(dbconnect())){
                $giftid = get_new_gift(dbconnect());
                if(wish_gift(dbconnect(), $giftid['giftid'])){
                    audtitor(dbconnect(),$_SESSION['userid'],"GRG", "Registered a new gift to the system");
                    audtitor(dbconnect(), $_SESSION['userid'], "WGT", "Wished for a new gift");  // audit the cancellation
                    $_SESSION['usermessage'] = "SUCCESS: You have wished for a new gift";  // Sets a user message
                    header('Location: wishlist.php');  // redirects them
                    exit;  // ensures no other code executes
                } else {
                $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            }
          }
        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        }

    }elseif(isset($_POST['wishdelete'])){
        try{
            if(unwish(dbconnect(),$_POST['wishid'])){
                audtitor(dbconnect(),$_SESSION['userid'],"UNW", "Unwished an item");
                $_SESSION['usermessage'] = "SUCCESS: You have unwished a gift";  // Sets a user message
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
                } else {
                    $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                    header('Location: wishlist.php');  // redirects them
                    exit;  // ensures no other code executes
                }
        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        }
    }
}

echo "<!DOCTYPE html>";  # essential html line to dictate the page type

echo "<html>";  # opens the html content of the page

echo "<head>";  # opens the head section

echo "<title> North Pole Inc</title>";  # sets the title of the page (web browser tab)
echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";  # links to the external style sheet

echo "</head>";  # closes the head section of the page

echo "<body>";  # opens the body for the main content of the page.

echo "<div class='container'>";

require_once "assets/topbar.php";

require_once "assets/nav.php";

echo "<div class='content'>";

echo "<h2> Wishlist - Your Wishlist!</h2>";  # sets a h2 heading as a welcome

echo usermessage();

echo "<br>";

echo "<div class='quickadd'>";
echo "<h3> Add to your wishlist here:</h2>";

echo "<form action='' method='post'>";
try {
    $gifts = gift_getter(dbconnect());
}  catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
    header("Location: wishlist.php");  // sends them to back to book with error message
    exit;  // stops any other code executing
} catch(Exception $e){
    echo "ERROR: " . $e->getMessage();
    header("Location: wishlist.php");  // sends them to back to book with error message
    exit;  // stops any other code executing
}

if(!$gifts){
    echo "no gifts available!";
} else {
    echo "<select name='gift_select'>";
    foreach ($gifts as $gift) {

        echo "<option value =" . $gift['giftid'] . ">" . $gift['name'] . " - " . $gift['description'] . "</option>";
    }
    echo "</select>";
}

echo"<input type='submit' name='addgift' value='Wish for gift' />";

echo "</form>";
echo "<br>";
echo "<h3> Add a gift and wishlist it:</h3>";  # sets a h2 heading as a welcome
echo "<form action='' method='post'>";
echo "<input type='text' name='name' placeholder='Gift Name' required/>";
echo "<input type='text' name='description' placeholder='Gift Description' required/>";

echo"<input type='submit' name='appendgift' value='Wish for gift' />";

echo "</form>";


echo "</div>";


echo "<h2> Here is your Wishlist </h2>";
$wishes = wish_getter(dbconnect());
if (!$wishes) {
    echo "no wishes found";
} else {

    echo "<table id='gifts'>";

    foreach ($wishes as $wish) {

        echo "<form action='' method='post'>";

        echo "<tr>";

        echo "<td> Gift: </td>";
        echo "<td> " . $wish['name'] . " </td>";
        echo "<td> " . $wish['description'] . " </td>";

        echo "<td> Added on: " . date('M d, Y @ h:i A', $wish['addedon']) . "</td>";

        echo "<td><input type='hidden' name='wishid' value=".$wish['wishid'].">
                   <input type='submit' name='wishdelete' value='Remove Wish' /></td>";

        echo "</tr>";
        echo "</form>";

    }


    echo "</table>";
}
echo "<br>";



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>