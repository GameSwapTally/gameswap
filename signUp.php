<!DOCTYPE HTML>
<html>
	<head>
	<title>Register | GameSwapTally</title>
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/baby.png">
	</head>
	
	<body>
		<div class="wrapper">
			<div class="Header">
				<div id="left0">
					<a href="index.html"><h1><img src="logo.png" alt="GameSwapTally"></img></h1></a>
				</div>
				<div id="right0">
					<a href="https://www.cs.fsu.edu/"><img src="asset/fsu1.png" 
						onmouseover="this.src='asset/fsu2.png'" height="50" width="50"/></a>
					<a href="https://github.com/GameSwapTally/gameswap"><img src="asset/Github1.png" 
						onmouseover="this.src='asset/Github2.png'" height="50" width="50"/></a>
					<a href="logIn.php" class="logIn">Log In</a>
					<a href="signUp.php">Sign Up</a>
				</div>
			</div> <!-- end Header -->
			<br>
			
			<form name="signup" method="POST">
				<h1>Create your account</h1>
				<p>
					<input type="text" name="username" placeholder="Username*"/>
				</p>
				<p>
					<input type="email" name="email" id="email" placeholder="E-mail*"/>
				</p>
				<p>
					<input type="password" name="password" id="password" placeholder="Password*"/>
				</p>
				<p>
					<input type="password" name="repeatpassword" id="repeatPassword" placeholder="Repeat password*"/>
				</p>
				
				<input type="submit" name="submit" value="Create Account"><br><br>					
			</form>
				<?php
				
					$servername = "localhost";
					$username = "root";
					$password = "";
					$connection = mysql_connect($servername, $username, $password);

					if (!$connection) 
						die("Connection failed: " . $connection->connect_error);

					mysql_select_db('gameswaptally_test', $connection);
					if(isset($_POST["submit"]))																			// when user clicks submit button
					{
						if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])			// error if at least one field is not filled
						|| empty($_POST["repeatpassword"]))
							echo "Error: not all fields are filled. Try again!";
						
						else 
						{	
							if (($_POST["repeatpassword"]) != ($_POST["password"]))											// check if repeat and initial password match
								echo "Error: Both passwords do not match. Try again!";						
							else	
							{	// need to check if username already exists
									$sql = "INSERT INTO `users` (`userName`, `email`, `password`, `location`) 									
									VALUES ('$_POST[username]','$_POST[email]','$_POST[password]', ' ')";		// if passwords match and fields not empty, add to database
								
									if(!mysql_query($sql,$connection))
										die('Error: ' . mysql_error());
									if($sql)
									{
										echo "Success! Welcome to the GameSwapTally Community, fellow gamer!";
											$message = "Welcome to our community of Tallahassee gamers, " . "$_POST[username]";
											$message .= "! We can't wait for you to start browsing our catalog of games and enjoying our features. Game on, and start swapping!";
											$email = $_POST['email'];
											$subject = "Welcome, gamer!";
											$headers = "MIME-Version: 1.0" . "\r\n";
											$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
											mail($email, $subject, $message, $headers);
									}
							}
						}
					}
												
					
			
				?>
			<div id="browseFooter">
				<a href="about.html">About</a>
				<a href="contact.html">Contact</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
	</body>
</html>
