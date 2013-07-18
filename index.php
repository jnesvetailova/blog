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
            echo " by " . $row['author'];
            echo "<br />";
            echo $row['description'];
            echo "<br /><br />";
        }
        mysql_close($con);
        ?>
        <div>
            <h4>Login</h4>
            <form action="login.php" method="POST">
                Username: <input type="text" name="username"></input><br />
                Password: <input type="password" name="passwd"></input><br />
<!--                <button value="Submit" class="send_button" onclick="this.form.submit();">Login</button>-->
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
        <div>
            <h4>Register Account!</h4>
            <form action="create.php" method="POST">
                Please enter a username: <input type="text" name="username"></input><br />
                Choose a password: <input type="password" name="password"></input><br />
                Confirm password: <input type="password" name="password2"></input><br />
                Name your blog: <input type="text" name="title"></input><br />
                What will your blog be about? <input type="text" name="description"></input><br />
                <!--                <button value="Submit" class="send_button" onclick="this.form.submit();">Register</button>-->
                <input type="submit" name="submit" value="Register">
            </form>
        </div>
    </body>
</html>
