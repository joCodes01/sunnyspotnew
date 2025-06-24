<?php

$currentpage = basename($_SERVER['SCRIPT_NAME']);

if ($currentpage != 'login.php' && $currentpage != 'logout.php' ) {
    echo "
    <div class='navbar'>
        <div class='navlogo-container'>
            <a href='allCabins.php'>
                <img class='navlogo' src='images/LOGO_sunnyspot.png' alt='image of rental cabin'>
            </a>
        </div>
        <ul class='navmenuitems'>
            <li id='margin-left-auto'><a href='allCabins.php'>Cabins</a></li>
            <li><a href='contact.php'>Contact</a></li>
        </ul>
    </div>";
} else {
    echo "
    <div class='navbar'>
        <div class='navlogo-container'>
            <a href='../allCabins.php'>
                <img class='navlogo' src='../images/LOGO_sunnyspot.png' alt='image of rental cabin'>
            </a>
        </div>
        <ul class='navmenuitems' >
            <li id='margin-left-auto'><a href='../allCabins.php'>Cabins</a></li>
            <li><a href='../contact.php'>Contact</a></li>
        </ul>
    </div>";
        


    }

?>