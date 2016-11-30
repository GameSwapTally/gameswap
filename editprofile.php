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
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Setting - GameSwapTally</title>
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
			<br><br>
			
		<?php
			// must account for change of username when making session header
			// not working yet!
		//if ($username == $_SESSION['username'])
			echo '<div style="text-align:right"><a href="/user.php?u='.$username.'">Return to Profile</a></div>';
		//else
			//echo '<a href="/user.php?u='.$newusername.'">Return to Profile</a>';
		?>

		<div id="pageMiddle">
			<form name="editprofile" method="POST" action = "editprofile.php" enctype="multipart/form-data">
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
						$_SESSION['username'] = $newusername;
						echo "<meta http-equiv=\"refresh\" content=\"0;URL=editprofile.php\">";
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
			
			<p><strong>Upload New Picture: </strong><input type="file" name="newpicture">
			<input type="submit" name="editpicture" value="Upload"></p>
			
			<?php
				$file = $_FILES['newpicture']['tmp_name'];
				if (isset($_POST['editpicture']))
				{
					if (!isset($file))
						echo "Please select an image.";
					else
					{
						$image = addslashes(file_get_contents($_FILES['newpicture']['tmp_name']));
						$image_name = addslashes($_FILES['newpicture']['name']);
						$image_size = getimagesize($_FILES['newpicture']['tmp_name']);
						
						if ($image_size==FALSE)
							echo "Error, the file is not an image.";
						else
						{
							$sql = "UPDATE users SET image='$image', imagename='$image_name' WHERE id='$id'";
							$query = mysqli_query($db_conx, $sql);
							if (!$query)
								echo "Error loading image.";
						}
					}
				}
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