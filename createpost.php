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
	$p = $_POST["platform"];
	$pr = (int)$_POST["price"];

	$t = mysqli_real_escape_string($db_conx, $_t);
	$d = mysqli_real_escape_string($db_conx, $_d);
	$gt = mysqli_real_escape_string($db_conx, $_gt);
	//$p = mysqli_real_escape_string($_p)

	//$u = "test";

	//echo $t;

	if($t != "" && $d != "" && $gt != "" && $p != "" && $pr != NULL) {
		$sql = "INSERT INTO posts (title, content, gametitle, platform, price, user,createtime)
			VALUES('$t', '$d', '$gt', '$p', '$pr','$u', now())";
		$query = mysqli_query($db_conx, $sql);
		// if (!$query) {
		// 	echo msqli_error();
		// }
		$pid = mysqli_insert_id($db_conx);

		header("location: index.html");
	}



?>

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
		<option value="Xbox One">Xbox One</option>
	</select>
	<div>Price: $</div>
	<input type="text" name="price"><br>
	<!-- <div>Are you looking to buy, sell, or trade? (select all that apply)</div>
	<input type="checkbox" name="buy" value="buy">Buy<br>
	<input type="checkbox" name="sell" value="sell">Sell<br>
	<input type="checkbox" name="trade" value="trade">Trade<br>
	<br> -->
	<button id="submitbutton"> Submit</button>
</form>

