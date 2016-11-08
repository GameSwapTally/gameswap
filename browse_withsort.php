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
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$connection = mysql_connect($servername, $username, $password);

			if (!$connection) 
				die("Connection failed: " . $connection->connect_error);

			mysql_select_db('gameswaptally_test', $connection);
			
			?>
			
			<form name = "homesort" method = "POST">
			<strong>Sort by: <br>
			Title (A - Z)<input name="sort_title_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY title ASC'?>">
			Title (Z - A)<input name="sort_title_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY title DESC'?>">
			System (A - Z)<input name="sort_system_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY system ASC'?>">
			System (Z - A)<input name="sort_system_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY system DESC'?>">
			Year (old - new)<input name="sort_year_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY year ASC'?>">
			Year (new - old)<input name="sort_year_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY year DESC'?>">
			Publisher (A - Z)<input name="sort_publisher_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY publisher ASC'?>">
			Publisher (Z - A)<input name="sort_publisher_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY publisher DESC'?>">
			<input name="submit" type="submit" value="Sort">

			<?php
			$query = "SELECT * FROM games ORDER BY title ASC";
			$result = mysql_query($query);
			if (isset($_POST['sort_title_asc']))
			{
				$query = "SELECT * FROM games ORDER BY title ASC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_title_desc']))
			{
				$query = "SELECT * FROM games ORDER BY title DESC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_system_asc']))
			{
				$query = "SELECT * FROM games ORDER BY system ASC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_system_desc']))
			{
				$query = "SELECT * FROM games ORDER BY system DESC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_year_asc']))
			{
				$query = "SELECT * FROM games ORDER BY year ASC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_year_desc']))
			{
				$query = "SELECT * FROM games ORDER BY year DESC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_publisher_asc']))
			{
				$query = "SELECT * FROM games ORDER BY publisher ASC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}
			else if (isset($_POST['sort_publisher_desc']))
			{
				$query = "SELECT * FROM games ORDER BY publisher DESC";
				if (isset($_POST['submit']))
				{
					$result = mysql_query($query);
				}
			}

			
			
			if(isset($_POST["submit"]))
			{
		
				$result = mysql_query($query);
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