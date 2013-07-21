<!DOCTYPE html>
<html>
    <head>
        <title>Archives</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div id="welcome_message">
            <h1>
                Welcome to The Archives 
            </h1>
            <h5>
                We've been hosting the best blogs in the internet since 2013! <br />
                The time is now <?php
                date_default_timezone_set('America/New_York');
                $mysqltime = date("Y-m-d H:i:s");
                echo $mysqltime;
                ?>
            </h5>
        </div>
        <div id="body">
            <?php
            //checks cookies to make sure they are logged in 
            include('connect.php');
            if (isset($_COOKIE['ID_my_site'])) {
                $username = $_COOKIE['ID_my_site'];
                echo $username . " logged in.";
                echo "<a href=logout.php> Log out </a> <br /><br />";
            } else {
                echo "<a href=login.php>Login</a>,<a href=registration.php>Register</a><br /><br />";
            }
            $result = mysql_query("SELECT * FROM main");
            //if logged in, let blogs be clickable

            while ($row = mysql_fetch_array($result)) {
                if (isset($_COOKIE['ID_my_site'])) {
                    echo "<a href=pages.php?blogID=" . $row['blogID'] . ">" . $row['title'] . "</a>";
                } else {
                    echo $row['title'];
                }

//                echo "<a href=\"pages.php?blogid=".$row['blogID']."\">Click </a>";
                echo " by " . $row['author'];
                echo "<br />";
                echo $row['about'];
                echo "<br /><br />";
            }

            mysql_close($con);
            ?>
        </div>
    </body>
</html>
