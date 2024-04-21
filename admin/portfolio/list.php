<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");
	include_once $ROOT_DIR."/lib/page_class.php";

	$listScale		= 15; 						// 리스트갯수
	$pageScale		= 10;	 						// 페이지 갯수
	if( !$startPage ) { $startPage = 0; }	// 스타트 페이지
	$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지

	$search_word = trim($search_word);

	include_once($CLASS_DIR."/class_portfolio.php");
	$portfolio = new portfolio($DBINFO);
	$portfolio->search_item = $search_item;
	$portfolio->search_word = $search_word;
	$portfolio->limit1 = $startPage;
	$portfolio->limit2 = $listScale;
	$lists = $portfolio->lists($totalList);

	$nPAge = ceil($totalList/$listScale) - ceil(($totalList-$startPage)/$listScale) + 1;	// 현재 페이지
	$querystring = "&search_deny=$search_deny&search_item=$search_item&search_word=$search_word";

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."portfolio/list.php";

	include_once $_template['layout'];
?>