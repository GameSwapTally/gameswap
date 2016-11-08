<html>
	<head>
		<link rel="icon" href="2.ico">
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="form.css">
		<link rel="stylesheet" type="text/css" href="general.css">
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
			
			
			<?php
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$connection = mysql_connect($servername, $username, $password);
			if (!$connection) 
				die("Connection failed: " . $connection->connect_error);
			mysql_select_db('gameswaptally_test', $connection);
			
			?>
			<h1>Browse</h1>
			<form name="game_search" method="POST">
			<p><strong>These fields are optional.</strong></p>
			<p><strong>Title: </strong><input type="text" name="title" size="30"/></p>
			<p><strong>System: </strong><input type="text" name="system" size="30"/></p>
			<p><strong>Year: </strong>
			<select name = "year">
			<option value="">Select Year</option>
			<option value="1992">1992</option>
			<option value="1993">1993</option>
			<option value="1994">1994</option>
			<option value="1995">1995</option>
			<option value="1996">1996</option>
			<option value="1997">1997</option>
			<option value="1998">1998</option>
			<option value="1999">1999</option>
			<option value="2000">2000</option>
			<option value="2001">2001</option>
			<option value="2002">2002</option>
			<option value="2003">2003</option>
			<option value="2004">2004</option>
			<option value="2005">2005</option>
			<option value="2006">2006</option>
			<option value="2007">2007</option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			</select> 
			</p>
			<p><strong>Publisher: </strong> <input type="text" name="publisher" size="30"/></p>
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
				$sql= "SELECT * FROM games WHERE 1=1";
				if(!empty($_POST['title']))
					$sql .= " AND title LIKE '%$_POST[title]%'";

				if(!empty($_POST['system']))
					$sql .= " AND system LIKE '%$_POST[system]%'";
				
				if(!empty($_POST['year']))
					$sql .= " AND year LIKE '%$_POST[year]%'";
				
				if(!empty($_POST['publisher']))
					$sql .= " AND publisher LIKE '%$_POST[publisher]%'";
			
				$sql .= ";";
				$result = mysql_query($sql);
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
			
			if(isset($_POST["submit"]))
			{
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