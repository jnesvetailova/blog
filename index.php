<!DOCTYPE html>
<html>
    <head>
        <title>Archives</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>
            Welcome to The Archives
        </h1>
        <h5>
            We've been hosting the best blogs in the internet since 2013!
        </h5>
        <?php
        $username = "c43703";
        $password = "1db23";
        $con = mysql_connect("localhost", $username, $password) or die("cannot connect");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($username, $con);
        $result = mysql_query("SELECT * FROM main");
        while ($row = mysql_fetch_array($result)) {
            echo $row['title'];
            echo " by ". $row['author'];
            echo "<br />";
            echo $row['description'];
            echo "<br /><br />";
        }
        mysql_close($con);
        ?>
    </body>
</html>
