<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);
	$board->code = 'news';
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	if(!$limit1) $limit1 = 0;

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
	$board_data->limit1 = $limit1;
	$board_data->limit2 = 10;
	$board_data->last_idx = $last_idx;
	$board_data->is_show = 'Y';
	$board_data->search_item = 'subject';
	$board_data->search_word = $search_word;
	$lists = $board_data->lists();

	echo json_encode($lists);
?>