<?php
$username = "c43703";
        $password = "1db23";
        $con = mysql_connect("localhost", $username, $password) or die("cannot connect");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($username, $con);
?>
        
