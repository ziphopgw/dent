<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	// 메인 비쥬얼
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'visual';
	$main->main_use_yn = 'Y';
	$visuals = $main->lists();
	$main->init();

	// 메인 이미지 A
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'image';
	$main->main_sect = 'A';
	$img_a = $main->lists();
	$main->init();

	// 메인 이미지 B
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'image';
	$main->main_sect = 'B';
	$img_b = $main->lists();
	$main->init();

	// 메인 이미지 C
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'image';
	$main->main_sect = 'C';
	$img_c = $main->lists();
	$main->init();

	// 메인 이미지 D
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'image';
	$main->main_sect = 'D';
	$img_d = $main->lists();
	$main->init();

	// 메인 포폴 A 상단
	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);
	$main->code = 'portfolio';
	$main->main_sect = 'AT';
	$pf_at = $main->lists();
	$main->init();

	// 메인 포폴 A 하단
	$main->code = 'portfolio';
	$main->main_sect = 'AB';
	$pf_ab = $main->lists();
	$main->init();

	// 메인 포폴 B 상단
	$main->code = 'portfolio';
	$main->main_sect = 'BT';
	$pf_bt = $main->lists();
	$main->init();

	// 메인 포폴 B 하단
	$main->code = 'portfolio';
	$main->main_sect = 'BB';
	$pf_bb = $main->lists();
	$main->init();

	// 뉴스
	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);
	$board->code = 'news';
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
	$board_data->is_show = 'Y';
	$board_data->is_show_main = 'Y';
	$board_data->limit1 = 0;
	$board_data->limit2 = 3;
	$news = $board_data->lists();

	$board->code = 'client';
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->board_idx = $board_idx;
	$board_data->is_notice = 'Y';
	$board_data->limit1 = 0;
	$board_data->limit2 = 3;
	$clients = $board_data->lists();

	// 템플릿설정
	$_template['body'] = $SKIN_DIR."index.php";

	include_once $_template['layout'];
?>