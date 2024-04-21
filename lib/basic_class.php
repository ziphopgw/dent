<?
class dbConnect {
	var $db_host, $db_name, $db_user, $db_pwd, $db_conn;

	function dbConnect ( $db_host, $db_name, $db_user, $db_pwd) {
		$this->db_host		= $db_host;
		$this->db_name		= $db_name;
		$this->db_user		= $db_user;
		$this->db_pwd		= $db_pwd;

		$this->db_conn = mysql_connect('localhost', 'dentsu01', 'dentsu001!') or die("데이타 베이스에 접속이 불가능합니다.");
		mysql_select_db('dentsu01', $this->db_conn);
	}
	
	function dbout(){
		mysql_close($this->db_conn);
	}

	// 에러처리
	function error_handling( $sql )
	{
		echo $sql;
		//include_once(DOCUMENT_ROOT.'/common/error_sql.php');
	}

	function result ( $sql ) {
		$sql				= trim( $sql );
//		$result			= @mysql_query( $sql, $this->db_conn ) or die( $sql );
		$result			= @mysql_query( $sql, $this->db_conn ) or die( $this->error_handling($sql) );
		return $result;
	}

	function select ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		return $result;
	}

	function object ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_object($result);
		return $row;
	}

	function row ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_row($result);
		return $row;
	}

	function sum ( $table, $where, $field = "*" ) {
		$sql				= "Select sum($field) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function cnt ( $table, $where) {
		$sql				= "Select count(idx) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function insert ( $table, $data ) {
		$sql				= "insert into $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function update ( $table, $data ) {
		$sql				= "update $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}
	
	function delete ( $table, $data ) {
		$sql				= "delete from $table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}
	
	function dropTable ( $data ) {
		$sql				= "drop table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function createTable ( $data ) {
		$sql				= "create table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function stripSlash ( $str ) {
		$str				= trim( $str );
		$str				= stripslashes( $str );
		return $str;
	}

	function addSlash ( $str ) {
		$str				= trim( $str );
		$str				= addslashes( $str );
		if(empty( $str )) {
			$str			= "NULL";
		}
		return $str;
	}
	
	//*****************************************************************************************************************
	//	여기서부터 개발자 소스 부분

	function fetch_array_assoc ( $table, $where, $field = "*" ) 
	{
		$sql = "Select $field from $table $where";
		$result = $this->result( $sql );
		$i = 0;
		$retunnVal = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$retunnVal[$i] = $row;
			$i++;
		}
		return $retunnVal;
	}
	// 배열 결과 반환 함수
	function fetch_array_assoc_01 ( $sql ) 
	{
		$result = $this->result( $sql );
		$i = 0;
		$retunnVal = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$retunnVal[$i] = $row;
			$i++;
		}
		return $retunnVal;
	}
	// 배열 결과 반환 함수
	function fetch_array_object_01 ( $sql ) 
	{
		$result = $this->result( $sql );
		$i = 0;
		$retunnVal = array();
		while($row = mysql_fetch_object($result)) {
			$retunnVal[$i] = $row;
			$i++;
		}
		return $retunnVal;
	}
	// 단일 배열 결과 반환 함수
	function fetch_array_assoc_02 ( $sql ) 
	{
		$result = $this->result( $sql );
		$i = 0;
		$retunnVal = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$retunnVal[$i] = $row;
			$i++;
		}
		return $retunnVal[0];
	}
	// 단일 결과 반환 함수
	function fetch_row ( $sql ) 
	{
		$result = $this->result( $sql );
		$row = mysql_fetch_row($result); 
		return $row[0];
	}
	// 단일 결과 반환 함수
	function fetch_object ( $sql ) 
	{
		$result = $this->result( $sql );
		$row = mysql_fetch_object($result); 
		return $row;
	}
	// DML문 실행 함수
	function excute ($sql)
	{
		$sql				= trim( $sql );

		$result			= @mysql_query( $sql, $this->db_conn ) or die( $this->error_handling($sql) );
		return $result;
	}
	// 마지막 primary key 값 가져오기
	function last_insert_id()
	{
		$query = "SELECT LAST_INSERT_ID()";
		return $this->fetch_row($query);
	}
	// part_idx에따른 분류명 리턴
	function getGubun($part_idx)
	{
		if($part_idx==5||$part_idx==6||$part_idx==7||$part_idx==8||$part_idx==80||$part_idx==81)
			echo "서버호스팅";
		else if($part_idx==11||$part_idx==12||$part_idx==58||$part_idx==13||$part_idx==60||$part_idx==14||$part_idx==61)
			echo "웹호스팅";
		else if($part_idx==63||$part_idx==64||$part_idx==65||$part_idx==66||$part_idx==67)
			echo "보안SSL인증서";
	}
	// part_idx에따른 분류명 리턴2
	function getGubun2($part_idx)
	{
		if($part_idx==5||$part_idx==6||$part_idx==7||$part_idx==8||$part_idx==80||$part_idx==81||$part_idx==83)
			echo "server";
		else if($part_idx==11||$part_idx==12||$part_idx==58||$part_idx==13||$part_idx==60||$part_idx==14||$part_idx==61||$part_idx==84)
			echo "web";
		else if($part_idx==63||$part_idx==64||$part_idx==65||$part_idx==66||$part_idx==67)
			echo "ssl";
	}
	function getGubun2_return($part_idx)
	{
		if($part_idx==5||$part_idx==6||$part_idx==7||$part_idx==8||$part_idx==80||$part_idx==81||$part_idx==83)
			return "server";
		else if($part_idx==11||$part_idx==12||$part_idx==58||$part_idx==13||$part_idx==60||$part_idx==14||$part_idx==61||$part_idx==84)
			return "web";
		else if($part_idx==63||$part_idx==64||$part_idx==65||$part_idx==66||$part_idx==67)
			return "ssl";
	}
	// string에 따른 분류
	function getGubun3($gubun)
	{
		if($gubun=="web") echo "웹호스팅";
		else if($gubun=="server") echo "서버호스팅";
		else if($gubun=="domain") echo "도메인";
		else if($gubun=="ssl") echo "SSL";
		else if($gubun=="option") echo "부가서비스";
		else if($gubun=="web") echo "웹호스팅";
		else if($gubun=="customize") echo "웹호스팅";
	}
	function dbinfo()
	{
		$return = array(
			"DB_HOST" => $this->db_host
			, "DB_NAME" => $this->db_name
			, "DB_USER" => $this->db_user
			, "DB_PWD" => $this->db_pwd
		);
		return $return;
	}
}

