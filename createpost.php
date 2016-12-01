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
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Create Post - GameSwapTally</title>
<link rel="stylesheet" type="text/css" href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/general.css">
<link rel="icon" type="image/png" href="asset/favicon.png">
<script>
function check(data)
{
	if(data == 'swap')
	{
		document.getElementById('priceText').style.display = 'block';
		document.getElementById('priceInput').style.display = 'block';
	}
	else if(data == 'wish')
	{
		document.getElementById('priceText').style.display = 'none';
		document.getElementById('priceInput').style.display = 'none';
	}
}
</script>
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
				</div>
			</div> <!-- end Header -->
			<br>
		<div id="creatpostReturn">
			<?php
echo '<div style="text-align:center"><a href="/user.php?u='.$u.'">< Return to Profile</a></div>';
?>
</div>
	<h1>Create Post</h1>

	<form method="post">
		<div>Post Title:</div>
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
		</select><br>
		Are you wishing for a game or looking to swap?<br>
		<br><input type="radio" onclick="check(this.value);" name="swapOrWish" id="wish" value="wish">Wish
		<input type="radio" onclick="check(this.value);" name="swapOrWish" id="swap" value="swap">Swap
		<div style= "display: none" id = "priceText">Trade or Price: $</div>
		<input style= "display: none" type="text" name="price" id = "priceInput" value="Trade"><br>
		
		<br>
		<input type = "submit" value="Submit" name="submit"> 
		<?php
			// echo $_POST["title"];
			// echo $_POST["description"];
			// echo $_POST["gametitle"];
			//echo $_POST["platform"];

			$_t = $_POST["title"];
			$_d = $_POST["description"];
			$_gt = $_POST["gametitle"];
			$_p = $_POST["platform"];
			$pr = (int)$_POST["price"];
			$userID = $_SESSION['userid'];

			$t = mysqli_real_escape_string($db_conx, $_t);
			$d = mysqli_real_escape_string($db_conx, $_d);
			$gt = mysqli_real_escape_string($db_conx, $_gt);
			$p = mysqli_real_escape_string($db_conx, $_p);

			if(isset($_POST['submit']))
			{
				if($t != "" && $d != "" && $gt != "" && $p != "") 
				{
					$postSql = "INSERT INTO posts (title, content, gametitle, platform, price, user,createtime)
						VALUES('$t', '$d', '$gt', '$p', '$pr','$u', now())";
					$query = mysqli_query($db_conx, $postSql);
					$pid = mysqli_insert_id($db_conx);
					if ($_POST['swapOrWish'] == "swap")
					{
						// add to swap list
						if($pr == NULL) $pr = "Trade"; 
						$swapsql = "INSERT INTO `swap` (title, system, userID, price, postID)
						VALUES('$gt', '$p', '$userID', '$pr', '$pid')";
						$swapquery = mysqli_query($db_conx, $swapsql);
						
					}
					else if ($_POST['swapOrWish'] == "wish")
					{
						// add to wish list
						$wishsql = "INSERT INTO `wished` (title, system, userID, postID)
						VALUES('$gt', '$p', '$userID', '$pid')";
						$wishquery = mysqli_query($db_conx, $wishsql);
					}
					$sql = "SELECT `id`
							FROM `posts`
							WHERE `title` = '$t'";
					$query = mysqli_query($db_conx, $sql);
					
					while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) 
					{
						$pN = $row["id"];
					}

					//echo $pN;
					$head = "location: post.php?p=";
					//echo $head;
					$head .= $pN;
					header($head);
					//header("location: post.php");
				}
			}
		?>
	</form>
	
	<div id="browseFooter">
		<a href="about.html">About</a>
		<a href="contact.php">Contact</a>
		<a href="terms.html">Terms</a>
	</div>
	</div> <!-- end wrapper -->
</body>
