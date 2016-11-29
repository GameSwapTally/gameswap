<?php
	include_once("php_includes/check_login_status.php");
	$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");

	if ($user_ok == true) {
		$u = $log_username;
	}
	else {
		header("location: login.php");
	}

	if(isset($_GET["p"])) {
		$p = (int)$_GET["p"];
		//echo $p;
	} else {
		header("location: browseposts.php");
	}

	$sql = "SELECT * FROM posts WHERE id='$p' LIMIT 1";
	$query = mysqli_query($db_conx, $sql);

	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$title = $row["title"];
		$content = $row["content"];
		$gametitle = $row["gametitle"];
		$platform = $row["platform"];
		$username = $row["user"];
	}


	$sql = "SELECT email FROM users WHERE username = '$username'";
	$query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$email = $row["email"];
	}
?>

<a href="browseposts.php">&lt; Back to All Posts</a>
<h2><?php echo $title; ?></h2>
<h3><?php echo $gametitle." for ".$platform; ?></h3>
<p><?php echo $content; ?></p>
<?php echo '<a href="mailto:'.$email.'?Subject=RE: '.$title.'">Contact Poster</a>'; ?>



