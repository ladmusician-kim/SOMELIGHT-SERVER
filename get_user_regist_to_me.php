<?php  //나를 들록한 사람들
$phone = $_GET['phone'];

$db_host = "218.54.31.146";
$db_user = "root";
$db_passwd = "rhznjfflxl1";
$db_name = "SomeLight";

// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
$connect=mysql_connect($db_host, $db_user, $db_passwd) or
die( "SQL server에 연결할 수 없습니다.");

mysql_query("SET NAMES UTF8");
// 데이터베이스 선택
mysql_select_db($db_name, $connect);

// 세션 시작
session_start();

// 쿼리문 생성
$sql = "select phone from user where partner_phone like '$phone'";

// 쿼리 실행 결과를 $result에 저장
$result = mysql_query($sql, $connect);
$row = mysql_result($result, 0, "phone");
$total_record = mysql_num_rows($result);

// JSONArray 형식으로 만들기 위해서...
echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
// 반환된 각 레코드별로 JSONArray 형식으로 만들기.
for ($i=0; $i < $total_record; $i++)
{
	// 가져올 레코드로 위치(포인터) 이동
	mysql_data_seek($result, $i);

	$row = mysql_fetch_array($result);
	echo "{\"phone\":\"$row[phone]\"}";

	// 마지막 레코드 이전엔 ,를 붙인다. 그래야 데이터 구분이 되니깐.
	if($i<$total_record-1){
		echo ",";
	}
}
// JSONArray의 마지막 닫기
echo "]}";
?>
