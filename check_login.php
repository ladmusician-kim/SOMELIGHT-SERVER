<?php
$userId = $_GET['userId'];
$pass = $_GET['pass'];
$phone = $_GET['phone'];

$db_host = "localhost";
$db_user = "goqualweb";
$db_passwd = "goqual12!@";
$db_name = "goqualweb";

$connect=mysql_connect($db_host, $db_user, $db_passwd) or
die( "SQL server에 연결할 수 없습니다.");

mysql_query("SET NAMES UTF8");
// 데이터베이스 선택
$db = mysql_select_db($db_name, $connect);
if(!$db){
	die('Database selection failed'.mysql_error());
}

// 세션 시작
session_start();

// 쿼리문 생성
$select_sql = "select my_id from somelight where phonenum like '$phone'";
$select_result = mysql_query($select_sql, $connect);
$row = mysql_fetch_array($select_result);
if($row) {
	if($userId == $row[my_id]) {
		$select_sql = "select password from somelight where phonenum like '$phone'";
		$select_result = mysql_query($select_sql, $connect);
		$row = mysql_fetch_array($select_result);
		if($pass == $row[password]) {
			echo "true";
		} else {
			echo "false";
		}
	} else {
		echo "false";
	}
} else {
	echo "false";
}
mysql_close($con);
?>