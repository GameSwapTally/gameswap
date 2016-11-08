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
			<form action="" method="post">
				<h1>Log in</h1>
				<p>
					<input type="email" name="email" id="email" placeholder="E-mail..."/>
				</p>
				<p>
					<input type="password" name="password" id="password" placeholder="Password..."/>
				</p>
				<input type="submit" name="submit" value="Log In"><br><br>
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
						$servername = "localhost";
                                                $username = "root";
                                                $pass = "";
                                                
                                                $email = $_POST['email'];
						$password = $_POST['password'];
                                                 
                                                $connection = mysql_connect($servername, $username, $pass);
                                                mysql_select_db('gameswaptally_test', $connection); 

						$sql = "SELECT * FROM users WHERE email = '".$email."'
						AND password = '".$password."'";
                                                //$connection = mysql_connect($servername, $username, $pass);
						if(!mysql_query($sql,$connection))
							die('Error: ' . mysql_error());
                                                    
                                               //mysql_select_db('gameswaptally_test', $connection); 

						if ($sql)
						{
							// login , cookies and shit. Then redirect to the index page

                                                        $_SESSION['email'] = $email;
                                                        $_SESSION['password'] = $password;

                                                        setcookie("email", $email, strtotime( '+30 days' ), "/", "", "", TRUE);
                                                        setcookie("password", $password, strtotime( '+30 days' ), "/", "", "", TRUE);

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
