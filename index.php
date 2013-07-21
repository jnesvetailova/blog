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
                echo $mysqltime;?>
            </h5>
            
            <div id="index_top">
                <div id="index_login">
                    <?php
                        //checks cookies to make sure they are logged in 
                        include('connect.php');
                        if (isset($_COOKIE['ID_my_site'])) {
                            $username = $_COOKIE['ID_my_site'];
                            echo $username . " logged in.";
                           echo "<a href=logout.php> Log out </a> <br /><br />";
                            } else {
                                echo "<a href=login.php class='a1'>Login</a>,<a href=registration.php class='a1'>Register</a><br /><br />";
                            }
                    ?>
                </div>
            </div>          
        </div>  
        <div id="body">
            <p>
                            
            <!--            <a href="login.php">Login</a>,<a href="registration.php">Register</a>-->
            </p>
            <div id="recent_blogs">
            <h3>Recent Blogs</h3>
            <?php
                error_reporting(0);
                include('connect.php');

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
         </div>
    </body>
</html>
