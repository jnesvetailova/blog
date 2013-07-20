<html> 
<head>
  <link rel="stylesheet" type="text/css" href="index.css">
	
</head>
<body>

<div id="welcome">
	<h1>Welcome<?php  $_POST['username']?></h1>
</div>
	
<div id="status">
	<a href="logout.php">Sign out</a>	
</div>
	
</body>
</html>

<?php
$user_name = $_POST['passwd'];
echo($user_name);
?>
