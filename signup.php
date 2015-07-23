<?php 
$userId = $_GET['userId'];
$pass = $_GET['pass'];
$phone = $_GET['phone'];

$db_host = "localhost";
$db_user = "goqualweb";
$db_passwd = "goqual12!@";
$db_name = "goqualweb";

$con = mysql_connect($db_host, $db_user, $db_passwd);
if(!$con){
	die('MySQL connection failed'.mysql_error());
}

$db = mysql_select_db($db_name,$con);
if(!$db){
	die('Database selection failed'.mysql_error());
}
$select_sql = "SELECT my_id from somelight where phonenum like '$phone'";
$select_result = mysql_query($select_sql, $con);
$row = mysql_fetch_array($select_result);
if($row[my_id] != "none!") {
	/*$sql = "UPDATE somelight set reg_id='$regId' where phonenum like '$phone'";
	if(!mysql_query($sql, $con)){
		die('MySQL query failed'.mysql_error());
	}*/
	echo $row[my_id];
} else {
	$sql = "UPDATE somelight set my_id='$userId', password='$pass' where phonenum like '$phone'";
	if(!mysql_query($sql, $con)){
		die('MySQL query failed'.mysql_error());
	}
	echo "Signup_Id_Success";
}

mysql_close($con);
?> 