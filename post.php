<?php
	include_once("php_includes/check_login_status.php");

	if ($user_ok == false) {
		$link1 = "login.php";
		$label1 = "Log In";
		$link2 = "signup.php";
		$label2 = "Sign Up";
	}

	else if ($user_ok == true) {
		$link1 = "user.php?u=".$log_username;
		$label1 = "My Profile";
		$link2 = "logout.php";
		$label2 = "Logout";
	}
?>

<?php
	include_once("php_includes/check_login_status.php");
	$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");

	if ($user_ok == true) {
		$u = $log_username;
	}
	else {
		header("location: login.php");
	}

	if(isset($_GET["p"])) {
		$p = (int)$_GET["p"];
		//echo $p;
	} else {
		header("location: browse.php");
	}

	$sql = "SELECT * FROM posts WHERE id='$p' LIMIT 1";
	$query = mysqli_query($db_conx, $sql);

	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$title = $row["title"];
		$content = $row["content"];
		$gametitle = $row["gametitle"];
		$platform = $row["platform"];
		$username = $row["user"];
	}

	$sql = "SELECT email FROM users WHERE username = '$username'";
	$query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$email = $row["email"];
	}
?>


<!DOCTYPE HTML>
<html>
<head>
		<title>Post - GameSwapTally</title>
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
					<a href="index.php"><img src="logo.png" alt="GameSwapTally" id="homeLogo"></img></a>
				</div>
				<div id="right0">
					<a href="https://www.cs.fsu.edu/"><img src="asset/fsu1.png" 
						onmouseover="this.src='asset/fsu2.png'" height="50" width="50"/></a>
					<a href="https://github.com/GameSwapTally/gameswap"><img src="asset/Github1.png" 
						onmouseover="this.src='asset/Github2.png'" height="50" width="50"/></a>
					<?php
						echo "<a href='".$link1."'>".$label1."</a>";
						echo "<a href='".$link2."'>".$label2."</a>";
					?>
				</div>
			</div> <!-- end Header -->
			<br>
			<br>
			<br>
			<br>
			<br>
<div id="postPage">
<a href="browse.php">&lt; Back to All Posts</a>
<h2><?php echo $title; ?></h2>
<h3><?php echo $gametitle." for ".$platform; ?></h3>
<p><?php echo $content; ?></p>
<br><br>

<?php 

echo '<a href="mailto:'.$email.'?Subject=RE: '.$title.'">Contact Poster</a>'; 

	echo '<br><br>';
	$imgsql = "SELECT image, imagename FROM users WHERE username='$username'";
	$imgquery = mysqli_query($db_conx, $imgsql);
	$imgresult = mysqli_fetch_array($imgquery);
	$encode = base64_encode( $imgresult['image'] );
	echo '<img src="data:image/jpeg;base64,'.$encode.'" height="100" width="100" border="4"/>';
	echo '            <br>  Posted by:';
	echo $username;

?>
</div>
<br>
<div id="browseFooter">
	<a href="about.html">About</a>
	<a href="contact.php">Contact</a>
	<a href="terms.html">Terms</a>	
</div>
</div>
</body>
</html>