class tools {

	// 엔코드
	function encode($data) {
		return base64_encode($data)."||";
	}
	function check_bytes($num)
	{
		$btail	= "bytes";
		$ktail	= "K";
		if($num>=1024&&$num<1048576)
		{
			$this_num = $num/1024;
			$namuji   = $num%1024;
		}
		else if($num>=1024&&$num>=1048576)
		{
			$this_num = $num/1048576;
			$namuji   = $num%1048576;
			if($namuji>=1024)
			{
				$namuji = $namuji/1024;
				$btail  = "K";
			}
			$ktail="M";
		}
		else $this_num=$num;
		echo $this->Nformat($this_num,0)."&nbsp;".$ktail."&nbsp;&nbsp;";
		if($namuji>0) echo $this->Nformat($namuji,0)." ".$btail;
	}
	function Nformat($value,$sort)
	{
		echo number_format($value,$sort);
		return;
	}
	// 디코드
	function decode($data){
		$vars=explode("&",base64_decode(str_replace("||","",$data)));
		$vars_num=count($vars);
		for($i=0;$i<$vars_num;$i++) {
			$elements=explode("=",$vars[$i]);
			$var[$elements[0]]=$elements[1];
		}
		return $var;
	}
	
	// 문자열 자르는 부분
	function strCut($str, $len) {
		if ($len >= strlen($str)) return $str;
		$klen = $len - 1;
		while(ord($str[$klen]) & 0x80) $klen--;
		return substr($str, 0, $len - (($len + $klen + 1) % 2)) ."..";
	}
	
