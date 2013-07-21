<html>
    <head>
        <title>Archives</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>

        <?php
// Connects to your Database 
        include('connect.php');
        date_default_timezone_set('America/New_York');
//checks cookies to make sure they are logged in 

        if (isset($_COOKIE['ID_my_site'])) {
            $username = $_COOKIE['ID_my_site'];
            $pass = $_COOKIE['Key_my_site'];
            $check = mysql_query("SELECT * FROM main WHERE author = '$username'") or die(mysql_error());
            while ($info = mysql_fetch_array($check)) {
                //if the cookie has the wrong password, they are taken to the login page 

                if ($pass != $info['password']) {
                    header("Location: login.php");
                }
                //otherwise they are shown the admin area   
                else {
                    echo "Welcome " . $username . "<p>";
                    echo "<a href=index.php>Main page</a> <br />";
                    echo "<a href=logout.php>Logout</a> <br /> <br />";
                    ?>
                    <h3>
                        Post
                    </h3>
                    <?php
                    $posts = mysql_query("SELECT * FROM posts WHERE postID = '$_GET[postID]'");
                    while ($row = mysql_fetch_array($posts)) {
                        echo $row['title'];
                        echo " on " . $row['date'];
                        echo "<br />";
                        echo $row['content'];
                        echo "<br /><br />";
                    }
                    ?>
                    <h3>
                        Comments
                    </h3>
                    <?php
                    $result = mysql_query("SELECT * FROM comments WHERE postID = '$_GET[postID]'");
                    while ($row = mysql_fetch_array($result)) {
                        echo $row['author'];
                        echo " on " . $row['date'];
                        echo "<br />";
                        echo $row['content'];
                        echo "<br /><br />";
                    }
                }
            }
        } else {
//if the cookie does not exist, they are taken to the login screen 
            header("Location: login.php");
        }
//This code runs if the form has been submitted
        if (isset($_POST['submit'])) {
            //This makes sure they did not leave any fields blank
            if (!$_POST['content']) {
                die('You have not written anything.');
            }
            $mysqltime = date("Y-m-d H:i:s");
            // now we insert it into the database
            $insert = "INSERT INTO comments (postID, author, content, date)

 			VALUES ('" . $_GET[postID] . "', '" . $username . "', '" . $_POST['content'] . "', '" . $mysqltime . "')";

            $add_post = mysql_query($insert);
            echo $username . " on " . $mysqltime . "<br />";
            echo $_POST['content'] . "<br /><br />";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> 
            <table border="0"> 
                <tr>
                    <td>
                        <textarea rows="4" cols="50" name="content">Care to comment?</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left"> <input type="submit" name="submit" value="Post"> </td>
                </tr> 
            </table> 

        </form> 
    </body>
</html>
