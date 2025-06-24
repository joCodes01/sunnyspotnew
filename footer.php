<?php

$currentpage = basename($_SERVER['SCRIPT_NAME']);

if ($currentpage != 'login.php' && $currentpage != 'logout.php' ) {

echo 
"<div class='footer'>
    <div>
        <a class='stafflogin' href='admin/login.php'>Staff login</a>
        <a class='stafflogout' href='admin/logout.php'>logout</a>
    </div>
</div>";
} else {
    echo 
    "<div class='footer'>
        <div>
            <a class='stafflogin' href='login.php'>Staff login</a>
            <a class='stafflogout' href='logout.php'>logout</a>
        </div>
    </div>";

}
?>

