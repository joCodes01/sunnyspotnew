<?php 
//connect to the database
$conn = new mysqli("localhost","root", "", "sunnySpot");

if($conn->connect_error) {
    die("Something went wrong. Please try again later" . $conn->connect_error);
    //delete the connection for users and enable error log instead.
}else{
    echo "<div class='db-message' hidden>database is connected</div> <br><br>";
}

?>