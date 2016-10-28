<!DOCTYPE HTML>
<html>
	<head>
		<link rel="icon" href="2.ico">
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
					<a href="index.html"><h1>Logo</h1></a>
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
			
			<form method="post" action="">
				<select name="category" id="category">
					<option value="allcategories">All Categories</option>
					<option value="XboxOne">XBOX ONE</option>
					<option value="Xbox360">XBOX 360</option>
					<option value="Xbox">XBOX</option>
					<option value="PS4">PS4</option>
					<option value="PS3">PS3</option>
					<option value="PS2">PS2</option>
					<option value="PS1">PS1</option>	
					<option value="PSPVita">PSP VITA</option>
					<option value="PSP">PSP</option>
					<option value="WiiU">WII U</option>	
					<option value="Wii">WII</option>
					<option value="PC">PC</option>	<!--NEED MORE PLATFORMS, GCN, SNES, NES, N64, etc-->			
				</select>
				<br>
				<input type="search" name="search" placeholder="Browse...">
				<input type="submit" name="submit" value="Search">
			</form>
			
			<?php

                
                        if(isset($_COOKIE['email'])) {
                            echo "User logged in is: " . $_COOKIE['email'];
                        }

			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$connection = mysql_connect($servername, $username, $password);

			if (!$connection) 
				die("Connection failed: " . $connection->connect_error);

			mysql_select_db('gameswaptally_test', $connection);
			
			$sql = "SELECT * FROM games;";
			
			if(isset($_POST["submit"]))
			{
		
			$result = mysql_query($sql);
			echo '</form>';
			echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
			echo '<thead>
			<tr>
			<th>Title</th>
			<th>System</th>
			<th>Year</th>
			<th>Publisher</th>
			</tr>
			</thead>';
			while($row = mysql_fetch_array($result))
			{
				echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['year'] . "</td><td>" . $row['publisher'] . "</td></tr>";
			}
			echo "</table>";
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
