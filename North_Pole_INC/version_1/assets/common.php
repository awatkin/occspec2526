<?php

function audtitor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO audit (date, userid, code, auditdescrip) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, date('Y-m-d'));  //bind parameters for security
    $stmt->bindParam(2, $userid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);

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
    $sql = "INSERT INTO user (email, password, fname, sname, dob, sign_up, addressln1, addressln2, postcode, county, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $_POST['email']);  //bind parameters for security
    // Hash the password
    $stmt->bindParam(2, password_hash($_POST['password'], PASSWORD_DEFAULT));
    $stmt->bindParam(3, $_POST['fname']);
    $stmt->bindParam(4, $_POST['sname']);
    $stmt->bindParam(5, $_POST['dob']);
    $stmt->bindParam(6, date('Y-m-d'));
    $stmt->bindParam(7, $_POST['addressln1']);
    $stmt->bindParam(8, $_POST['addressln2']);
    $stmt->bindParam(9, $_POST['postcode']);
    $stmt->bindParam(10, $_POST['county']);
    $stmt->bindParam(11, $_POST['phone']);

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

