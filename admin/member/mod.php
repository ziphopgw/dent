<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if($_SESSION['ADMIN_LEVEL']!=='100'){
		$tools->errMsg('잘못된 접근입니다.');
	}

	$querystring = "search_item=$search_item&search_word=$search_word&startPage=$startPage";

	include_once($CLASS_DIR."/class_member.php");
	$member = new member($DBINFO);

	if($command === 'update')
	{
		$member->idx = $idx;
		$member->user_group = $user_group;
		$member->note = $note;

		if($passwd) $member->passwd = $passwd;
		if($member->update2()){
			$tools->alertJavaGo('관리자 정보를 업데이트하였습니다.', "/admin/member/list.php?$querystring");
		}else{
			$tools->errMsg('관리자 정보를 업데이트 중 오류가 발생하였습니다.');
		}
	}else if($command === 'put'){
		$member->userid = trim($userid);
		$member->user_group = $user_group;
		$member->note = $note;
		$member->is_admin = 'Y';
		$member->passwd = $passwd;
		if($member->put()){
			$idx = $db->last_insert_id();
			$tools->alertJavaGo('관리자 정보를 등록하였습니다.', "/admin/member/list.php?$querystring");
		}else{
			$tools->errMsg('관리자 정보를 등록 중 오류가 발생하였습니다.');
		}
	}else if($command === 'delete'){
		$member->idx = $idx;
		if($member->del()){
			$tools->alertJavaGo('관리자를 삭제하였습니다.', "/admin/member/list.php?$querystring");
		}else{
			$tools->errMsg('관리자 삭제 중 오류가 발생하였습니다.');
		}
	}

	if($idx){
		$member->idx = $idx;
		$row = $member->get($totalList);
	}

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."member/mod.php";

	include_once $_template['layout'];
?>