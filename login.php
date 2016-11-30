<?php
include_once("php_includes/check_login_status.php");
if($user_ok == true){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["e"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = $_POST['p'];
	
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, password FROM users WHERE email='$e' AND activated='1' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];
		if($p != $db_pass_str){
			echo "login_failed";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
            $query = mysqli_query($db_conx, $sql);
			echo $db_username;
		    exit();
		}
	}
	exit();
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Log in - GameSwapTally</title>
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/favicon.png">
		<script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
		<script>
		function emptyElement(x){
			_(x).innerHTML = "";
		}
		function login(){
			var e = _("email").value;
			var p = _("password").value;
			if(e == "" || p == ""){
				_("status").innerHTML = "Fill out all of the form data";
			} else {
				_("loginbtn").style.display = "none";
				_("status").innerHTML = 'please wait ...';
				var ajax = ajaxObj("POST", "login.php");
		        ajax.onreadystatechange = function() {
			        if(ajaxReturn(ajax) == true) {
			            if(ajax.responseText == "login_failed"){
							_("status").innerHTML = "Login unsuccessful, please try again.";
							_("loginbtn").style.display = "block";
						} else {
							window.location = "user.php?u="+ajax.responseText;
						}
			        }
		        }
		        ajax.send("e="+e+"&p="+p);
			}
		}
		</script>
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
					<a href="login.php" class="logIn">Log In</a>
					<a href="signup.php">Sign Up</a>
				</div>
			</div> <!-- end Header -->
			<br>

			<form id="loginform" onsubmit="return false;">
		    <div>Email Address:</div>
		    <input type="text" id="email" onfocus="emptyElement('status')" maxlength="88">
		    <div>Password:</div>
		    <input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
			<br>
			<a href="forgot_password.php">Forgot Your Password?</a>
		    <br /><br />
		    <button id="loginbtn" onclick="login()">Log In</button> 
		    <p id="status"></p>
		  </form>
			
			<!-- <form action="" method="post">
				<h1>Log in</h1>
				<p>
					<input type="email" name="email" id="email" placeholder="E-mail..."/>
				</p>
				<p>
					<input type="password" name="password" id="password" placeholder="Password..."/>
				</p>
				<input type="submit" name="submit" value="Log In"><br><br>
				<a href="passwordReset.html">Forgot Password?</a><br>
				<a href="signUp.php">Sign Up</a><br>
			</form> -->
			<?php
				// if (isset($_POST["submit"]))
				// {
				// 	if (empty($_POST["email"]) || empty($_POST["password"]))
				// 		echo "Error: not all fields are field. Try again!";
				// 	else
				// 	{
				// 		$servername = "localhost";
    //                                             $username = "root";
    //                                             $pass = "";
                                                
    //                                             $email = $_POST['email'];
				// 		$password = $_POST['password'];
                                                 
    //                                             $connection = mysql_connect($servername, $username, $pass);
    //                                             mysql_select_db('gameswaptally_test', $connection); 

				// 		$sql = "SELECT * FROM users WHERE email = '".$email."'
				// 		AND password = '".$password."'";
    //                                             //$connection = mysql_connect($servername, $username, $pass);
				// 		if(!mysql_query($sql,$connection))
				// 			die('Error: ' . mysql_error());
                                                    
    //                                            //mysql_select_db('gameswaptally_test', $connection); 

				// 		if ($sql)
				// 		{
				// 			// login , cookies and shit. Then redirect to the index page

    //                                                     $_SESSION['email'] = $email;
    //                                                     $_SESSION['password'] = $password;

    //                                                     setcookie("email", $email, strtotime( '+30 days' ), "/", "", "", TRUE);
    //                                                     setcookie("password", $password, strtotime( '+30 days' ), "/", "", "", TRUE);

				// 			echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.html\">";
				// 		}
				// 		else
				// 			echo "Error: invalid credentials. Try again!";
				// 	}
			
				// }
			?>
			
			<div id="browseFooter">
				<a href="about.html">About</a>
				<a href="contact.html">Contact</a>
				<a href="terms.html">Terms</a>
			</div>
		</div> <!-- end wrapper -->
	</body>
</html>
