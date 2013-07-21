<html>
    <head>
        <title>Archives</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
    	<div id="body">
			<div id="comments_blogs">
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
								include('commentsII.php');
					?>
			</div>	  
				<div id="post_section">                 
                    <h3>
                        Post
                    </h3>  
				</div>
				<div id="comment_section">
                    <h3>
                        Comments
                    </h3>
                 </div>
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
			<div id="comment_blockII">
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
			</div>
		</div>              
    </body>
</html>
