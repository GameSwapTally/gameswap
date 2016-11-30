<?php
	//include_once("db_conx.php");
	include_once("php_includes/check_login_status.php");
	$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");

	if ($user_ok == true) {
		$u = $log_username;
	}
	else {
		header("location: login.php");
	}

	// echo $_POST["title"];
	// echo $_POST["description"];
	// echo $_POST["gametitle"];
	//echo $_POST["platform"];

	$_t = $_POST["title"];
	$_d = $_POST["description"];
	$_gt = $_POST["gametitle"];
	$_p = $_POST["platform"];
	$pr = (int)$_POST["price"];

	$t = mysqli_real_escape_string($db_conx, $_t);
	$d = mysqli_real_escape_string($db_conx, $_d);
	$gt = mysqli_real_escape_string($db_conx, $_gt);
	$p = mysqli_real_escape_string($db_conx, $_p);


	if($t != "" && $d != "" && $gt != "" && $p != "" && $pr != NULL) {
		$sql = "INSERT INTO posts (title, content, gametitle, platform, price, user,createtime)
			VALUES('$t', '$d', '$gt', '$p', '$pr','$u', now())";
		$query = mysqli_query($db_conx, $sql);
		$pid = mysqli_insert_id($db_conx);

		header("location: index.html");
	}



?>

<!DOCTYPE HTML>
<html>
<head>
<title>Create Post - GameSwapTally</title>
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
				</div>
			</div> <!-- end Header -->
			<br>


	<h1>Create Post</h1>

	<form method="post">
		<div>Title:</div>
		<input type="text" name="title"><br>
		<div>Description:</div>
		<textarea name="description" rows="10" cols="50"></textarea><br>
		<div>Game Title:</div>
		<input type="text" name="gametitle"><br>
		<div>Platform:</div>
		<select name="platform">
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
		<div>Price: $</div>
		<input type="text" name="price"><br>
		Are you wishing for a game or looking to swap?
		<input type="radio" name="swap" value="swap">Swap<br>
		<input type="radio" name="wish" value="wish">Wish<br>
		<br>
		<button id="submitbutton"> Submit</button>
	</form>
	
	<div id="browseFooter">
		<a href="about.html">About</a>
				<a href="terms.html">Terms</a>
	</div>
	</div> <!-- end wrapper -->
</body>
