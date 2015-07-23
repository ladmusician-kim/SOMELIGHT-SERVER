<?php 
$regId = $_GET['regId'];
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
$select_sql = "SELECT reg_id from somelight where phonenum like '$phone'";
$select_result = mysql_query($select_sql, $con);
$row = mysql_result($select_result, 0, "reg_id");
if($row) {
	$sql = "UPDATE somelight set reg_id='$regId' where phonenum like '$phone'";
	if(!mysql_query($sql, $con)){
		die('MySQL query failed'.mysql_error());
	}
} else {
	$sql = "INSERT INTO somelight (my_id, password, reg_id, phonenum) values ('none!', '0000', '$regId', '$phone')";
	if(!mysql_query($sql, $con)){
		die('MySQL query failed'.mysql_error());
	}
}

mysql_close($con);
?> 