	// HTML 출력
	function strHtml($str) {
		$str = trim($str);
		$str = stripslashes($str);
		return $str;
	}

	// 문자열 HTML BR 형태 출력
	function strHtmlBr($str) {
		$str = trim($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}

	// 문자열 TEXT 형태 출력
	function strHtmlNo($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}
	
	// 문자열 TEXT 형태 출력
	function strHtmlNoBr($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		return $str;
	}

	// 날자출력 형태 
	function strDateCut($str, $chk = 1) {
		if( $chk==1 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."/".$mon."/".$day;
		} else if( $chk==2 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."/".$mon."/".$day." ".$time.":".$minu;
		} else if( $chk==3 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."-".$mon."-".$day;
		} else if( $chk==4 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."-".$mon."-".$day." ".$time.":".$minu;
		} else if( $chk==5 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."년 ".$mon."월 ".$day."일";
		} else if( $chk==6) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."년 ".$mon."월 ".$day."일 ".$time."시 ".$minu."분";
		}
		return $str;
	}
	
	// 숫자로 된 값을 요일로 변환한다. (0:월요일, 1:화요일, 6:일요일)
	function strDateWeek($chk) {
		if( $chk==0 ) {
			$str="월요일";
		} else if( $chk==1 ) {
			$str="화요일";
		} else if( $chk==2 ) {
			$str="수요일";
		} else if( $chk==3 ) {
			$str="목요일";
		} else if( $chk==4 ) {
			$str="금요일";
		} else if( $chk==5 ) {
			$str="토요일";
		} else if( $chk==6) {
			$str="일요일";
		}
		return $str;
	}
	
