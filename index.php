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


<!DOCTYPE HTML>
<html>
	<head>
		<title>GameSwapTally</title>
		<meta name="viewport" content="width=device-width" />
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/favicon.png">
		<script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
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
					<!-- <a href="login.php">Log In</a>
					<a href="signup.php">Sign Up</a> -->
				</div>
			</div> <!-- end Header -->
			<br><br>
			
			<div class="Browse">
				<div id="browse">
					<a href="browse.php" class="BrowseButton">Start Browsing!</a>
				</div>
			</div>
			
			<div class="One">
				<div id="right1">
					<ul>
						<h1>A NEW WAY TO TRADE YOUR GAMES</h1>
						<h3>GameSwapTally makes it easy for you to trade your games in Tallahassee!</h3>
					</ul>
				</div>
			</div>
			
			<div class="Two">
				<div id="right2">
					<ul>
						<h1>TRADING MADE EASY</h1>
						<h3>Use our app or you you are not going to have a good time!</h3>
					</ul>
				</div>
			</div>
			
			<div class="Three">
				<div id="right3">
					<ul>
						<h1>THE COMMUNITY BEGINS WITH YOU</h1>
						<h3>Making new friends has never been this fun or easy. New connections and new challenges await with every game.</h3>
					</ul>
				</div>
			</div>
			
			
			<div id="footer">
				<a href="about.html">About</a>
				<a href="contact.php">Contact</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
	</body>
</html>
