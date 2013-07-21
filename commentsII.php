<html>
<head>
</head>
<body>

  <div id="logout_widget">
	<?php
		echo "Welcome " . $username . "&nbsp&nbsp&nbsp<a href=logout.php class='a1'>Logout</a>";
	?>
	</div>
	<div id="main_page">
		<?php
			echo "<a href=index.php class='a1'>Main page</a> <br />";
		?>
	</div>
	<div id="archives">
		<?php
		echo "Archives";									
		?>
	</div>
	
	<div id="comment_block">
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
	</div>
</body>
</html>