	# E-MAIL 주소가 정확한 것인지 검사하는 함수
	#
	# eregi - 정규 표현식을 이용한 검사 (대소문자 무시)
	#         http://www.php.net/manual/function.eregi.php
	# gethostbynamel - 호스트 이름으로 ip 를 얻어옴
	#          http://www.php.net/manual/function.gethostbynamel.php
	# checkdnsrr - 인터넷 호스트 네임이나 IP 어드레스에 대응되는 DNS 레코드를 체크함
	#          http://www.php.net/manual/function.checkdnsrr.php
	function chkMail($email,$hchk=0) {
		$url = trim($email);
		if($hchk) {
			$host = explode("@",$url);
			if(eregi("^[\xA1-\xFEa-z0-9._-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) {
				if(checkdnsrr($host[1],"MX") || gethostbynamel($host[1])) return $url;  else return false;
			}
		} else {
			if(eregi("^[\xA1-\xFEa-z0-9._-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) return $url;  else return false;
		}
	}
	// 주민등록번호진위여부 확인 함수
	function chkJumin($resno1,$resno2) { 
		$resno = $resno1.$resno2;
		$len = strlen($resno); 
		if ($len <> 13) return false;
		if (!ereg('^[[:digit:]]{6}[1-4][[:digit:]]{6}$', $resno)) return false; 
		$birthYear = ('2' >= $resno[6]) ? '19' : '20'; 
		$birthYear += substr($resno, 0, 2); 
		$birthMonth = substr($resno, 2, 2); 
		$birthDate = substr($resno, 4, 2); 
		if (!checkdate($birthMonth, $birthDate, $birthYear)) return false; 
		for ($i = 0; $i < 13; $i++) $buf[$i] = (int) $resno[$i]; 
		$multipliers = array(2,3,4,5,6,7,8,9,2,3,4,5); 
		for ($i = $sum = 0; $i < 12; $i++) $sum += ($buf[$i] *= $multipliers[$i]); 
		if ((11 - ($sum % 11)) % 10 != $buf[12]) return false; 
		return true; 
	} 

	// 사업자등록번호 체크 함수
	function chkCompany($reginum) { 
		$weight = '137137135';
		$len = strlen($reginum); 
		$sum = 0; 
		if ($len <> 10) return false;
		for ($i = 0; $i < 9; $i++) $sum = $sum + (substr($reginum,$i,1)*substr($weight,$i,1)); 
		$sum = $sum + ((substr($reginum,8,1)*5)/10); 
		$rst = $sum%10; 
		if ($rst == 0) $result = 0;
		else $result = 10 - $rst;
		$saub = substr($reginum,9,1); 
		if ($result <> $saub) return false;
		return true; 
	} 

	# 문자열에 한글이 포함되어 있는지 검사하는 함수
	function chkHan($str) {
		# 특정 문자가 한글의 범위내(0xA1A1 - 0xFEFE)에 있는지 검사
		$strCnt=0;
		while( strlen($str) >= $strCnt) {
			$char = ord($str[$strCnt]);
			if($char >= 0xa1 && $char <= 0xfe) return true;
			$strCnt++;
		}
	}

	// 문자열 체크(숫자)
	function chkDigit($str) {
		if(ereg("^[1-9]+[0-9]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파)
	function chkAlpha($str) {
		if(ereg("^[a-zA-Z]+[a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자)		
	function chkAlnum($str) {
		if(ereg("^[1-9a-zA-Z]+[0-9a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자+특수문자)		
	function chkAlnumAll($str) {
		if(ereg("^[1-9a-zA-Z_-]+[0-9a-zA-Z_-]*$",$str))  return true;
		else return false;
	}

	// 메세지 출력
	function msg($msg) {
		echo "<script language='javascript'> alert('$msg'); </script>";
	}

	// 메세지 출력
	function msgStop($msg) {
		echo "<script language='javascript'> alert('$msg'); </script>";
		exit();
	}

	// 메세지 출력후 BACK
	function errMsg($msg) {
		echo "<script language='javascript'> alert('$msg'); history.back(); </script>";
		exit();
	}

	// 메세지 출력후 BACK
	function errMsgLayer($title, $msg) {
		echo '<link href="/css/style.css" rel="stylesheet" type="text/css">';
		echo '<link href="/css/develop.css" rel="stylesheet" type="text/css">';
		echo '<script language="javascript" src="/lib/jquery-1.7.1.min.js"></script>';
		echo '<script language="javascript" src="/lib/jqueryui.js"></script>';
		echo '<script language="javascript" src="/lib/common.js"></script>';
		echo '<html><body>';
		echo '<div style="width:100%">';
		echo '<div id="alertLayerNoContent">';
		echo '	<div><img src="/img/sub/layer_top.jpg"></div>';
		echo '	<div class="container">';
		echo '		<div class="b006" id="alertLayerPrefaceNoContent"></div>';
		echo '		<div class="content">';
		echo '			<div id="alertLayerContentNoContent"></div>';
		echo '		</div>';
		echo '		<div class="btnArea">';
		echo '			<img id="alertLayerConfirmNoContent" src="/img/sub/btn_ok.jpg" style="cursor:pointer" onclick="history.back();">';
		echo '		</div>';
		echo '	</div>';
		echo '	<div><img src="/img/sub/layer_bottom.jpg"></div>';
		echo '</div>';
		echo '<div id="background2"></div>';
		echo '<script language=javascript>openAlertLayerNoContent2(\''. $title .'\', \''. $msg .'\');</script>';
		echo '</div>';
		echo '</body></html>';
		exit();
	}

	// 메세지 출력후 이동하는 자바스크립트
	function alertJavaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); location.replace('$url'); </script>";
		exit();
	}
	function alertJavaGoNoContent($title, $msg, $url) {
		echo '<link href="/css/style.css" rel="stylesheet" type="text/css">';
		echo '<link href="/css/develop.css" rel="stylesheet" type="text/css">';
		echo '<script language="javascript" src="/lib/jquery-1.7.1.min.js"></script>';
		echo '<script language="javascript" src="/lib/jqueryui.js"></script>';
		echo '<script language="javascript" src="/lib/common.js"></script>';
		echo '<html><body>';
		echo '<div style="width:100%">';
		echo '<div id="alertLayerNoContent">';
		echo '	<div><img src="/img/sub/layer_top.jpg"></div>';
		echo '	<div class="container">';
		echo '		<div class="b006" id="alertLayerPrefaceNoContent"></div>';
		echo '		<div class="content">';
		echo '			<div id="alertLayerContentNoContent"></div>';
		echo '		</div>';
		echo '		<div class="btnArea">';
		echo '			<img id="alertLayerConfirmNoContent" src="/img/sub/btn_ok.jpg" style="cursor:pointer" onclick="location.replace(\''. $url. '\');">';
		echo '		</div>';
		echo '	</div>';
		echo '	<div><img src="/img/sub/layer_bottom.jpg"></div>';
		echo '</div>';
		echo '<div id="background2"></div>';
		echo '<script language=javascript>openAlertLayerNoContent2(\''. $title .'\', \''. $msg .'\');</script>';
		echo '</div>';
		echo '</body></html>';
		exit();
	}

	// 메세지 출력후 이동하는 메타테그
	function alertMetaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); </script>"; 
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}
	
	// 메타태그로 바로 가기
	function metaGo($url) {
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}

	// 자바스크립트로 바로 가기
	function javaGo($url) {
		echo "<script language='javascript'> location.href='$url'; </script>";
		exit();
	}

	// 자바스크립트로 바로 가기
	function javaGo2($url) {
		echo "<script language='javascript'> location.replace('$url'); </script>";
		exit();
	}

	// 창을 닫기
	function winClose() { 
		echo "<script language='javascript'> window.close(); </script>";
		exit();
	}

	// 메세지 출력후 창을 닫기
	function msgClose($msg) { 
		echo "<script language='javascript'> alert('$msg'); window.close(); </script>";
		exit();
	}

	// 창을 닫고 가는 함수
	function javaGoClose($url) { 
		echo "<script language='javascript'> opener.location.replace('$url'); window.close(); </script>";
		exit();
	}
	// 부모창 리로드
	function javaReload() { 
		echo "<script language='javascript'> opener.location.reload(); </script>";
		exit();
	}
	// 부모창 리로드
	function javaReload2() { 
		echo "<script language='javascript'> opener.location.reload(); </script>";
	}

	// 창을 닫고 부모창 리로드
	function javaReloadClose($url) { 
		echo "<script language='javascript'> opener.location.reload(); window.close(); </script>";
		exit();
	}

	// 메세지 출력후 부모창 리로드 후 창닫기
	function javaReloadMsgClose($msg) { 
		echo "<script language='javascript'> alert('$msg'); opener.location.reload(); window.close(); </script>";
		exit();
	}

	// 메세지 출력후 부모창 쿼리스트링 후 창닫기
	function javaReloadMsgClose2($msg, $url) { 
		echo "<script language='javascript'> alert('$msg'); opener.location.replace('$url'); window.close(); </script>";
		exit();
	}
	
	// 프레임으로 된 경우 상위 프레임으로 가는 함수
	function javaGoTop($url) { 
		echo "<script language='javascript'> parent.frames.top.location.replace('$url'); </script>";
		exit();
	}
	function encode2($data) {
		return base64_encode(rawurlencode($data));
	}
	function decode2($data){
		$vars=explode("&",rawurldecode(base64_decode($data)));
		$vars_num=count($vars);
		for($i=0;$i<$vars_num;$i++) {
			$elements=explode("=",$vars[$i]);
			$var[$elements[0]]=$elements[1];
		}
		return $var;
	}
	function decode3($data){
		return rawurldecode(base64_decode($data));
	}
	// 에디터로 깨진 이미지명 변경 함수
	function modify_image($data)
	{
		$data = htmlspecialchars_decode(strip_tags(htmlspecialchars($data)));
//		$data = str_replace('\"', '"', $data);
		return $data;
	}

	// 로그인 안되었을시 로그인페이지로 이동시키는 스크립트
	function notLoginJavaGo($url) {
		$location = "/join/login.php?login_go=". $this->encode2($url);
		echo "
			<script language='javascript'>
				alert('로그인 후 사용가능합니다');
				location.replace('$location');
			</script>";
		exit();
	}
	function notLoginJavaGoNoContent($title, $msg, $url) {
		$location = "/join/login.php?login_go=". $this->encode2($url);
		echo '<link href="/css/style.css" rel="stylesheet" type="text/css">';
		echo '<link href="/css/develop.css" rel="stylesheet" type="text/css">';
		echo '<script language="javascript" src="/lib/jquery-1.7.1.min.js"></script>';
		echo '<script language="javascript" src="/lib/jqueryui.js"></script>';
		echo '<script language="javascript" src="/lib/common.js"></script>';
		echo '<html><body>';
		echo '<div style="width:100%">';
		echo '<div id="alertLayerNoContent">';
		echo '	<div><img src="/img/sub/layer_top.jpg"></div>';
		echo '	<div class="container">';
		echo '		<div class="b006" id="alertLayerPrefaceNoContent"></div>';
		echo '		<div class="content">';
		echo '			<div id="alertLayerContentNoContent"></div>';
		echo '		</div>';
		echo '		<div class="btnArea">';
		echo '			<img id="alertLayerConfirmNoContent" src="/img/sub/btn_ok.jpg" style="cursor:pointer" onclick="location.replace(\''. $location. '\');">';
		echo '		</div>';
		echo '	</div>';
		echo '	<div><img src="/img/sub/layer_bottom.jpg"></div>';
		echo '</div>';
		echo '<div id="background2"></div>';
		echo '<script language=javascript>openAlertLayerNoContent2(\''. $title .'\', \''. $msg .'\');</script>';
		echo '</div>';
		echo '</body></html>';
		exit();
	}
	// 날짜비교
	function dateDiff($date1, $date2){ 
		$_date1 = explode("-",$date1); 
		$_date2 = explode("-",$date2); 

		$tm1 = mktime(0,0,0,$_date1[1],$_date1[2],$_date1[0]); 
		$tm2 = mktime(0,0,0,$_date2[1],$_date2[2],$_date2[0]);

		return ($tm1 - $tm2) / 86400; 
	} 
	// 메모리 커스터마이징( $m은 MB단위로 넘어옴 )
	function strMemory($m)
	{
		echo round($m/1024,0).".00";
	}

	// 페이지 로딩 레이어
	function openPageLodingLayer() {
		echo '<link href="/css/style.css" rel="stylesheet" type="text/css">';
		echo '<link href="/css/develop.css" rel="stylesheet" type="text/css">';
		echo '<script language="javascript" src="/lib/jquery-1.7.1.min.js"></script>';
		echo '<script language="javascript" src="/lib/jqueryui.js"></script>';
		echo '<script language="javascript" src="/lib/common.js"></script>';
		echo '<html><body>';
		echo '<div style="width:100%">';
		echo '<div id="pageLodingLayer">';
		echo '	<div><img src="/img/loading_page.gif"></div>';
		echo '</div>';
		echo '<div id="background2"></div>';
		echo '<script language=javascript>openLayer(\'pageLodingLayer\', \'\', 1);</script>';
		echo '</body></html>';
	}

	// 배열에서 현재 순서대로 배열의 인덱스만 재정렬함. (myq1234 : 20150102)
	function reArangeArrIdx ($arr){
		$work_arr = $arr;
		unset($arr);

		$i = 0;
		foreach($work_arr as $key=>$val)
		{
			unset($work_arr[$key]);
			$new_key = $i;
			$work_arr[$new_key] = $val;
			$i++;
		}
		return $work_arr;
	}
}
?>
