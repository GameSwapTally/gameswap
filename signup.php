<?php
//phpinfo();
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("php_includes/db_conx.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }
}
?>
<?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = $_POST['p'];
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {
	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
		// Hash the password and apply your own mysterious unique salt
		//$cryptpass = crypt($p);
		//include_once ("php_includes/randStrGen.php");
		//$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
		// Add user info into the database table for the main site table
		$sql = "INSERT INTO users (username, email, password, ip, signup, lastlogin)       
		        VALUES('$u','$e','$p','$ip',now(),now())";
		$query = mysqli_query($db_conx, $sql); 
		$uid = mysqli_insert_id($db_conx);
		// Establish their row in the useroptions table
		// $sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		// $query = mysqli_query($db_conx, $sql);
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		// if (!file_exists("user/$u")) {
		// 	mkdir("user/$u", 0755);
		// }
		// Email the user their activation link
		$to = "$e";							 
		$from = "gameswaptally@gmail.com";
		$subject = 'GameSwapTally Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>GameSwapTally Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://gameswaptally.github.io"><img src="68.59.125.59/logo.png" width="36" height="30" alt="GameSwapTally" style="border:none; float:left;"></a>GameSwapTally Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://68.59.125.59/activation.php?id='.$uid.'&u='.$u.'&e='.$e.'&p='.$p.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
		$headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);
		echo "signup_success";
		exit();
	}
	exit();
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Register | GameSwapTally</title>
		<meta name="description" content="Florida State University Software Engineering (CEN4020) 
			Fall 2016 group project with Dr.Nistor."> 
		<meta name="keywords" content="FSU, Florida State University, Software Engineering, CEN4020, 
			Games, Video Games">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="icon" type="image/png" href="asset/baby.png">
	<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else if( _("terms").style.display == "none"){
		status.innerHTML = "Please view the terms of use";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+", check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1);
	}
}
function openTerms(){
	_("terms").style.display = "block";
	emptyElement("status");
}
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
	</head>
	
	<body>
		<div class="wrapper">
			<div class="Header">
				<div id="left0">
					<a href="index.html"><img src="logo.png" alt="GameSwapTally"></img></a>
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

			<form name="signupform" id="signupform" onsubmit="return false;">
		    <div>Username: </div>
		    <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
		    <span id="unamestatus"></span>
		    <div>Email Address:</div>
		    <input id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88">
		    <div>Create Password:</div>
		    <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16">
		    <div>Confirm Password:</div>
		    <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16">
		    <div>
		      <a href="#" onclick="return false" onmousedown="openTerms()">
		        View the Terms Of Use
		      </a>
		    </div>
		    <div id="terms" style="display:none;">
		      <h3>Game Swap Tally Terms Of Use</h3>
		      <p>Insert Terms here</p>
		    </div>
		    <br /><br />
		    <button id="signupbtn" onclick="signup()">Create Account</button>
		    <span id="status"></span>
		  </form>
			
			<!-- <form name="signup" method="POST">
				<h1>Create your account</h1>
				<p>
					<input type="text" name="username" placeholder="Username*"/>
				</p>
				<p>
					<input type="email" name="email" id="email" placeholder="E-mail*"/>
				</p>
				<p>
					<input type="password" name="password" id="password" placeholder="Password*"/>
				</p>
				<p>
					<input type="password" name="repeatpassword" id="repeatPassword" placeholder="Repeat password*"/>
				</p>
				
				<input type="submit" name="submit" value="Create Account"><br><br>					
			</form> -->
				<?php
				
					// $servername = "localhost";
					// $username = "root";
					// $password = "";
					// $connection = mysql_connect($servername, $username, $password);

					// if (!$connection) 
					// 	die("Connection failed: " . $connection->connect_error);

					// mysql_select_db('gameswaptally_test', $connection);
					// if(isset($_POST["submit"]))																			// when user clicks submit button
					// {
					// 	if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])			// error if at least one field is not filled
					// 	|| empty($_POST["repeatpassword"]))
					// 		echo "Error: not all fields are filled. Try again!";
						
					// 	else 
					// 	{	
					// 		if (($_POST["repeatpassword"]) != ($_POST["password"]))											// check if repeat and initial password match
					// 			echo "Error: Both passwords do not match. Try again!";						
					// 		else	
					// 		{	// need to check if username already exists
					// 				$sql = "INSERT INTO `users` (`userName`, `email`, `password`, `location`) 									
					// 				VALUES ('$_POST[username]','$_POST[email]','$_POST[password]', ' ')";		// if passwords match and fields not empty, add to database
								
					// 				if(!mysql_query($sql,$connection))
					// 					die('Error: ' . mysql_error());
					// 				if($sql)
					// 				{
					// 					echo "Success! Welcome to the GameSwapTally Community, fellow gamer!";
					// 						$message = "Welcome to our community of Tallahassee gamers, " . "$_POST[username]";
					// 						$message .= "! We can't wait for you to start browsing our catalog of games and enjoying our features. Game on, and start swapping!";
					// 						$email = $_POST['email'];
					// 						$subject = "Welcome, gamer!";
					// 						$headers = "MIME-Version: 1.0" . "\r\n";
					// 						$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
					// 						mail($email, $subject, $message, $headers);
					// 				}
					// 		}
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
