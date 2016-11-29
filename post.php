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
		header("location: browseposts.php");
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

<head>
		<title>Terms | GameSwapTally</title>
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/baby.png">
</head>

<div class="wrapper">
			<div class="Header">
				<div id="left0">
					<a href="index.html"><img src="logo.png" alt="GameSwapTally"></img></a>
				</div>
				<div id="right0">
					<a href="https://www.cs.fsu.edu/"><img src="asset/fsu1.png" 
						onmouseover="this.src='asset/fsu2.png'" height="50" width="50"/></a>
					<a href="https://github.com/GameSwapTally/gameswap"><img src="asset/Github1.png" 
						onmouseover="this.src='asset/Github2.png'" height="50" width="50"/></a>
					<a href="login.php" class="logIn">Log In</a>
					<a href="signup.php">Sign Up</a>
				</div>
			</div> <!-- end Header -->
			<br>
			<br>
			<br>
<a href="browseposts.php">&lt; Back to All Posts</a>
<h2><?php echo $title; ?></h2>
<h3><?php echo $gametitle." for ".$platform; ?></h3>
<p><?php echo $content; ?></p>
<?php echo '<a href="mailto:'.$email.'?Subject=RE: '.$title.'">Contact Poster</a>'; ?>

<div id="browseFooter">
	<a href="about.html">About</a>
	<a href="contact.html">Contact</a>
	<a href="terms.html">Terms</a>	
</div>