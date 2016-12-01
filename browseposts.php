<!DOCTYPE HTML>
<html>
	<head>
		<title>GameSwapTally</title>
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/favicon.png">
	</head>
	
	<body>
		<div class="wrapper">
			<div class="Header">
				<div id="left0">
					<a href="index.html"><img src="logo.png" alt="GameSwapTally" id="homeLogo"></img></a>
				</div>
				<div id="right0">
					<a href="https://www.cs.fsu.edu/"><img src="asset/fsu1.png" 
						onmouseover="this.src='asset/fsu2.png'" height="50" width="50"/></a>
					<a href="https://github.com/GameSwapTally/gameswap"><img src="asset/Github1.png" 
						onmouseover="this.src='asset/Github2.png'" height="50" width="50"/></a>
				</div>
			</div> <!-- end Header -->
			<br><br>

<h1>All Posts</h1>
<?php
include_once("php_includes/check_login_status.php");
$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");

if ($user_ok == true) {
		$u = $log_username;
	}
else {
	header("location: login.php");
}

$sql = "SELECT * FROM posts";
$query = mysqli_query($db_conx, $sql);

while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	//echo $row["title"] ." ".$row["id"];
	$linkaddress = "post.php?p=".$row["id"];
	$title = $row["title"];
	$date = $row["createtime"];
	$platform = $row["platform"];
	//echo $linkaddress."\n";
	echo "<a href='".$linkaddress."'>".$title."</a> | ".$platform. " | ".$date."<br><br>";
	//echo "\n";
}
?>

			<div id="footer">
				<a href="about.html">About</a>
				<a href="contact.php">Contact</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
	</body>
</html>