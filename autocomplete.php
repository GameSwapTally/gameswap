<?php
$host="localhost";
$username="root";
$password="meat";
$databasename="gameswaptally";

$connect=mysql_connect($host, $username, $password);
$db=mysql_select_db($databasename);

$searchTerm = $_GET['term'];

$select =mysql_query("SELECT title FROM games WHERE name LIKE '%".$searchTerm."%'");
while ($row=mysql_fetch_array($select))
{
	$data[] = $row['name'];
}
//return json data
echo json_encode($data);

?>