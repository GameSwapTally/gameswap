<!DOCTYPE HTML>
<html>
	<head>
	<title>Log in | GameSwapTally</title>
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
					<h1>Logo</h1>
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
			<form action="">
				<h1>Log in</h1>
				<p>
					<input type="email" name="email" id="email" placeholder="E-mail..."/>
				</p>
				<p>
					<input type="password" name="password" id="password" placeholder="Password..."/>
				</p>
				<input type="submit" value="Log In"><br><br>
				<a href="passwordReset.html">Forgot Password?</a><br>
				<a href="signUp.php">Sign Up</a><br>
			</form>
			<?php
			
				if (isset($_POST["submit"]))
				{
					if (empty($_POST["email"]) || empty($_POST["password"]))
						echo "Error: not all fields are field. Try again!";
					else
					{
						$email = $_POST['email'];
						$password = $_POST['password'];
						$sql = "SELECT * FROM users WHERE email = '".$email."'
						AND password = '".$password."'";
						if(!mysql_query($sql,$connection))
							die('Error: ' . mysql_error());
						if ($sql)
						{
							// login , cookies and shit. Then redirect to the index page
							echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.html\">";
						}
						else
							echo "Error: invalid credentials. Try again!";
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