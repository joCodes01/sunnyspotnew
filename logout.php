<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['logout']) &&  $_POST['logout'] === "logout"){
        unset($_SESSION['logged_in']);
        session_destroy();
        header('Location: login.php');
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logout</title>
</head>
<body>
    <!-- include PHP navigation here -->
    <?php include "navbar.php" ?>
   
    <section class="main-content">
       <!-- <h1>Logout</h1> -->
        <form method="POST" action="">
            <div>
                <input type="hidden" name="logout" value="logout">
            </div>
            <div>
                <input type="submit" value="Logout of staff dashboard ">
            </div>
        <form>
    </section>

    <!-- Add PHP footer here -->
    <?php include "footer.php" ?>
    
</body>
</html>

<!-- //add name to the logout input -->