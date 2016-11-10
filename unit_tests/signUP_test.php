<?php
class test_newuser

{
	public $username, $email, $password, $repeatpassword;
	
	public function connectHost()
	{
		$servername = "localhost";			// connect to localhost for now
		$srvusername = "root";
		$password = "";
		$connection = mysql_connect($servername, $srvusername, $password);
		mysql_select_db('gameswaptally_test', $connection);
	}
	public function __construct1($username)
	{
		$this->username = $username;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function __construct2($email)
	{
		$this->email = $email;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function __construct3($password)
	{
		$this->password = $password;
	}
	public function getPassword($password)
	{
		return $password->password;
	}
	public function __construct4($repeatpassword)
	{
		$this->repeatpassword = $repeatpassword;
	}
	public function getRepeatpassword($repeatpassword)
	{
		return $repeatpassword->repeatpassword;
	}
}

?>