<?
function print_p( $array )
{
	$str = print_r($array, true);
	echo "<span style='font-weight:bold;color:#333333'><pre>".$str."</pre></span>";
	exit;
}
function print_p2( $array )
{
	$str = print_r($array, true);
	echo "<span style='font-weight:bold;color:#333333'><pre>".$str."</pre></span>";
}
// 날짜 차이 구하기
function dateDiff($sStartDate, $sEndDate)
{
	$sStartTime = strtotime($sStartDate);
	$sEndTime = strtotime($sEndDate);

	if($sStartTime > $sEndTime) return false;

	$sDiffTime = $sEndTime - $sStartTime;

	$aReturnValue['d'] = floor($sDiffTime/60/60/24);
//	$aReturnValue['H'] = sprintf("%02d", ($sDiffTime/60/60)%24);
//	$aReturnValue['i'] = sprintf("%02d", ($sDiffTime/60)%60);
//	$aReturnValue['s'] = sprintf("%02d", ($sDiffTime%60));

	return $aReturnValue['d'];
}
// 날짜 형식
function strDate($date, $format)
{
	if(!$date || !$format) return false;
	
	$format = str_replace('Y', substr($date,0,4), $format);
	$format = str_replace('m', substr($date,4,2), $format);
	$format = str_replace('d', substr($date,6,2), $format);
	$format = str_replace('H', substr($date,8,2), $format);
	$format = str_replace('i', substr($date,10,2), $format);
	$format = str_replace('s', substr($date,12,2), $format);

	return $format;
}
// 글 보안적용 ( script방지 )
function strsecure($str)
{
	$str = trim($str);
	$str = stripslashes($str);
	$str = str_replace('<script', 'script', $str);
	$str = str_replace('<iframe', 'iframe', $str);
	return $str;
}
function strsecure2($str)
{
	$str = htmlspecialchars($str);
	$str = stripslashes($str);
	return $str;
}
// insert문
function strsecure3($str)
{
	$str = addslashes($str);
	$str = str_replace('<script', 'script', $str);
	$str = str_replace('<iframe', 'iframe', $str);
	return $str;
}
function number_format_dollar($v)
{
	$d = number_format(substr($v, 0, strlen($v)-2));
	$c = substr($v, strlen($v)-2);
	return $d.'.'.$c;
}
function formatBytes($size, $precision = 2) { 
	$base = log($size) / log(1024);
	$suffixes = array('', ' KB', ' MB', ' GB', ' TB');   
	$result = round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	if($size<1024) $result = round($size/1024, 2). ' KB';
	if($result==NAN) $result = '0.00 KB';
	return $result;
}
function formatBytes2($size, $precision = 2) { 
	$base = log($size) / log(1024);
	$suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
	$result = round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	if($size<1024) $result = round($size/1024, 2). 'KB';
	if($result==NAN) $result = '0.00KB';
	return $result;
}
function formatBytes3($size, $precision = 2) { 
	$size = $size / 1024;
	$base = log($size) / log(1024);
	$suffixes = array('', 'MB', 'GB', 'TB');   
	$result = round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	if($size<1024) $result = round($size/1024, 2). 'MB';
	if($result==NAN) $result = '0.00MB';
	return $result;
}
// 문자열 자르는 부분
function strCut($str, $len) {
	if ($len >= strlen($str)) return $str;
	$klen = $len - 1;
	while(ord($str[$klen]) & 0x80) $klen--;
	return mb_substr($str, 0, $len - (($len + $klen + 1) % 2), 'UTF-8') ."..";
}
// zone명 변경
function changeZonename($zonename)
{
	if($zonename=='kr-1') $name = 'KOR-Central A';
	else if($zonename=='kr-2') $name = 'KOR-Central B';
	else if($zonename=='kr-3') $name = 'KOR-HA';
	else if($zonename=='jp-1') $name = 'JPN';
	else $name = $zonename;
	return $name;
}
/**
 * @brief mysql old_password 의 php 구현 함수
 * 제로보드4나 기타 mysql4.1 이전의 old_password()함수를 쓴 데이터의 사용을 위해서
 * mysql의 password.c 소스 참조해서 구현함
 **/
function mysql_pre4_hash_password($password) {
	$nr = 1345345333;
	$add = 7;
	$nr2 = 0x12345671;

	settype($password, "string");

	for ($i=0; $i<strlen($password); $i++) {
		if ($password[$i] == ' ' || $password[$i] == '\t') continue;
		$tmp = ord($password[$i]);
		$nr ^= ((($nr & 63) + $add) * $tmp) + ($nr << 8);
		$nr2 += ($nr2 << 8) ^ $nr;
		$add += $tmp;
	}

	$result1 = sprintf("%08lx", $nr & ((1 << 31) -1));
	$result2 = sprintf("%08lx", $nr2 & ((1 << 31) -1));

	if($result1 == '80000000') $nr += 0x80000000;
	if($result2 == '80000000') $nr2 += 0x80000000;

	return sprintf("%08lx%08lx", $nr, $nr2);
}
function replace_content($content){
	if(strpos($content, '/files/attach') === false){
		$content = str_replace('files/attach', '/files/attach', $content);
		$content = str_replace('../chp/images', '/files/attach/chp/images', $content);
	}
	$content = $content;
	return $content;
}
function isMobile(){
	// 모바일 목록
	$mobilechk = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/i'; 

	// 모바일 접속인지 PC로 접속했는지 체크합니다.
	if(preg_match($mobilechk, $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else { 
		return false;
	} 
}
function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }
function to_han ($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }
?>
