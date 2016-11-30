<html>
	<head>
	<title>Browse - GameSwapTally</title>
		<link rel="icon" href="2.ico">
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
					<a href="login.php" class="logIn">Log In</a>
					<a href="signup.php">Sign Up</a>
				</div>
			</div> <!-- end Header -->
			<br>
			
			
			<?php
			
			$servername = "localhost";
			$username = "root";
			$password = "meat";
			$connection = mysql_connect($servername, $username, $password);
			if (!$connection) 
				die("Connection failed: " . $connection->connect_error);
			mysql_select_db('gameswaptally', $connection);
			
			?>
			<br><br>
			<h1 id="browse">Browse</h1>
			<form name="game_search" method="POST">
			<p><strong>These fields are optional.</strong></p>
			<p><strong>Title: </strong><input type="text" name="title" size="30"/></p>
			<p><strong>System: </strong><input type="text" name="system" size="30"/></p>
			<input type="submit" name="submit" value="Search"/>
			<br></br>
			</form>
			
			<!--<form name = "homesort" method = "POST">
			<strong>Sort by: <br>
			Title (A - Z)<input name="sort_title_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY title ASC'?>">
			Title (Z - A)<input name="sort_title_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY title DESC'?>">
			System (A - Z)<input name="sort_system_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY system ASC'?>">
			System (Z - A)<input name="sort_system_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY system DESC'?>">
			Year (old - new)<input name="sort_year_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY year ASC'?>">
			Year (new - old)<input name="sort_year_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY year DESC'?>">
			Publisher (A - Z)<input name="sort_publisher_asc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY publisher ASC'?>">
			Publisher (Z - A)<input name="sort_publisher_desc" type="radio" value="<?php echo 'SELECT * FROM games ORDER BY publisher DESC'?>">
			<input name="sort" type="submit" value="Sort">
			 -->

			<?php
			if(isset($_POST["submit"]))
			{
				$swapsql= "SELECT `swap`.`title`, `swap`.`system`, `users`.`username`, `swap`.`price`
						FROM `swap`,`users`
						WHERE `swap`.`userID`= `users`.`id`";
				if(!empty($_POST['title']))
					$swapsql .= " AND title LIKE '%$_POST[title]%'";

				if(!empty($_POST['system']))
					$swapsql .= " AND system LIKE '%$_POST[system]%'";
			
				$swapsql .= ";";
				$swapresult = mysql_query($swapsql);
				
				$wishsql = "SELECT `wished`.`title`, `wished`.`system`, `users`.`username`
							FROM `wished`,`users`
							WHERE `wished`.`userID`= `users`.`id`";
				if(!empty($_POST['title']))
					$wishsql .= " AND title LIKE '%$_POST[title]%'";

				if(!empty($_POST['system']))
					$wishsql .= " AND system LIKE '%$_POST[system]%'";
				
				$wishsql .= ";";
				$wishresult = mysql_query($wishsql);
				
			}
				
		/*if (isset($_POST['sort']))
		{
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
		}*/
			// display swap list
			if(isset($_POST["submit"]))
			{
				$swaprowcount = mysql_num_rows($swapresult);
				if ($swaprowcount > 0)
				{
					echo '<h2>Community Swap List</h2>';
					echo '</form>';
					echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
					echo '<thead>
					<tr>
					<th>Title</th>
					<th>System</th>
					<th>Users</th>
					<th>Price</th>
					</tr>
					</thead>';
					while($row = mysql_fetch_array($swapresult))
					{
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['username'] . "</td><td>" . $row['price'] . "</td></tr>";
					}
					echo "</table>";
				}
				$wishrowcount = mysql_num_rows($wishresult);
				if ($wishrowcount > 0)
				{
					echo '<h2>Community Wish List</h2>';
					echo '</form>';
					echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
					echo '<thead>
					<tr>
					<th>Title</th>
					<th>System</th>
					<th>Users</th>
					</tr>
					</thead>';
					while($row = mysql_fetch_array($wishresult))
					{
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['username'] . "</td></tr>";
					}
					echo "</table>";
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