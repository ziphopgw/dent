<?
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);

//	if($_SERVER['REMOTE_ADDR'] == '59.13.207.3' || $_SERVER['REMOTE_ADDR'] == '118.36.249.138' || $_SERVER['REMOTE_ADDR'] == '211.60.50.131'){
//
//	}else{
//		header("Location: /notice.html");
//		exit;
//	}

	header("Pragma: no-cache");
	header("Cache: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires:Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Content-Type: text/html; charset=UTF-8");

	## HTTPS 적용하면서 register_globals Off 문제로 해당 부분을 지정한다.
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

	include_once $DOCUMENT_ROOT.'/lib/config.php';										// 설정파일
	include_once $DOCUMENT_ROOT.'/lib/basic_class.php';			// 이센스클레스
	include_once $DOCUMENT_ROOT.'/lib/function_inc.php';		// 개발함수

	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();

	$db->result('set names utf8');

	session_start();

	$pathinfo = pathinfo(PHP_SELF);
	$dirnm = $pathinfo['dirname'];

	if(strpos($dirnm, '/admin') !== false)
	{
		if(!$_SESSION['ADMIN_USERID'] && strpos($PHP_SELF, '/admin/index.php')=== false)
		{
			$tools->alertJavaGo('잘못된 접근입니다.', $ADMIN_VIEW_DIR);
		}

		$userid = $_SESSION['ADMIN_USERID'];

		$_template['layout'] = $ADMIN_SKIN_DIR.'common/layout.php';
		$_template['header'] = $ADMIN_SKIN_DIR.'common/header.php';
		$_template['top'] = $ADMIN_SKIN_DIR.'common/top.php';
		$_template['footer'] = $ADMIN_SKIN_DIR.'common/footer.php';
		$_template['left'] = $ADMIN_SKIN_DIR.'common/left.php';
		$_template['body'] = '';
	}
	else
	{
		$userid = $_SESSION['USERID'];

		if($userid)
		{
			include_once($CLASS_DIR."/class_member.php");
			$member = new member($DBINFO);
			$member->userid = $userid;
			$userinfo = $member->get();
			if($userinfo['is_admin']=='Y') $is_admin = 1;
			if($userinfo['authdi']) $is_writable = 1;
		}

		$_template['layout'] = $SKIN_DIR.'common/layout.php';
		$_template['header'] = $SKIN_DIR.'common/header.php';
		$_template['top'] = $SKIN_DIR.'common/top.php';
		$_template['footer'] = $SKIN_DIR.'common/footer.php';
		$_template['body'] = '';
	}

	extract($_POST);
	extract($_GET);

	if($dirnm === '/about') $select_about = 'selected';
	else if($dirnm === '/park') $select_park = 'selected';
	else if($dirnm === '/museum') $select_museum = 'selected';
	else if($dirnm === '/lesson') $select_lesson = 'selected';
	else if($dirnm === '/team61') $select_team61 = 'selected';

	$middle_select_box = '
		<a href="/" class="btn_home">홈</a>
		<select class="select_box select_page_move">
			<option value="../about/index.php" '. $select_about .'>Chan Ho Park</option>
			<option value="../park/index.php" '. $select_park .'>재단법인 박찬호 장학회</option>
			<option value="../museum/index.php" '. $select_museum .'>온라인 박물관</option>
			<option value="../lesson/index.php" '. $select_lesson .'>LESSON</option>
			<option value="../team61/index.php" '. $select_team61 .'>TEAM61</option>
		</select>
	';
?>
