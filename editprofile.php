<?php
	// include necessary php files to get username from login session
	include_once("php_includes/check_login_status.php");
	/*if($user_ok == true){
		header("location: editprofile.php?u=".$_SESSION["username"]);
		exit();
		}*/
		// need header to include "?u=username"

	$id = $_SESSION['userid'];
	$password = $_SESSION['password'];
	$username = $_SESSION['username'];
?>

<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/general.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
</head>
<body>
<?php
	// must account for change of username when making session header
if ($username == $_SESSION['username'])
	echo '<a href="/user.php?u='.$username.'">Return to Profile</a>';
else
	echo '<a href="/user.php?u='.$newusername.'">Return to Profile</a>';
?>

<div id="pageMiddle">
<form name="editprofile" method="POST">
  <h1>Edit Profile</h1>
  <p><strong>Edit Username: </strong><input type="text" name="newusername" size="30"/>
  <input type="submit" name="editusername" value="Submit"/></p>

  <?php
	// error check username

    if (!empty($_POST['newusername']) && isset($_POST['editusername']))
	{
		$newusername = $_POST['newusername'];
		$sql = "UPDATE users SET username='$newusername' WHERE id='$id'";
		$query = mysqli_query($db_conx, $sql);
		if ($query)
		{
			echo 'Success! Your username is now changed to '.$newusername.'!';
			$username = $newusername;
		}
	}
  
  ?>
    <br></br>
  <p><strong>Edit Password: </strong><input type="password" name="newpassword" size="30"/></p>
   <p><strong>Confirm New Password: </strong><input type="password" name="confirmnewpassword" size="30"/></p>
   <input type="submit" name="editpassword" value="Submit"/></p>

  <?php
	
	if (!empty($_POST['newpassword']) && !empty($_POST['confirmnewpassword']) 
			&& isset($_POST['editpassword']))
	{
		$newpassword = $_POST['newpassword'];
		$confirm = $_POST['confirmnewpassword'];
		if ($confirm == $newpassword)
		{
			$newpassword = $_POST['newpassword'];
			$sql = "UPDATE users SET password='$newpassword' WHERE id='$id'";
			$query = mysqli_query($db_conx, $sql);
			if ($query)
				echo 'Success! Your password is changed!';
		}
		else
			echo 'The two passwords do not match. Try again!';
	}
  
  ?>
    <br></br>
  <p><strong>Edit Email: </strong><input type="email" name="newemail" size="30"/></p>
   <input type="submit" name="editemail" value="Submit"/></p>

  <?php
  
	if (!empty($_POST['newemail']) && isset($_POST['editemail']))
	{
		$newemail = $_POST['newemail'];
		$newusername = $_POST['newpassword'];
		$sql = "UPDATE users SET email='$newemail' WHERE id='$id'";
		$query = mysqli_query($db_conx, $sql);
		if ($query)
			echo 'Success! Your email has been changed to '.$newemail.'!';
	}
  
  ?>
    <br></br>
  <p><strong>Upload New Picture: </strong><input type="file" name="newpicture" accept="image/*" class="picUpload">
	<input type="submit" name="editpicture" value="Upload"></p>
 <?php
	
 
 ?>
</div>
</form>
</body>
</html>