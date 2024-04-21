<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if(!$idx){
		$tools->errMsg('잘못된 접근입니다.');
	}

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);
	$board_data->idx = $idx;
	$row = $board_data->lists();
	$row = $row[0];
	$board_data->init();

	$tags = explode(',', $row['tag']);

	$board_data->not_in_idx = "'".$idx."'";
	$board_data->code = $row['code'];
	$board_data->tags = $tags;
	$board_data->limit1 = 0;
	$board_data->limit2 = 2;
	$relates = $board_data->lists();

	// 템플릿설정
	$_template['body'] = $SKIN_DIR."/news/view.php";
	include_once $_template['layout'];
?>