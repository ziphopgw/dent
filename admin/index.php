<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if($userid && $passwd)
	{
		include_once($CLASS_DIR."/class_member.php");
		$member = new member($DBINFO);
		$member->userid = $userid;
		$member->passwd = $passwd;
		$member->is_admin = 'Y';
		$member_row = $member->get();

		if($member_row['idx'])
		{
			$member->init();
			$member->idx = $member_row['idx'];
			$member->last_date = 1;
			$member->update();

			$_SESSION['ADMIN_USERID'] = $member_row['userid'];
			$_SESSION['ADMIN_USERNAME'] = $member_row['name'];
			$_SESSION['ADMIN_LEVEL'] = $member_row['admin_level'];

			if($save_admin_id){
				setcookie("save_admin_id", $member_row['userid'], time() + 60 * 60 * 24 * 30);
			}else{
				setcookie("save_admin_id", "", time() - 3600); 
			}

			$tools->javaGo2('/admin/portfolio/list.php');
		}
		else
		{
			$tools->errMsg('일치하는 정보가 없습니다.');
		}
	}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<title>dentsu KOREA ADMIN LOGIN</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7, minimum-scale=0.7, maximum-scale=1.4, user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" media="all" href="<?=$ADMIN_CSS_DIR?>/shake.css">
		<script src="<?=$ADMIN_JS_DIR?>/jquery-1.11.3.min.js"></script>
		<script src="<?=$ADMIN_JS_DIR?>/jquery.placeholder.enhanced-1.5.js"></script>
		<script src="<?=$ADMIN_JS_DIR?>/jquery.bxslider.min.js"></script>
		<script src="<?=$ADMIN_JS_DIR?>/common.js"></script>
		<!--[if lt IE 9]>
			<link rel="stylesheet" media="all" href="<?=$ADMIN_JS_DIR?>/css/ie.css">
			<script src="<?=$ADMIN_JS_DIR?>/js/html5.js"></script>
			<script src="<?=$ADMIN_JS_DIR?>/js/respond.js"></script>
		<![endif]-->
	</head>
	<body class="whbg">
		<div id="viewport">
			<div class="logintop">
				<br>
				<img src="/admin/img/main/logo_gate.jpg">
				<br><span style="font-size:18px;">dentsu KOREA ADMIN LOGIN</span>
			</div>
			<form id="frm" method="post" action="<?=$PHP_SELF?>">
				<div class="login_area">
					<div class="form_area">
						<input type="text" name="userid" title="아이디" placeholder="아이디" class="input_text id" value="<?=$_COOKIE['save_admin_id']?>" required />
						<input type="password" name="passwd" title="비밀번호" placeholder="비밀번호" class="input_text pw" value="" required />
						<br>
						<input type="checkbox" name="save_admin_id" id="save_admin_id" value="1" <?=($_COOKIE['save_admin_id'])?'checked':''?>><label for="save_admin_id" style="font-size:14px;"> 아이디 저장</label>
						<a href="javascript:sendit()" class="btns btn_login">로그인</a>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

<script language="javascript">
$('input').keydown(function (key) {
	if(key.keyCode == 13){
		sendit();
	}
});
function sendit(){
	if($('input[name=userid]').val() === ''){
		alert('아이디를 입력하세요');
		$('input[name=userid]').focus();
		return;
	}
	if($('input[name=passwd]').val() === ''){
		alert('아이디를 입력하세요');
		$('input[name=passwd]').focus();
		return;
	}
	$('#frm').submit();
}
</script>