
<?php
	$host	 = "localhost";
	$user	 = "root";
	$pass	 = "pietersenEital123";
	$dabname = "smsd";
	
	$conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	mysql_select_db($dabname, $conn) or die('Could not select database.');
	$baseurl="http://localhost/test/";
?>