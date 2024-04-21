<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
	include_once $ROOT_DIR."/lib/page_class.php";

	if(!$code) $tools->errMsg("잘못된 접근입니다");

	$bbs_title = "";
	$bbs_subtitle = "";
	$bbs_name = "";

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);
	$board->code = $code;
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	// 카테고리 정보를 가져온다
	include_once($CLASS_DIR."/class_board_category.php");
	$board_category = new board_category($DBINFO);
	$board_category->board_idx = $board_idx;
	$categories = $board_category->lists();

	if(!$listScale) $listScale = 15; 		// 리스트갯수
	$pageScale		= 10;		// 페이지 갯수
	if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
	$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
	$nPAge = ceil($totalList/$listScale) - ceil(($totalList-$startPage)/$listScale) + 1;	// 현재 페이지

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
	$board_data->category_idx = $search_category_idx;
	$board_data->search_item = $search_item;
	$board_data->search_word = trim($search_word);
	$board_data->limit1 = $startPage;
	$board_data->limit2 = $listScale;
	$lists = $board_data->lists();
	$totalList = $lists[0]['totalcount'];

	$querystring = "code=".$code."&search_item=".$search_item."&search_word=".$search_word."&search_category_idx=".$search_category_idx;

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."bbs/list.php";
	if($code=='client') $_template['body'] = $ADMIN_SKIN_DIR."bbs/list_client.php";

	include_once $_template['layout'];
?>