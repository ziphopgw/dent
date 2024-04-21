<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if(!$limit1) $limit1 = 0;

	include_once($CLASS_DIR."/class_portfolio.php");
	$portfolio = new portfolio($DBINFO);
	$portfolio->ptf_use_yn = 'Y';
	$portfolio->last_idx = $last_idx;
	$portfolio->limit1 = $limit1;
	$portfolio->limit2 = 10;
	$portfolio->ptf_cd = $ptf_cd;
	$portfolio->search_item = 'ptf_title';
	$portfolio->search_word = $search_word;
	$lists = $portfolio->lists($totalList);

	echo json_encode($lists);
?>