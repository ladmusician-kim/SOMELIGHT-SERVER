<?php  //상대방이 저장한 파트너 전화번호
$partner_phone = $_GET['partner_phone'];

$db_host = "go-qual.co.kr";
$db_user = "root";
$db_passwd = "rhznjfflxl1";
$db_name = "SomeLight";

/* $connect = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);
if(mysqli_connect_errno($connect)) {
	echo "not connect SQL Server : ".mysqli_connect_error();
} */
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
$connect=mysql_connect($db_host, $db_user, $db_passwd) or
die("not connect SQL server");

mysql_query("SET NAMES UTF8");
// 데이터베이스 선택
mysql_select_db($db_name, $connect);

// 세션 시작
session_start();

// 쿼리문 생성
$sql = "select partner_phone from user where phone like '$partner_phone'";

// 쿼리 실행 결과를 $result에 저장
$result = mysql_query($sql, $connect);
$row = mysql_result($result, 0, "partner_phone");
$total_record = mysql_num_rows($result);

// JSONArray 형식으로 만들기 위해서...
echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
// 반환된 각 레코드별로 JSONArray 형식으로 만들기.
for ($i=0; $i < $total_record; $i++)
{
	// 가져올 레코드로 위치(포인터) 이동
	mysql_data_seek($result, $i);

	$row = mysql_fetch_array($result);
	echo "{\"partnerPhone\":\"$row[partner_phone]\"}";

	// 마지막 레코드 이전엔 ,를 붙인다. 그래야 데이터 구분이 되니깐.
	if($i<$total_record-1){
		echo ",";
	}
}
// JSONArray의 마지막 닫기
echo "]}";
?>
