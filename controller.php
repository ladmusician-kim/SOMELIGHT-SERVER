<?php
	$message = $_GET['message'];
	
	$registrationIDs = array();
	//request url
	$url    = 'https://android.googleapis.com/gcm/send';
	//your api key
	$apiKey = 'AIzaSyDUXcO65XPBJHNk9903mMGCHLNq_611Leg';
	
	$db_host = "54.64.157.215";
	$db_user = "root";
	$db_passwd = "rhznjfflxl1";
	$db_name = "GreenLight";
	
	// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
	$connect=mysql_connect($db_host, $db_user, $db_passwd) or
	die( "SQL server에 연결할 수 없습니다.");
	
	mysql_query("SET NAMES UTF8");
	// 데이터베이스 선택
	mysql_select_db($db_name, $connect);
	
	// 세션 시작
	session_start();
	
	// 쿼리문 생성
	$sql = "select reg_id from user";
	
	// 쿼리 실행 결과를 $result에 저장
	$result = mysql_query($sql, $connect);
	$row = mysql_result($result, 0, "phone");
	$total_record = mysql_num_rows($result);
	
	for ($i=0; $i < $total_record; $i++)
	{
		// 가져올 레코드로 위치(포인터) 이동
		mysql_data_seek($result, $i);
	
		$row = mysql_fetch_array($result);
		$registrationIDs[$i] = $row[reg_id];
	}
	
	//payload data
	$data   = array('tiker' => '알려드립니다.', 'title' => '썸라이트', 'msg' => $message, 'inServer' => 'yes');
	
	$fields = array('registration_ids' => $registrationIDs,
			'data' => $data);
	
	//http header
	$headers = array('Authorization: key=' . $apiKey,
			'Content-Type: application/json');
	
	//curl connection
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
	$result = curl_exec($ch);
	
	curl_close($ch);
	
	echo $result;
?>