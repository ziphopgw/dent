<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	$querystring = "code=".$code."&search_item=".$search_item."&search_word=".$search_word."&search_main_sect=".$search_main_sect;

	include_once($CLASS_DIR."/class_main.php");
	$main = new main($DBINFO);

	if($command === 'put'){
		$ymd = date('Ymd');

		$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/main/'.$ymd;

		if(!is_dir($upload_dir)){
			mkdir($upload_dir);
		}

		if($_FILES['main_img']['size']>0) {
			$file_name	= time()."_".$_FILES['main_img']['name'];
			$main_img = '/file/main/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['main_img']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['main_img']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		if($_FILES['main_file']['size']>0) {
			$file_name	= time()."_".$_FILES['main_file']['name'];
			$main_file = '/file/main/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['main_file']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['main_file']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		$main->userid = $userid;
		$main->code = $code;
		$main->main_title = $main_title;
		$main->main_subtitle = $main_subtitle;
		$main->main_sort = $main_sort;
		$main->main_sect = $main_sect;
		$main->ptf_award = $ptf_award;
		$main->main_link = $main_link;
		$main->main_target = $main_target;
		$main->main_img = $main_img;
		$main->main_file = $main_file;
		$main->main_use_yn = $main_use_yn;

		if($main->put()){
			$idx = $db->last_insert_id();
			$tools->alertJavaGo('메인 정보를 등록하였습니다.', "/admin/etc/main_list.php?$querystring");
		}else{
			$tools->errMsg('메인 정보 등록 중 오류가 발생하였습니다.');
		}
	}
	else if($command=='update')
	{
		$ymd = date('Ymd');

		$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/main/'.$ymd;

		if(!is_dir($upload_dir)){
			mkdir($upload_dir);
		}

		if($_FILES['main_img']['size']>0) {
			$file_name	= time()."_".$_FILES['main_img']['name'];
			$main_img = '/file/main/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['main_img']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['main_img']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		if($_FILES['main_file']['size']>0) {
			$file_name	= time()."_".$_FILES['main_file']['name'];
			$main_file = '/file/main/'.$ymd.'/'.$file_name;

			if(move_uploaded_file($_FILES['main_file']['tmp_name'], $upload_dir."/".$file_name)){
				@unlink($_FILES['main_file']['tmp_name']);
			}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
		}

		$main->main_title = $main_title;
		$main->main_subtitle = $main_subtitle;
		$main->main_sort = $main_sort;
		$main->main_sect = $main_sect;
		$main->ptf_award = $ptf_award;
		$main->main_link = $main_link;
		$main->main_target = $main_target;
		$main->main_img = $main_img;
		$main->main_file = $main_file;
		$main->idx = $idx;
		$main->main_use_yn = $main_use_yn;
		$main->mod_userid = $userid;

		if($main->update()){
			$tools->alertJavaGo('메인 수정를 등록하였습니다.', "/admin/etc/main_list.php?$querystring");
		}else{
			$tools->errMsg('메인 정보 수정 중 오류가 발생하였습니다.');
		}
	}
	else if($command == 'del_file')
	{
		$main->idx = $idx;
		$row = $main->get();

		if($field=='main_img'){
			$main->del_main_img = 1;
			@unlink($_SERVER['DOCUMENT_ROOT'].$row['main_img']);
		}
		if($field=='main_file'){
			$main->del_main_file = 1;
			@unlink($_SERVER['DOCUMENT_ROOT'].$row['main_file']);
		}

		if($main->update2()){
			$tools->alertJavaGo('파일을 삭제하였습니다.', $PHP_SELF."?idx=$idx&$querystring");
		}else{
			$tools->errMsg('파일 삭제 중 오류가 발생하였습니다.');
		}
	}
	else if($command == 'delete')
	{
		$main->idx = $idx;
		$row = $main->del();

		if($main->del()){
			$tools->alertJavaGo('삭제하였습니다.', "/admin/etc/main_list.php?$querystring");
		}else{
			$tools->errMsg('삭제 중 오류가 발생하였습니다.');
		}
	}

	if($idx){
		$main->idx = $idx;
		$row = $main->get();
	}

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."etc/main_mod.php";

	include_once $_template['layout'];
?>