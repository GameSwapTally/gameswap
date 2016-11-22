<?php
	// include necessary php files to get username from login session
  // initalize variables from user who is logged in

?>

<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="stylesheet" type="text/css" href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/general.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
</head>
<body>
<div id="pageMiddle">
<form name="game_search" method="POST">
  <h1>Edit Profile</h1>
  <h3><?php echo $u; ?></h3>
  <p><strong>Edit Username: </strong><input type="text" name="title" size="30"/>
  <input type="submit" name="edit_username" value="Submit"/></p>
  <br></br>
  <p><strong>Edit Password: </strong><input type="text" name="title" size="30"/></p>
   <p><strong>Confirm New Password: </strong><input type="text" name="title" size="30"/></p>
   <input type="submit" name="edit_password" value="Submit"/></p>
  <br></br>
  <p><strong>Upload New Picture: </strong><input type="file" name="pic" accept="image/*" class="picUpload">
	<input type="submit" name="edit_picture" value="Upload"></p>
 <?php
	// error check for username and matching passwords
	// when they pass error check, do ALTER queries to change database info
	// echo out some success messages when it works. or redirect to profile page
  ?>
</div>
</form>
</body>
</html>