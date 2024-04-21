<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	$querystring = "search_item=$search_item&search_word=$search_word&startPage=$startPage";

	include_once($CLASS_DIR."/class_portfolio.php");
	$portfolio = new portfolio($DBINFO);

	if($command === 'put'){
		$ymd = date('Ymd');

		$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/portfolio/'.$ymd;

		if(!is_dir($upload_dir)){
			mkdir($upload_dir);
		}

		if($_FILES['ptf_list_thumb']['size']>0) {
			$file_name	= time()."_".$_FILES['ptf_list_thumb']['name'];
			$ptf_list_thumb = '/file/portfolio/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['ptf_list_thumb']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['ptf_list_thumb']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		if($_FILES['ptf_title_img']['size']>0) {
			$file_name	= time()."_".$_FILES['ptf_title_img']['name'];
			$ptf_title_img = '/file/portfolio/'.$ymd.'/'.$file_name;

			if(@move_uploaded_file($_FILES['ptf_title_img']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['ptf_title_img']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		$arr_ptf_award_thumb = array();
		$arrs = array();
		for($i=0; $i<count($_FILES['ptf_award_thumb']['name']); $i++){
			if($_FILES['ptf_award_thumb']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_award_thumb']['name'][$i];
				$ptf_award_thumb = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('award' => $ptf_award[$i], 'img' => $ptf_award_thumb);

				if(@move_uploaded_file($_FILES['ptf_award_thumb']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_award_thumb']['tmp_name']);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");

				array_push($arr_ptf_award_thumb, $arrs);
			}
		}
		$ptf_award_thumb_json = to_han(json_encode($arr_ptf_award_thumb));

		$arr_ptf_img = array();
		$arrs = array();
		for($i=0; $i<count($_FILES['ptf_img']['name']); $i++){
			if($_FILES['ptf_img']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_img']['name'][$i];
				$ptf_img = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('img' => $ptf_img);

				array_push($arr_ptf_img, $arrs);

				if(@move_uploaded_file($_FILES['ptf_img']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_img']['tmp_name'][$i]);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}
		}
		$ptf_img_json = to_han(json_encode($arr_ptf_img));

		$arr_ptf_rel_img = array();
		$arrs = array();

		for($i=0; $i<count($_FILES['ptf_rel_img']['name']); $i++){
			if($_FILES['ptf_rel_img']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_rel_img']['name'][$i];
				$ptf_rel_img = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('img' => $ptf_rel_img);

				array_push($arr_ptf_rel_img, $arrs);

				if(@move_uploaded_file($_FILES['ptf_rel_img']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_rel_img']['tmp_name'][$i]);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}
		}
		$ptf_rel_img_json = to_han(json_encode($arr_ptf_rel_img));

		$ptf_cd_str = '';
		for($i=0; $i<count($ptf_cd); $i++){
			$ptf_cd_str .= $ptf_cd[$i].',';
		}
		$ptf_cd_str = substr($ptf_cd_str, 0, -1);

		$portfolio->userid = $userid;
		$portfolio->ptf_cd = $ptf_cd_str;
		$portfolio->ptf_sort = $ptf_sort;
		$portfolio->ptf_title = $ptf_title;
		$portfolio->ptf_year = $ptf_year;
		$portfolio->ptf_award = $ptf_award;
		$portfolio->ptf_main_copy = $ptf_main_copy;
		$portfolio->ptf_client = $ptf_client;
		$portfolio->ptf_client_show = $ptf_client_show;
		$portfolio->ptf_manager = $ptf_manager;
		$portfolio->ptf_manager2 = $ptf_manager2;
		$portfolio->ptf_manager3 = $ptf_manager3;
		$portfolio->ptf_manager4 = $ptf_manager4;
		$portfolio->ptf_manager_show = $ptf_manager_show;
		$portfolio->ptf_manager_show2 = $ptf_manager_show2;
		$portfolio->ptf_manager_show3 = $ptf_manager_show3;
		$portfolio->ptf_manager_show4 = $ptf_manager_show4;
		$portfolio->ptf_campaign_year = $ptf_campaign_year;
		$portfolio->ptf_campaign_month = $ptf_campaign_month;
		$portfolio->ptf_content = $ptf_content;
		$portfolio->ptf_use_yn = $ptf_use_yn;
		$portfolio->ptf_list_thumb = $ptf_list_thumb;
		$portfolio->ptf_title_img = $ptf_title_img;
		$portfolio->ptf_award_thumb_json = $ptf_award_thumb_json;
		$portfolio->ptf_youtube_json = to_han(json_encode(str_replace('"', "'", $ptf_youtube)));
		$portfolio->ptf_img_json = $ptf_img_json;
		$portfolio->ptf_rel_img_json = $ptf_rel_img_json;
		$portfolio->ptf_url = $ptf_url;

		if($portfolio->put()){
			$idx = $db->last_insert_id();
			$tools->alertJavaGo('포트폴리오를 등록하였습니다.', "/admin/portfolio/list.php?$querystring");
		}else{
			$tools->errMsg('포트폴리오 등록 중 오류가 발생하였습니다.');
		}
	}
	else if($command === 'update')
	{
		$ymd = date('Ymd');

		$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/portfolio/'.$ymd;

		if(!is_dir($upload_dir)){
			mkdir($upload_dir);
		}

		$portfolio->idx = $idx;
		$row = $portfolio->get();
		$portfolio->init();

		if($_FILES['ptf_list_thumb']['size']>0) {
			$file_name	= time()."_".$_FILES['ptf_list_thumb']['name'];
			$ptf_list_thumb = '/file/portfolio/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['ptf_list_thumb']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['ptf_list_thumb']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		if($_FILES['ptf_title_img']['size']>0) {
			$file_name	= time()."_".$_FILES['ptf_title_img']['name'];
			$ptf_title_img = '/file/portfolio/'.$ymd.'/'.$file_name;

			if(@move_uploaded_file($_FILES['ptf_title_img']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['ptf_title_img']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		$arr_ptf_award_thumb = array();
		$arrs = array();
		for($i=0; $i<count($_FILES['ptf_award_thumb']['name']); $i++){
			if($_FILES['ptf_award_thumb']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_award_thumb']['name'][$i];
				$ptf_award_thumb = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('award' => $ptf_award[$i], 'img' => $ptf_award_thumb);

				if(@move_uploaded_file($_FILES['ptf_award_thumb']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_award_thumb']['tmp_name']);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");

				array_push($arr_ptf_award_thumb, $arrs);
			}
		}
		if(count($arr_ptf_award_thumb)>0){
			$arr_ptf_award_thumb_ori = json_decode($row['ptf_award_thumb_json']);
			if(count($arr_ptf_award_thumb_ori) > 0){
				$arr_ptf_award_thumb = array_merge($arr_ptf_award_thumb_ori, $arr_ptf_award_thumb);
			}
			$ptf_award_thumb_json = to_han(json_encode($arr_ptf_award_thumb));
		}

		$arr_ptf_img = array();
		$arrs = array();
		for($i=0; $i<count($_FILES['ptf_img']['name']); $i++){
			if($_FILES['ptf_img']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_img']['name'][$i];
				$ptf_img = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('img' => $ptf_img);

				if(@move_uploaded_file($_FILES['ptf_img']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_img']['tmp_name'][$i]);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");

				array_push($arr_ptf_img, $arrs);
			}
		}
		if(count($arr_ptf_img)>0){
			$arr_ptf_img_ori = json_decode($row['ptf_img_json']);
			if(count($arr_ptf_img_ori) > 0){
				$arr_ptf_img = array_merge($arr_ptf_img_ori, $arr_ptf_img);
			}
			$ptf_img_json = to_han(json_encode($arr_ptf_img));
		}

		$arr_ptf_rel_img = array();
		$arrs = array();
		for($i=0; $i<count($_FILES['ptf_rel_img']['name']); $i++){
			if($_FILES['ptf_rel_img']['size'][$i]>0) {
				$file_name	= time()."_".$_FILES['ptf_rel_img']['name'][$i];
				$ptf_rel_img = '/file/portfolio/'.$ymd.'/'.$file_name;

				$arrs = array('img' => $ptf_rel_img);

				if(@move_uploaded_file($_FILES['ptf_rel_img']['tmp_name'][$i], $upload_dir."/".$file_name)){
					@unlink($_FILES['ptf_rel_img']['tmp_name'][$i]);
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");

				array_push($arr_ptf_rel_img, $arrs);
			}
		}
		if(count($arr_ptf_rel_img)>0){
			$arr_ptf_rel_img_ori = json_decode($row['ptf_rel_img_json']);
			if(count($arr_ptf_rel_img_ori) > 0){
				$arr_ptf_rel_img = array_merge($arr_ptf_rel_img_ori, $arr_ptf_rel_img);
			}
			$ptf_rel_img_json = to_han(json_encode($arr_ptf_rel_img));
		}

		$ptf_cd_str = '';
		for($i=0; $i<count($ptf_cd); $i++){
			$ptf_cd_str .= $ptf_cd[$i].',';
		}
		$ptf_cd_str = substr($ptf_cd_str, 0, -1);

		$portfolio->ptf_cd = $ptf_cd_str;
		$portfolio->ptf_sort = $ptf_sort;
		$portfolio->ptf_title = $ptf_title;
		$portfolio->ptf_year = $ptf_year;
		$portfolio->ptf_award = $ptf_award;
		$portfolio->ptf_main_copy = $ptf_main_copy;
		$portfolio->ptf_client = $ptf_client;
		$portfolio->ptf_client_show = $ptf_client_show;
		$portfolio->ptf_manager = $ptf_manager;
		$portfolio->ptf_manager2 = $ptf_manager2;
		$portfolio->ptf_manager3 = $ptf_manager3;
		$portfolio->ptf_manager4 = $ptf_manager4;
		$portfolio->ptf_manager_show = $ptf_manager_show;
		$portfolio->ptf_manager_show2 = $ptf_manager_show2;
		$portfolio->ptf_manager_show3 = $ptf_manager_show3;
		$portfolio->ptf_manager_show4 = $ptf_manager_show4;
		$portfolio->ptf_campaign_year = $ptf_campaign_year;
		$portfolio->ptf_campaign_month = $ptf_campaign_month;
		$portfolio->ptf_content = $ptf_content;
		$portfolio->ptf_use_yn = $ptf_use_yn;
		$portfolio->ptf_list_thumb = $ptf_list_thumb;
		$portfolio->ptf_title_img = $ptf_title_img;
		$portfolio->ptf_award_thumb_json = $ptf_award_thumb_json;
		$portfolio->ptf_youtube_json = to_han(json_encode($ptf_youtube));
		$portfolio->ptf_img_json = $ptf_img_json;
		$portfolio->ptf_rel_img_json = $ptf_rel_img_json;
		$portfolio->mod_userid = $userid;
		$portfolio->ptf_url = $ptf_url;
		$portfolio->idx = $idx;

		if($portfolio->update()){
			$tools->alertJavaGo('포트폴리오를 수정하였습니다.', "/admin/portfolio/list.php?$querystring");
		}else{
			$tools->errMsg('포트폴리오 수정 중 오류가 발생하였습니다.');
		}
	}
	else if($command == 'del_file')
	{
		$portfolio->idx = $idx;
		$row = $portfolio->get();

		if($field=='ptf_list_thumb'){
			$portfolio->del_ptf_list_thumb = 1;
			@unlink($_SERVER['DOCUMENT_ROOT'].$row['ptf_list_thumb']);
		}
		if($field=='ptf_title_img'){
			$portfolio->del_ptf_title_img = 1;
			@unlink($_SERVER['DOCUMENT_ROOT'].$row['ptf_title_img']);
		}

		if($portfolio->update2()){
			$tools->alertJavaGo('이미지를 삭제하였습니다.', $PHP_SELF."?idx=$idx&$querystring");
		}else{
			$tools->errMsg('이미지 삭제 중 오류가 발생하였습니다.');
		}
	}
	else if($command == 'del_file_json')
	{
		$portfolio->idx = $idx;
		$row = $portfolio->get();

		if($field=='ptf_award_thumb_json'){
			$arr = json_decode($row['ptf_award_thumb_json']);

			@unlink($_SERVER['DOCUMENT_ROOT'].$arr[$index]->img);
			array_splice($arr, $index, 1);
			$portfolio->ptf_award_thumb_json = to_han(json_encode($arr));
		}

		if($field=='ptf_img_json'){
			$arr = json_decode($row['ptf_img_json']);

			@unlink($_SERVER['DOCUMENT_ROOT'].$arr[$index]->img);
			array_splice($arr, $index, 1);
			$portfolio->ptf_img_json = to_han(json_encode($arr));
		}

		if($field=='ptf_rel_img_json'){
			$arr = json_decode($row['ptf_rel_img_json']);

			@unlink($_SERVER['DOCUMENT_ROOT'].$arr[$index]->img);
			array_splice($arr, $index, 1);
			$portfolio->ptf_rel_img_json = to_han(json_encode($arr));
		}

		if($portfolio->update2()){
			$tools->alertJavaGo('이미지를 삭제하였습니다.', $PHP_SELF."?idx=$idx&$querystring");
		}else{
			$tools->errMsg('이미지 삭제 중 오류가 발생하였습니다.');
		}
	}
	else if($command == 'delete')
	{
		$portfolio->idx = $idx;
		$row = $portfolio->del();

		if($portfolio->del()){
			$tools->alertJavaGo('삭제하였습니다.', "/admin/portfolio/list.php?$querystring");
		}else{
			$tools->errMsg('삭제 중 오류가 발생하였습니다.');
		}
	}

	if($idx){
		$portfolio->idx = $idx;
		$row = $portfolio->get();

		$arr_ptf_cd = explode(',', $row['ptf_cd']);
	}

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."portfolio/mod.php";

	include_once $_template['layout'];
?>