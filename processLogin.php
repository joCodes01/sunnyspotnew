<?php 
session_start();



//TO DO
//TO DO
//hash the passwords
//set session to logged in so user can stay logged in.

//write the SQL query 
$login_error_message = "";

//$logged_in = "FALSE";
$_SESSION['logged_in'] = FALSE;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //escape special charcters and trim the values of username and password
    $sanitize_username = $_POST['username'];
    $username = trim(htmlspecialchars($sanitize_username)); 

    $sanitize_password = $_POST['password'];
    $password = trim(htmlspecialchars($sanitize_password));



    //connect to tohe database
    include "dbconnect.php";
    
    //prepare SQL query to check if user existe in the database
    $stmt = $conn->prepare("SELECT * FROM Admin WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    //if a record with the given username is found
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //and if the password matches 
        if ($password === $row['password']) {

            $_SESSION['logged_in'] = TRUE;
            

            //send the user to the admin page
            header('Location: adminMenu.php');
            exit();
            
        //else if the password doesn't match then:
        }else {
            //set login error message
            $_SESSION['login_error_message'] = "Invalid username or password.";

            //send back to the login page to try again
            header('Location: login.php');
            exit();
        }
    //else if the username is not found then display invalid message    
    }else {
        //set login error message
         $_SESSION['login_error_message'] = "Invalid username or password.";

            //send back to the login page to try again
            header('Location: login.php');
            exit();
    }

    $stmt->close();

}



?>

