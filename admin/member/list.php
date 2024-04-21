<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
	include_once $ROOT_DIR."/lib/page_class.php";

	if($command === 'delete')
	{
		include_once($CLASS_DIR."/class_member.php");
		$member = new member($DBINFO);
		$member->idx = $idx;
		if($member->del()){
			$tools->alertJavaGo('관리자를 삭제하였습니다.', $PHP_SELF."?search_item={$search_item}&search_word={$search_word}&startPage={$startPage}");
		}else{
			$tools->errMsg('관리자 삭제 중 오류가 발생하였습니다.');
		}
	}

	if($_SESSION['ADMIN_LEVEL']!=='100'){
		$tools->errMsg('잘못된 접근입니다.');
	}

	$listScale		= 15; 						// 리스트갯수
	$pageScale		= 10;	 						// 페이지 갯수
	if( !$startPage ) { $startPage = 0; }	// 스타트 페이지
	$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지

	$search_word = trim($search_word);

	include_once($CLASS_DIR."/class_member.php");
	$member = new member($DBINFO);
	$member->search_item = $search_item;
	$member->search_word = $search_word;
	$member->deny = $search_deny;
	$member->limit1 = $startPage;
	$member->limit2 = $listScale;
	$lists = $member->lists($totalList);

	$nPAge = ceil($totalList/$listScale) - ceil(($totalList-$startPage)/$listScale) + 1;	// 현재 페이지
	$querystring = "&search_item=$search_item&search_word=$search_word";

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."member/list.php";

	include_once $_template['layout'];
?>