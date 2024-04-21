<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if(!$search_word) exit;

	include_once($CLASS_DIR."/class_portfolio.php");
	$portfolio = new portfolio($DBINFO);
	$portfolio->ptf_use_yn = 'Y';
	$portfolio->last_idx = $last_portfolio_idx;
	$portfolio->limit1 = 0;
	$portfolio->limit2 = 10;
	$portfolio->search_item = 'ptf_title';
	$portfolio->search_word = $search_word;
	$portfolios = $portfolio->lists($totalList);

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);
	$board->code = 'news';
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
	$board_data->limit1 = 0;
	$board_data->limit2 = 10;
	$board_data->last_idx = $last_news_idx;
	$board_data->search_item = 'subject';
	$board_data->search_word = $search_word;
	$news = $board_data->lists();

	$return = array(
		'portfolios' => $portfolios,
		'news' => $news
	);

	echo json_encode($return);
?>