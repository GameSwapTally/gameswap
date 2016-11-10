<?php

require_once ('signUP_test.php');

class test_signup extends PHPUnit_Framework_TestCase
{
	/** @test */
	public $test;
	public function setUp()
	{
		$this->test = new test_newuser ("testuser", "test@test.com", "testpassword", "testpassword");
	}
	public function checkFields()
	{
		$username = $this->test->getUsername();
		$email = $this->test->getEmail();
		$password = $this->test->getPassword();
		$repeatpassword = $this->test->getRepeatpassword();
		$this->assertTrue(!empty($username) && !empty($email) && !empty($password)
			&& !empty($repeatpassword));
	}
	public function checkPasswords()
	{
		$repeatpassword = $this->test->getRepeatpassword();
		$password = $this->test->getPassword();
		$this->assertTrue($repeatpassword == $password);
	}
	public function checkUserCreated()
	{
		$servername = "localhost";			// connect to localhost for now
		$srvusername = "root";
		$srvpassword = "";
		$connection = mysql_connect($servername, $srvusername, $srvpassword);
		mysql_select_db('gameswaptally_test', $connection);
		$username = $this->test->getUsername();
		$email = $this->test->getEmail();
		$password = $this->test->getPassword();
		$sql_insert = "INSERT INTO `users` (`userName`, `email`, `password`, `location`) 									
					VALUES ('$username','$email','$password', ' ')";
		$sql_select = "SELECT * FROM `users` WHERE userName=$username";
		$this->assertTrue(mysql_num_rows($sql_select)==1);
	}
	
	
}

?>