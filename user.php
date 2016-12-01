<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?>Profile - GameSwapTally</title>
<link rel="stylesheet" type="text/css" href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/general.css">
<link rel="icon" type="image/png" href="asset/favicon.png">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
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
					
<form method="post" enctype="multipart/form-data" id="userForm" width="100%">
<div align="center">
	<?php
		include_once("php_includes/check_login_status.php");
		$db_conx = mysqli_connect("localhost", "root", "meat", "gameswaptally");
		// Initialize any variables that the page might echo
		$u = "";
		$sex = "Male";
		$userlevel = "";
		$country = "";
		$joindate = "";
		$lastsession = "";
		// Make sure the _GET username is set, and sanitize it
		if(isset($_GET["u"])){
			$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
		} else {
			header("location: index.html");
			exit();	
		}
		// Select the member from the users table
		$sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";
		$user_query = mysqli_query($db_conx, $sql);
		// Now make sure that user exists in the table
		$numrows = mysqli_num_rows($user_query);
		if($numrows < 1){
			echo "That user does not exist or is not yet activated, press back";
			exit();	
		}
		// Check to see if the viewer is the account owner
		$isOwner = "no";
		if($u == $log_username && $user_ok == true){
			$isOwner = "yes";
		}
		// Fetch the user row from the query above
		while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
			$profile_id = $row["id"];
			$signup = $row["signup"];
			$lastlogin = $row["lastlogin"];
			$joindate = strftime("%b %d, %Y", strtotime($signup));
			$lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
		}

		if($u == $log_username && $user_ok == true)  // show edit profile link only if this is your profile
		{
			echo'<a href="/editprofile.php">Edit Profile</a>';
			echo'<br>';
			echo'<a href="/logout.php">Logout</a>';
			echo'<br>';
			echo'<a href="/createpost.php">Create Post</a> <br>';
			echo'<a href="/browse.php">Browse</a> <br><br><br>';
		}
		
		// showing image
		 $imgsql = "SELECT image, imagename FROM users WHERE username='$log_username'";
		 $imgquery = mysqli_query($db_conx, $imgsql);
		 $imgresult = mysqli_fetch_array($imgquery);
		 $encode = base64_encode( $imgresult['image'] );
		  echo '<img src="data:image/jpeg;base64,'.$encode.'" height="200" width="200" border="4"/>';
	?>
	</div>
</form>


<div id="pageMiddle">
<form name = "deletepost" method = "POST">
  <h1><?php echo $u; ?>'s Profile</h1>
  <p>Join Date: <?php echo $joindate; ?></p>
  <p>Last Session: <?php echo $lastsession; ?></p>

 <?php

 //showing your posts
 $swapsql = "SELECT DISTINCT `swap`.`title`, `swap`.`system`, `swap`.`price`, `swap`.`swapID`
			FROM `swap`,`users`
			WHERE `swap`.`userID`=(SELECT `users`.`id`
							FROM `users`
							WHERE `users`.`username`='$log_username')";
 $swapquery = mysqli_query($db_conx, $swapsql);
 $swapcount = mysqli_num_rows($swapquery);
 if ($swapcount > 0)
 {
		echo '<h3>My Swap Posts</h3>';
		//$linkaddress = "post.php?p=".$row["id"];
		echo '<table bgcolor="#919191" width= "100%" cellpadding="2" cellspacing="2" border="1"';
		echo '<thead>
		<tr>
		<th>#</th>
		<th>Title</th>
		<th>System</th>
		<th>Price</th>
		</tr>
		</thead>';
		while($row = mysqli_fetch_array($swapquery, MYSQLI_ASSOC)) {
		echo "<tr><td>"; ?>
		<input name="delswapcheckbox[]" type="checkbox" value="<?php echo $row['swapID'];?>"></td>
		<?php
		echo "</td><td>" . $row['title'] . "</td><td>" . $row['system'] . "</td><td>" .  $row['price'] . "</td></tr>";
		
		}
		echo '</table>';
		//echo $linkaddress."\n";

?>
		
	 <input name="deleteswap" type="submit" value="Delete">
	 
	 <?php
	 // delete from swap list
	 if(isset($_POST['deleteswap']))
	{
		$checkbox = $_POST['delswapcheckbox'];
		for($i=0;$i<count($checkbox);$i++)
		{
			$deleteID = $checkbox[$i];
			$deletesql = "DELETE FROM `posts` WHERE `id`= 
							(SELECT `postID` FROM `swap` WHERE `swapID` = '$deleteID')";
			$deleteresult = mysqli_query($db_conx, $deletesql);
			$deletesql = "DELETE FROM `swap` WHERE `swapID`='$deleteID'";
			$deleteresult = mysqli_query($db_conx, $deletesql);
		}

		if($deleteresult)
		{
			echo "Your swap selection has been deleted! Please refresh to see results.";
			header("Refresh:0");
		}
		
	}
}
else 
	echo '<br><h3>No Current Swap Posts</h3>Click the link at the top of the page to create a swap post!<br>';
 ?>
 <?php
		// showing your personal wish list
		$wishsql = "SELECT DISTINCT `wished`.`title`, `wished`.`system`, `wished`.`wishID`
				FROM `wished`,`users`
				WHERE `wished`.`userID`=(SELECT `users`.`id`
							FROM `users`
							WHERE `users`.`username`='$log_username')";
		$wishresult = mysqli_query($db_conx, $wishsql);
		$wishrowcount = mysqli_num_rows($wishresult);
if ($wishrowcount > 0)
{

		echo '<h3>My Wish Posts</h3>';
		//echo $row["title"] ." ".$row["id"];
		//$linkaddress = "post.php?p=".$row["id"];
		echo '<table bgcolor="#919191" width= "100%" cellpadding="2" cellspacing="2" border="1"';
		echo '<thead>
		<tr>
		<th>#</th>
		<th>Title</th>
		<th>System</th>
		</tr>
		</thead>';
		while($row2 = mysqli_fetch_array($wishresult, MYSQLI_ASSOC)) {
		echo "<tr><td>"; ?>
		<input name="delwishcheckbox[]" type="checkbox" value="<?php echo $row2['wishID'];?>"></td>
		<?php
			echo "</td><td>" . $row2['title'] . "</td><td>" . $row2['system'] .  "</td></tr>";
		}
		echo "</table>";
		//echo $linkaddress."\n";
		// displaying list in while loop

?>
		 <input name="deletewish" type="submit" value="Delete">
<?php
		
		// delete from swap list
	 if(isset($_POST['deletewish']))
	{
		$checkbox = $_POST['delwishcheckbox'];
		for($i=0;$i<count($checkbox);$i++)
		{
			$deleteID = $checkbox[$i];
			$deletesql = "DELETE FROM `posts` WHERE `id`= 
							(SELECT `postID` FROM `wished` WHERE `wishID` = '$deleteID')";
			$deleteresult = mysqli_query($db_conx, $deletesql);
			$deletesql = "DELETE FROM `wished` WHERE `wishID`='$deleteID'";
			$deleteresult = mysqli_query($db_conx, $deletesql);
		}
		if($deleteresult)
		{
			echo "Your wish selection has been deleted! Please refresh to see results.";
			header("Refresh:0");
		}
	}
}
	else
		echo '<br><h3>No Current Wish Posts</h3>Click the link at the top of the page to create a wish post!<br>';
?>
 
	</form>
	</div>

		<div id="footer">
			<a href="about.html">About</a>
			<a href="contact.html">Contact</a>
			<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
</body>
</html>