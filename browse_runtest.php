<?php

require_once ('browse_test.php');

class test_browse extends PHPUnit_Framework_TestCase
{
	/** @test */
	public $test;
	public function setUp()
	{
		$this->test = new test_browse ("A test game", "playstation", "1999", "test publisher");
		$this->test = new test_browse ("B test game", "nintendo", "1997", "test publisher 2");
		connectHost();
	}
	public function checkOptionalSearchFields()
	{
		$title = $this->test->getTitle();
		$sql= "SELECT * FROM games WHERE 1=1";
				if(!empty($title))
					$sql .= " AND title LIKE '$title'";

				if(!empty($system))
					$sql .= " AND system LIKE '$system'";
				
				if(!empty($year))
					$sql .= " AND year LIKE '$year'";
				
				if(!empty($publisher))
					$sql .= " AND publisher LIKE '$publisher'";
			
				$sql .= ";";
				$result = mysql_query($sql);
				// if row exists with test game in it, then return true
				// same logic works with other attributes
				$this->assertTrue(mysql_fetch_row($result))	
	}
	public function checkSort()
	{
		$query = "SELECT * FROM games ORDER BY title ASC"; // defaults to ascending title sort
		$result = mysql_query($query);
			
			// using booleans to simulate if a radio button is checked or not
			// checked if sort worked for each by one variable to true and rest false
			$sort_title_desc = true;
			$sort_system_asc = false;
			$sort_system_desc = false;
			$sort_year_asc = false;
			$sort_year_desc = false;
			$sort_publisher_asc = false;
			$sort_publisher_desc = false;
			
			if ($sort_title_desc == true)
			{
				$query = "SELECT * FROM games ORDER BY title DESC";
				$result = mysql_query($query);

			}
			else if ($sort_system_asc == true)
			{
				$query = "SELECT * FROM games ORDER BY system ASC";
					$result = mysql_query($query);
			}
			else if ($sort_system_desc == true)
			{
				$query = "SELECT * FROM games ORDER BY system DESC";
					$result = mysql_query($query);
				
			}
			else if ($sort_year_asc == true)
			{
				$query = "SELECT * FROM games ORDER BY year ASC";
				
					$result = mysql_query($query);
				
			}
			else if ($sort_year_desc == true)
			{
				$query = "SELECT * FROM games ORDER BY year DESC";
				
					$result = mysql_query($query);
				
			}
			else if ($sort_publisher_asc == true)
			{
				$query = "SELECT * FROM games ORDER BY publisher ASC";
				
					$result = mysql_query($query);
			}
			else if ($sort_publisher_desc == true)
			{
				$query = "SELECT * FROM games ORDER BY publisher DESC";
					$result = mysql_query($query);
			}
				// return true if "A test game" is first row
				$testquery = "SELECT * FROM games WHERE title = 'A test game';"
				$testresult = mysql_query($testquery);
				$getfirstrow = mysql_fetch_row($result);
				$firstrow = $getfirstrow[0];
				assertTrue($firstrow == $testresult);
			
					
	}
}

?>