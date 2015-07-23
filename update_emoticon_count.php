<?php 
$phone = $_GET['phone'];

$con = mysql_connect("218.54.31.146","root","rhznjfflxl1");
if(!$con){
	die('MySQL connection failed'.mysql_error());
}

$db = mysql_select_db("SomeLight",$con);
if(!$db){
	die('Database selection failed'.mysql_error());
}
$select_sql = "SELECT emoticon_count from user where phone like '$phone'";
$select_result = mysql_query($select_sql, $con);
$row = mysql_result($select_result, 0, "emoticon_count");
$row = $row + 1;
$sql = "UPDATE user set emoticon_count='$row' where phone like '$phone'";
mysql_query($sql, $con);
mysql_close($con);
?>