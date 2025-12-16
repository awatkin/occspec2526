<?php

function audtitor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO useraudit (userid,short, longdesc, addedon) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $userid);
    $stmt->bindParam(2, $code);
    $stmt->bindParam(3, $long);
    $happenedon = time();
    $stmt->bindParam(4, $happenedon);  //bind parameters for security

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}

function usermessage(){  # function to check for a user message and return echoable string
    if(isset($_SESSION['usermessage'])){  # checks to see if it is set
        if(str_contains($_SESSION['usermessage'],"ERROR")){  # if it's an error
            $msg = "<div id='usererror'>".$_SESSION['usermessage']."</div>";  # formats string appropriately
        } else {  # if it's not an error
            $msg = "<div id='usermessage'>".$_SESSION['usermessage']."</div>";  # positive message given
        }
        unset($_SESSION['usermessage']);  # unsets the user message so it doesn't keep being displayed
    } else {
        $msg = "";  # if no message has been set, returns empty string.
    }
    return $msg;
}

function onlyuser($conn, $email){  # At registration checks to make sure that no user already matches
    $sql = "SELECT email FROM user WHERE email = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $email);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    if ($result) {  # if a user is returned
        return false; # return false so y
    } else {
        return true;
    }
}

function reg_user($conn){

    // Prepare and execute the SQL query
    $sql = "INSERT INTO user (fname, sname, email, password, signup, addressln1, addressln2, addressln3, citytown, county, postzipcode,  country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $_POST['fname']);
    $stmt->bindParam(2, $_POST['sname']);
    $stmt->bindParam(3, $_POST['email']);  //bind parameters for security
    $pwdhash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->bindParam(4, $pwdhash);
    $signupdate = time();
    $signupdate = time();
    $stmt->bindParam(5, $signupdate);
    $stmt->bindParam(6, $_POST['addressln1']);
    $stmt->bindParam(7, $_POST['addressln2']);
    $stmt->bindParam(8, $_POST['addressln3']);
    $stmt->bindParam(9, $_POST['citytown']);
    $stmt->bindParam(10, $_POST['county']);
    $stmt->bindParam(11, $_POST['postcode']);
    $stmt->bindParam(12, $_POST['country']);

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}


function getnewuserid($conn, $email){  # upon registering, retrieves the userid from the system to audit.
    $sql = "SELECT userid FROM user WHERE email = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $email);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    return $result["userid"];
}

function login($conn, $email){
    $sql = "SELECT userid, password FROM user WHERE email = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1,$email);  //binds the parameters to execute
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    $conn = null;  // nulls off the connection so cant be abused.

    if($result){  // if there is a result returned
        return $result;
    } else {
        return false;
    }
}

function wish_getter($conn){
    // function to get all the gifts in their wishlist

    $sql = "SELECT w.wishid, w.addedon, g.name, g.description from wish w JOIN gift g ON w.giftid = g.giftid WHERE w.userid = ? ORDER BY g.name ASC";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $_SESSION["userid"]);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    if($result){
        return $result;
    } else {
        return false;
    }
}

function reg_gift($conn){
    $sql = "INSERT INTO gift (name, description, addedon) VALUES (?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $_POST['name']);
    $stmt->bindParam(2, $_POST['description']);
    $happenedon = time();
    $stmt->bindParam(3, $happenedon);
    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}

function gift_getter($conn){
    $sql = "SELECT * FROM gift"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->execute(); //run the sql code
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  //brings back results
    $conn = null;  // nulls off the connection so cant be abused.

    if($result){  // if there is a result returned
        return $result;
    } else {
        return false;
    }
}

function wish_gift($conn, $giftid){
    $sql = "INSERT INTO wish (userid, giftid, addedon) VALUES (?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $_SESSION['userid']);
    $stmt->bindParam(2, $giftid);
    $happenedon = time();
    $stmt->bindParam(3, $happenedon);
    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}

function get_new_gift($conn){
    $sql = "SELECT * FROM gift ORDER BY giftid DESC LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    $conn = null;
    if($result){
        return $result;
    } else {
        return false;
    }
}

function unwish($conn,$wishid){
    $sql = "DELETE FROM wish WHERE wishid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $wishid);
    $stmt->execute();
    $conn = null;
    return true;
}