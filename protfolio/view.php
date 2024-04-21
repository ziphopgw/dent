<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	include_once($CLASS_DIR."/class_portfolio.php");
	$portfolio = new portfolio($DBINFO);
	$portfolio->idx = $idx;
	$row = $portfolio->get();
	$portfolio->init();

	$portfolio->ptf_use_yn = 'Y';
	$portfolio->next_idx = $idx;
	$portfolio->limit1 = 0;
	$portfolio->limit2 = 1;
	$next_row = $portfolio->lists();

	// 템플릿설정
	$_template['body'] = $SKIN_DIR."/protfolio/view.php";
	include_once $_template['layout'];
?>