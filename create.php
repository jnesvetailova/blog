
<!DOCTYPE html>
<html>
    <head>
        <title>Create</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        <h1>Registered</h1>
        <?php
// Connects to your Database 

        $username = "c43703";
        $password = "1db23";
        $author_found = false;
        $password_correct = false;
        $con = mysql_connect("localhost", $username, $password) or die("cannot connect");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($username, $con);


//This code runs if the form has been submitted

        if (isset($_POST['submit'])) {
            //This makes sure they did not leave any fields blank
            if (!$_POST['username'] | !$_POST['password'] | !$_POST['password2'] | !$_POST['title'] | !$_POST['description']) {
                die('Some fields are missing');
            }

            // checks if the username is in use
            if (!get_magic_quotes_gpc()) {

                $_POST['username'] = addslashes($_POST['username']);
            }
            $usercheck = $_POST['username'];
            $check = mysql_query("SELECT author FROM main WHERE author = '$usercheck'") or die(mysql_error());
            $check2 = mysql_num_rows($check);

            //if the name exists it gives an error
            if ($check2 != 0) {
                die($_POST['username'] . ' is already in use.');
            }

            //     this makes sure both passwords entered match
            if ($_POST['password'] != $_POST['password2']) {

                die('Passwords did not match, try again!');
            }

            // here we encrypt the password and add slashes if needed
            $_POST['password'] = md5($_POST['password']);

            if (!get_magic_quotes_gpc()) {

                $_POST['password'] = addslashes($_POST['password']);

                $_POST['username'] = addslashes($_POST['username']);
            }



            // now we insert it into the database

            $insert = "INSERT INTO main (author, title, description, passwd)
   		VALUES ('" . $_POST['username'] . "', '" . $_POST['title'] . "', '" . $_POST['description'] . "', '" . $_POST['password'] . "')";
//    $insert = "INSERT INTO main VALUES ($_POST['username'], $_POST['password'])";
            $add_member = mysql_query($insert);
        }
        mysql_close($con);
        ?>
        <p>Thank you for registering! Please login now.</p>
    </body>
</html>