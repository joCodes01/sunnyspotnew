<?php 

session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE) {
    header('Location: adminMenu.php');
    exit();
}

$login_error_message = "";

if (isset($_SESSION['login_error_message'])) {
  $login_error_message = $_SESSION['login_error_message'];
  unset($_SESSION['login_error_message']); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Staff login</title>
</head>
<body>
    <!-- include PHP navigation here -->
    <?php include "navbar.php" ?>
   
    <section class="main-content">
       <h1>Staff login</h1>

        <form action="processLogin.php" method="POST" id="loginform" >

            <div>
                <label for="username" >Username: </label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </div>
            <div class="login-button">
                <input type="submit" value ="login">
            </div>
        </form>
        <?php if (!empty($login_error_message)): ?>
        <div id="login-error-message"><?php echo $login_error_message; ?></div>
        <?php endif; ?>


    </section>

    <!-- Add PHP footer here -->
    <?php include "footer.php" ?>
    
</body>
</html>