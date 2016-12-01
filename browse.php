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

<html>
	<head>
	<title>Browse - GameSwapTally</title>
	
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="jquery-ui.js"></script>
	<link rel="stylesheet" href="jquery-ui.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function() 
	{
	 $( "#games" ).autocomplete({
	  source: 'autocomplete.php'
	 });
	});
	</script>
	
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
			<p><strong>These fields are optional. <br>Click the search button with empty fields to reset the search.</strong></p>
			
			<div class="ui-widget">
				<p><strong>Title: </strong>
				<input type="text" name="title" size="50" id="games"/></p>
			</div>
			
			<div><strong>System:</strong></div>
			<select name="system">
			<option value=""></option>
			<option value="PlayStation 4">PlayStation 4</option>
			<option value="PlayStation 3">PlayStation 3</option>
			<option value="PlayStation 2">PlayStation 2</option>
			<option value="PlayStation">PlayStation</option>
			<option value="Xbox One">Xbox One</option>
			<option value="Xbox 360">Xbox 360</option>
			<option value="Xbox">Xbox</option>
			<option value="Wii U">Wii U</option>
			<option value="Wii">Wii</option>
			<option value="Nintendo GameCube">Nintendo GameCube</option>
			<option value="Nintendo 64">Nintendo 64</option>
			<option value="Super Nintendo Entertainment System">Super Nintendo Entertainment System</option>
			<option value="Nintendo Entertainment System">Nintendo Entertainment System</option>
			<option value="Nintendo 3DS">Nintendo 3DS</option>
			<option value="Nintendo DS">Nintendo DS</option>
			<option value="Game Boy Advance">Game Boy Advance</option>
			<option value="Game Boy Color">Game Boy Color</option>
			<option value="Game Boy">Game Boy</option>
		</select>
		<p><strong>User: </strong><input type="text" name="user" size="30"/></p>
		<p><strong>Price Range: </strong><br></p>
			<p>Min: <input type="number" name="minprice" size="30"/> Max: <input type="number" name="maxprice" size="30"/> </p>
			<p>Trade: <input type="radio" name="trade"></p>
			<input type="submit" name="search" value="Search"/>
			<br></br>
			</form>

			<?php
			// search field sql for swap , only if search button is clicked
			if (isset($_POST['search']))
			{
					$swapsql = "SELECT `swap`.`title`, `swap`.`system`, `users`.`username`, `swap`.`price`, `swap`.`postID`
							FROM `swap`,`users`
							WHERE `swap`.`userID`= `users`.`id`";
							
					if(!empty($_POST['title']))
						$swapsql .= " AND title LIKE '%$_POST[title]%'";

					if(!empty($_POST['system']))
						$swapsql .= " AND system LIKE '%$_POST[system]%'";
					
					if (!empty($_POST['user']))
						$swapsql .= " AND username LIKE '%$_POST[user]%'";
					
					if (!empty($_POST['minprice']) && !empty($_POST['maxprice']) && !isset($_POST['trade']))
						$swapsql .= "AND price BETWEEN '$_POST[ticketlow]' AND '$_POST[tickethigh]'";
					
					else if (isset($_POST['trade']) && empty($_POST['minprice']) && empty($_POST['maxprice']))
						$swapsql .= "AND price='Trade'";
					
					else if ((!empty($_POST['minprice']) || !empty($_POST['maxprice'])) && isset($_POST['trade']))
						echo '<br><p>Error! Please choose either trade OR price.</p><br>';
					
					else if (empty($_POST['minprice']) && !empty($_POST['maxprice']))
						echo '<br><p>Error! Please enter two prices.</p><br>';
					
					else if (!empty($_POST['minprice']) && empty($_POST['maxprice']))
						echo '<br><p>Error! Please enter two prices.</p><br>';
				
					$swapresult = mysql_query($swapsql);
				  
			// search field sql for wish
					$wishsql = "SELECT `wished`.`title`, `wished`.`system`, `users`.`username`, `wished`.`postID`
								FROM `wished`,`users`
								WHERE `wished`.`userID`= `users`.`id`";
								
					if(!empty($_POST['title']))
						$wishsql .= " AND title LIKE '%$_POST[title]%'";

					if(!empty($_POST['system']))
						$wishsql .= " AND system LIKE '%$_POST[system]%'";
					
					if(!empty($_POST['user']))
						$wishsql .= " AND username LIKE '%$_POST[user]%'";
					
					$wishresult = mysql_query($wishsql);
			}	
			
			
		//default if submit is not selected, show everything
		if (!isset($_POST['search']))
		{
				$defaultswapsql = "SELECT `swap`.`title`, `swap`.`system`, `users`.`username`, `swap`.`price`, `swap`.`postID`
						FROM `swap`,`users`
						WHERE `swap`.`userID`= `users`.`id`";
				$defaultswapresult = mysql_query($defaultswapsql);
				$defaultswaprowcount = mysql_num_rows($defaultswapresult);
				if ($defaultswaprowcount > 0)
				{
					echo '<h2>Community Swap List</h2>';
					echo '</form>';
					echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
					echo '<thead>
					<tr>
					<th>Title</th>
					<th>System</th>
					<th>Price</th>
					<th>Users</th>
					<th>Post Link</th>
					</tr>
					</thead>';
					while($row = mysql_fetch_array($defaultswapresult))
					{
						$linkaddress = "post.php?p=".$row["postID"];
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['price'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
					}
					echo "</table>";
				}
				$defaultwishsql = "SELECT `wished`.`title`, `wished`.`system`, `users`.`username`, `wished`.`postID`
							FROM `wished`,`users`
							WHERE `wished`.`userID`= `users`.`id`";
				$defaultwishresult = mysql_query($defaultwishsql);
				$defaultwishrowcount = mysql_num_rows($defaultwishresult);
				if ($defaultwishrowcount > 0)
				{
					echo '<h2>Community Wish List</h2>';
					echo '</form>';
					echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
					echo '<thead>
					<tr>
					<th>Title</th>
					<th>System</th>
					<th>Users</th>
					<th>Post Link</th>
					</tr>
					</thead>';
					
					while($row = mysql_fetch_array($defaultwishresult))
					{
						$linkaddress = "post.php?p=".$row["postID"];
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
					}
					echo "</table>";
				}
		
		}
		
		// if search button is hit, then display appropriate results
		else if(isset($_POST['search']))
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
					<th>Price</th>
					<th>Users</th>
					<th>Post Link</th>
					</tr>
					</thead>';
					while($row = mysql_fetch_array($swapresult))
					{
						$linkaddress = "post.php?p=".$row["postID"];
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['price'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
					}
					echo "</table>";
				}
				// reset search if no fields are filled
				else if ($swaprowcount > 0 && empty($_POST['minprice']) && empty($_POST['maxprice']) && !isset($_POST['trade'])
						&& empty($_POST['title']) && empty($_POST['username']) && empty($_POST['system']))
				{	
					echo '<h2>Community Swap List</h2>';
					echo '</form>';
					echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
					echo '<thead>
					<tr>
					<th>Title</th>
					<th>System</th>
					<th>Price</th>
					<th>Users</th>
					<th>Post Link</th>
					</tr>
					</thead>';
					while($row = mysql_fetch_array($swapresult))
					{
						$linkaddress = "post.php?p=".$row["postID"];
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['price'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
					}
					echo "</table>";
	
				}
				$wishrowcount = mysql_num_rows($wishresult);
				if ($wishrowcount > 0)
				{
					if (empty($_POST['minprice']) && empty($_POST['maxprice']) && !isset($_POST['trade']))
					{
						echo '<h2>Community Wish List</h2>';
						echo '</form>';
						echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
						echo '<thead>
						<tr>
						<th>Title</th>
						<th>System</th>
						<th>Users</th>
						<th>Post Link</th>
						</tr>
						</thead>';
						while($row = mysql_fetch_array($wishresult))
						{
							$linkaddress = "post.php?p=".$row["postID"];
							echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
						}
						echo "</table>";
					}
				}
				// reset search by clicking search with no fields entered
				else if ($wishrowcount > 0 && empty($_POST['minprice']) && empty($_POST['maxprice']) && !isset($_POST['trade'])
						&& empty($_POST['title']) && empty($_POST['username']) && empty($_POST['system']))
					{
						echo '<h2>Community Wish List</h2>';
						echo '</form>';
						echo '<table width= "100%" bgcolor= "#FFFFFF" cellpadding="2" cellspacing="2" border="1"';
						echo '<thead>
						<tr>
						<th>Title</th>
						<th>System</th>
						<th>Users</th>
						<th>Post Link</th>
						</tr>
						</thead>';
						while($row = mysql_fetch_array($wishresult))
						{
							$linkaddress = "post.php?p=".$row["postID"];
							echo "<tr><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" . $row['username'] . "</td><td>" . "<a href='".$linkaddress."' style=display:block;>&nbsp;Click here!</a>" . "</td></tr>";
						}
						echo "</table>";
					}
			}
					
			?>
			
			<div id="browseFooter">
				<a href="about.html">About</a>
				<a href="contact.php">Contact</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
	</body>
</html>