<?php
error_reporting(0);
include('connect.php');

if (isset($_POST['submit'])) { // if form has been submitted
    // makes sure they filled it in
    if (!$_POST['username'] | !$_POST['passwd']) {
    	die('You did not fill in a required field.');
    }

    // checks it against the database
//    if (!get_magic_quotes_gpc()) {
//        $_POST['email'] = addslashes($_POST['email']);
//    }
    $check = mysql_query("SELECT * FROM main WHERE author = '" . $_POST['username'] . "'") or die(mysql_error());

    //Gives error if user dosen't exist
    $check2 = mysql_num_rows($check);
    if ($check2 == 0) {
        die('Username does not exist!');
    }

    while ($info = mysql_fetch_array($check)) {
        $_POST['passwd'] = stripslashes($_POST['passwd']);

        $info['passwd'] = stripslashes($info['passwd']);

        $_POST['passwd'] = md5($_POST['passwd']);
        //gives error if the password is wrong
        if ($_POST['passwd'] != $info['passwd']) {
            die('Incorrect password, please try again.');
        } else {
            // if login is ok then we add a cookie 
            $_POST['username'] = stripslashes($_POST['username']);
            $hour = time() + 3600;
            setcookie(ID_my_site, $_POST['username'], $hour);
            setcookie(Key_my_site, $_POST['pass'], $hour);
            //then redirect them to the members area 
            header("Location: members.php");
        }
    }
} else {
    echo "Please log in!";
}
mysql_close($con);
?>
