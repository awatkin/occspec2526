<?php

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

function audtitor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO audit (date, userid, code, auditdescrip) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql
    $tmptime = time();  // prepared the time here as not supposed to pass it directly as a bound parameter.
    $stmt->bindParam(1, $tmptime);  //bind parameters for security
    $stmt->bindParam(2, $userid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}

function staf_geter($conn){
    // function to get all the admin suitable for an appointment

    $sql = "SELECT staffid, role, fname, sname, room FROM staff WHERE role != ? ORDER BY role DESC";
    //get all admin from datbase where role NOT equal to "adm" - this is admin role, none bookable
    $stmt = $conn->prepare($sql);
    $exclude_role = "adm";

    $stmt->bindParam(1, $exclude_role);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

function commit_booking($conn, $epoch){
    $sql = "INSERT INTO book (userid, staffid, appointmentdate, bookedon, status) VALUES (?, ?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $_SESSION["userid"]);  //bind parameters for security
    // Hash the password
    $stmt->bindParam(2, $_POST['admin']);
    $stmt->bindParam(3, $epoch);
    $tmp = time();
    $stmt->bindParam(4, $tmp);
    $statustmp = "BKD";  // sets the status of the appointment to booked
    $stmt->bindParam(5, $statustmp);

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}

function appt_getter($conn){
    // function to get all the admin suitable for an appointment

    $sql = "SELECT b.bookid, b.appointmentdate, b.bookedon, b.status, s.role, s.fname, s.sname, s.room from book b JOIN staff s ON b.staffid = s.staffid WHERE b.userid = ? ORDER BY b.appointmentdate ASC";
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

function cancel_appt($conn, $aptid){
    $sql = "DELETE FROM book WHERE bookid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $aptid);
    $stmt->execute();
    $conn = null;
    return true;
}

function appt_fetch($conn, $bookid){
    $sql = "SELECT * FROM book WHERE bookid = ?";
    //get all admin from datbase where role NOT equal to "adm" - this is admin role, none bookable
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $bookid);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
   return $result;
}

function audit_getter($conn, $auditfilter){
    if($auditfilter == "") {
        $sql = "SELECT * FROM audit WHERE userid = ?";  // selects everything for the current user
    } else {
        $sql = "SELECT * FROM audit WHERE userid = ? AND code = ?";
    }
    $stmt = $conn->prepare($sql);  // prepares the statement, most secure way of doing the query

    $stmt->bindParam(1, $_SESSION['userid']);  // bind the paramter for security

    if(!$auditfilter == ""){
        $stmt->bindParam(2, $auditfilter);  // bind the paramter for security
    }

    $stmt->execute();  // execute our query
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetch all to get all of the result
    $conn = null; // null off the connection so it is closed
    if($result){  // if there is a result from the db
        return $result;  // return the result
    } else {  // otherwise
        return false;  // return false.
    }

}

function appt_update($conn, $bookid, $apptime){
    $sql = "UPDATE book SET staffid = ?, appointmentdate = ?  WHERE bookid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST["admin"]);
    $stmt->bindParam(2, $apptime);
    $stmt->bindParam(3, $bookid);
    $stmt->execute();
    $conn = null;
    return true;
}

function pwd_checker($password){
    $rules = array();

    $rules["1"] = lenchecker($password);
    $rules["2"] = capchecker($password);
    $rules["3"] = lowerchecker($password);
    $rules["4"] = specialchecker($password);
    $rules["5"] = "Rule 5 - " . numchecker($password). "Your Password must contain a number";
    $rules["6"] = "Rule 6 - " . specialcheckerfirst($password[0]). "First character cannot be a special character";
    $rules["7"] = "Rule 7 - " . specialcheckerfirst($password[strlen($password)]). "Last character cannot be a special character";
    $rules["8"] = pwdcontains($password);
    $rules["9"] = "Rule 9 - " . numchecker($password[0]). "Your password cannot start with a number";
    return $rules;
}

function pwdcontains($password){
    if(str_contains($password, "password") OR str_contains($password,"Password") OR str_contains($password, "PASSWORD")){
        return "Rule 8 - Fail: Your password should not contain the word password";
    } else {
        return "Rule 8 - Pass: Your password should not contain the word password";
    }
}

function specialcheckerfirst($password){
    if (preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "Fail: ";
    } else {
        return "Pass: ";
    }
}

function numchecker($password){
    if (!preg_match('/[0-9]/', $password)) {
        if(strlen($password)==1){
            return "Pass: ";
        } else {
            return "Fail: ";
        }
    } else {
        return "Pass: ";
    }
}

function specialchecker($password){
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "Rule 4 - Fail: Your password must contain at least 1 Special Character";
    } else {
        return "Rule 4 - Pass: Your password must contain at least 1 Special Character";
    }
}

function lowerchecker($password){
    if (!preg_match('/[a-z]/', $password)) {
        return "Rule 3 - Fail: Your password must contain at least 1 lowercase letter";
    } else {
        return "Rule 3 - Pass: Your password must contain at least 1 lowercase letter";
    }
}

function capchecker($password){
    if (!preg_match('/[A-Z]/', $password)) {
        return "Rule 2 - Fail: Your password must contain at least 1 uppercase letter";
    } else {
        return "Rule 2 - Pass: Your password must contain at least 1 uppercase letter";
    }
}

function lenchecker($password){
    if(strlen($password) < 8){
        return "Rule 1 - FAIL: Your password is less than 8 characters";
    }
    else{
        return "Rule 1 - Pass: Your password is longer than 8 characters";
    }
}