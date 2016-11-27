<h1>All Posts</h1>
<?php
include_once("php_includes/check_login_status.php");
$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");

if ($user_ok == true) {
		$u = $log_username;
	}
else {
	header("location: login.php");
}

$sql = "SELECT * FROM posts";
$query = mysqli_query($db_conx, $sql);

while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	//echo $row["title"] ." ".$row["id"];
	$linkaddress = "post.php?p=".$row["id"];
	$title = $row["title"];
	$date = $row["createtime"];
	$platform = $row["platform"];
	//echo $linkaddress."\n";
	echo "<a href='".$linkaddress."'>".$title."</a> | ".$platform. " | ".$date."<br><br>";
	//echo "\n";
}
?>