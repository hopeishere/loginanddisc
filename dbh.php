<?php  
$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "loginsystem";

$conn = mysqli_connect($servername,$dbuser,$dbpass,$db);
if(!$conn){
	die("Connection Failed : ".mysqli_connect_error());
}
?>