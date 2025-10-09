<?php #this is to store reusable code for all pages

function only_user($conn, $username){
    try {
        $sql = "SELECT username FROM user WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1, $username);
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in only_user: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}


function new_console($conn, $post){
    try {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO console (manufacturer, c_name, release_date, controller_no, bit) VALUES (?, ?, ?, ?, ?)";  //prepare the sql to be sent
        $stmt = $conn->prepare($sql); //prepare to sql

        $stmt->bindParam(1, $post['manufacturer']);  //bind parameters for security
        $stmt->bindParam(2, $post['cname']);
        $stmt->bindParam(3, $post['release']);
        $stmt->bindParam(4, $post['controlno']);
        $stmt->bindParam(5, $post['bit']);

        $stmt->execute();  //run the query to insert
        $conn = null;  // closes the connection so cant be abused.
    }  catch (PDOException $e) {
        // Handle database errors
        error_log("Audit Database error: " . $e->getMessage()); // Log the error
        throw new Exception(" Audit Database error". $e); //Throw exception for calling script to handle.
    } catch (Exception $e) {
        // Handle validation or other errors
        error_log("Auditing error: " . $e->getMessage()); //Log the error
        throw new Exception("Auditing error: " . $e->getMessage()); //Throw exception for calling script to handle.
    }

}

function user_message(){
    if(isset($_SESSION['usermessage'])){
        $message = "<p>". $_SESSION['usermessage']."</p>";
        unset($_SESSION['usermessage']);
        return $message;
    } else{
        $message = "";
        return $message;
    }
}

function reg_user($conn,$post){
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO user (username, password, signupdate, dob, country) VALUES (?, ?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1, $post['username']);  //bind parameters for security
            // Hash the password
            $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);  //has the password
            $stmt->bindParam(2, $hpswd);
            $stmt->bindParam(3, $post['signup']);
            $stmt->bindParam(4, $post['dob']);
            $stmt->bindParam(5, $post['country']);

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

function login($conn, $usrname){
    try {  //try this code, catch errors
        $sql = "SELECT user_id, password FROM user WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1,$usrname);  //binds the parameters to execute
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;  // nulls off the connection so cant be abused.

        if($result){  // if there is a result returned
            return $result;

        } else {
            $_SESSION['usermessage'] = "User not found";
            header("Location: login.php");
            exit; // Stop further execution
        }

    } catch (Exception $e) {
        $_SESSION['usermessage'] = "User login".$e->getMessage();
        header("Location: login.php");
        exit; // Stop further execution
    }
}

function getnewuserid($conn, $email){  # upon registering, retrieves the userid from the system to audit.
    $sql = "SELECT user_id FROM user WHERE username = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $email);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    $conn = null;
    return $result["user_id"];
}

function audtitor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO audit (date, userid, code, longdesc) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql
    $date = date('Y-m-d'); # only variables should be passed, not direct calls to functions
    $stmt->bindParam(1, $date);  //bind parameters for security
    $stmt->bindParam(2, $userid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}