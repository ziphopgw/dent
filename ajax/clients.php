<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	// 게시판 글 리스트를 가져온다
	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);
	$board->code = 'client';
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	if(!$limit1) $limit1 = 0;

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
//	$board_data->limit1 = $limit1;
//	$board_data->limit2 = 20;
	$board_data->last_idx = $last_idx;
	$lists = $board_data->lists();

	echo json_encode($lists);
?>