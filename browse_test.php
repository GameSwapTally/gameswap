<?php
class test_search

{
	public $title, $system, $year, $publisher;
	
	public function connectHost()
	{
		$servername = "localhost";			// connect to localhost for now
		$srvname = "root";
		$password = "";
		$connection = mysql_connect($servername, $srvname, $password);
		mysql_select_db('gameswaptally_test', $connection);
	}
	public function __construct1($title)
	{
		$this->title = $title;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function __construct2($system)
	{
		$this->system = $system;
	}
	public function getsystem()
	{
		return $this->system;
	}
	public function __construct3($year)
	{
		$this->year = $year;
	}
	public function getYear($year)
	{
		return $year->year;
	}
	public function __construct4($publisher)
	{
		$this->publisher = $publisher;
	}
	public function getPublisher($publisher)
	{
		return $publisher->publisher;
	}
}

?>