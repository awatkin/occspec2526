<?php

function usermessage(){
    if(isset($_SESSION['usermessage'])){
        if(str_contains($_SESSION['usermessage'],"ERROR")){
            $msg = "<div id='usererror'>".$_SESSION['usermessage']."</div>";
        } else {
            $msg = "<div id='usermessage'>".$_SESSION['usermessage']."</div>";
        }
        unset($_SESSION['usermessage']);
    } else {
        $msg = "";
    }
    return $msg;
}

function onlyuser($conn, $email){
    $sql = "SELECT email FROM user WHERE email = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $email);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function reg_user($conn){
    try {
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
    }  catch (PDOException $e) {
        // Handle database errors
        error_log("User Reg Database error: " . $e->getMessage()); // Log the error
        throw new Exception("User Reg Database error". $e); //Throw exception for calling script to handle.
    } catch (Exception $e) {
        // Handle validation or other errors
        error_log("User Registration error: " . $e->getMessage()); //Log the error
        throw new Exception("User Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
    }
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

function getnewuserid($conn){

}

function audtitor($conn, $userid, $code, $long){
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