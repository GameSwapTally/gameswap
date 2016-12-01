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
		<title>Contact - SmashDB</title>
		<meta name="viewport" content="width=device-width" />
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
			
			<div id="form">
				<form id="gameForm" method="post">
					<h1>Contact us</h1>
					<?php
						if(isset($_POST['submit'])) {
							$n = $_POST["name"];
							$e = $_POST["email"];
							$m = $_POST["message"];

							if ($n != "" && $e != "" && $m != "") {
								$to = "GameSwapTally@gmail.com";
								$from = "gameswaptally@gmail.com";
								$subject = 'Message from '.$n.' ('.$e.')';
								$message = "You have a message:\n".$m;
								mail($to, $subject, $message);
								header("location: index.php");


							}
							else {
								echo "Please fill out all of the form fields";
							}
						}
					?>
					<div class="contactForm" id="nameForm">
						<input type="text" id="name" name="name" placeholder="Your name*"/>
						<br>
					</div>
					
					<div class="contactForm" id="emailForm">
						<input type="email" id="email" name="email" placeholder="Your e-mail*"/>
						<br>
					</div>
					
					<div class="contactForm" id="messageForm">
						<textarea id="message" name="message" placeholder="Your message...*"></textarea>
					</div>
					
					<input type="submit" value="Send your message" name="submit"><br><br>
				</form>
			</div> <!-- end of contact form -->
			
			<div id="browseFooter">
				<a href="about.html">About</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end class wrapper -->
	</body>
</html>
