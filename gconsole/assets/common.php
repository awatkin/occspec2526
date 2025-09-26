<?php #this is to store reusable code for all pages

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