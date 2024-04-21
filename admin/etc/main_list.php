<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
	include_once $ROOT_DIR."/lib/page_class.php";

	if(!$code) $code = 'visual';

	if(!$listScale) $listScale = 15; 		// 리스트갯수
	$pageScale		= 10;		// 페이지 갯수
	if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
	$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
	$nPAge = ceil($totalList/$listScale) - ceil(($totalList-$startPage)/$listScale) + 1;	// 현재 페이지

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = $code;
	$main->main_sect = $search_main_sect;
	$main->search_item = $search_item;
	$main->search_word = trim($search_word);
	$main->limit1 = $startPage;
	$main->limit2 = $listScale;
	$lists = $main->lists($totalList);

	$querystring = "code=".$code."&search_item=".$search_item."&search_word=".$search_word."&search_main_sect=".$search_main_sect;

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."etc/main_list.php";

	include_once $_template['layout'];
?>