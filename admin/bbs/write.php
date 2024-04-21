<?
	include_once($_SERVER['DOCUMENT_ROOT']."/lib/common.php");

	if(!$code) $tools->errMsg("잘못된 접근입니다");

	$querystring = "&code=".$code."&search_item=".$search_item."&search_word=".$search_word."&search_category_idx=".$search_category_idx;

	include_once($CLASS_DIR."/class_board.php");
	$board = new board($DBINFO);

	include_once($CLASS_DIR."/class_board_data.php");
	$board_data = new board_data($DBINFO);

	include_once($CLASS_DIR."/class_board_file.php");
	$board_file = new board_file($DBINFO);

	include_once($CLASS_DIR."/class_board_category.php");
	$board_category = new board_category($DBINFO);
	
	// 게시판 정보를 가져온다
	$board->code = $code;
	$boardinfo = $board->get();
	$board_idx = $boardinfo['idx'];

	if($command === 'put')
	{
		// 게시판 정보를 가져온다
		$board->code = $code;
		$boardinfo = $board->get();
		$board_idx = $boardinfo['idx'];

		if(!$is_notice) $is_notice = 'N';

		$board_data->board_idx = $board_idx;
		$board_data->category_idx = $category_idx;
		$board_data->userid = $_SESSION['ADMIN_USERID'];
		$board_data->name = $_SESSION['ADMIN_USERNAME'];
		$board_data->subject = $subject;
		$board_data->content = $content;
		$board_data->reg_date = date('YmdHis');
		$board_data->is_notice = $is_notice;
		$board_data->notice_start_date = $notice_start_date;
		$board_data->notice_end_date = $notice_end_date;
		$board_data->ipaddress = $_SERVER['REMOTE_ADDR'];
		$board_data->youtube_url = $youtube_url;
		$board_data->stream_url = $stream_url;
		$board_data->stream_url_pc = $stream_url_pc;
		$board_data->tag = $tag;
		$board_data->is_show = $is_show;
		$board_data->is_show = $is_show_main;
		$board_data->sort = $sort;
		$board_data->homepage = $homepage;
		$board_data->reg_date = $reg_date;

		if($board_data->put()){
			$idx = $db->last_insert_id();

			$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/attach/'.date('Ymd');

			if(!is_dir($upload_dir)){
				mkdir($upload_dir);
			}

			if($_FILES['file1']['size']>0) {
				$file_name1	= time()."_".$_FILES['file1']['name'];
//				if($_FILES['file1']['size']>1024*1024*2) $tools->errMsg("업로드 용량 초과입니다\\n2MB 까지 업로드 가능합니다");

				if(@move_uploaded_file($_FILES['file1']['tmp_name'], $upload_dir."/".$file_name1))
				{
					@unlink($_FILES['file1']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file1']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name1;
					$board_file->filesize = $_FILES['file1']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_pc';
					else $board_file->filetype = 'list_thumb';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			if($_FILES['file2']['size']>0) {
				$file_name2	= time()."_".$_FILES['file2']['name'];

				if(@move_uploaded_file($_FILES['file2']['tmp_name'], $upload_dir."/".$file_name2))
				{
					@unlink($_FILES['file2']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file2']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name2;
					$board_file->filesize = $_FILES['file2']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_mobile';
					else $board_file->filetype = 'content_visual';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			if($_FILES['file3']['size']>0) {
				$file_name3	= time()."_".$_FILES['file3']['name'];

				if(@move_uploaded_file($_FILES['file3']['tmp_name'], $upload_dir."/".$file_name3))
				{
					@unlink($_FILES['file3']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file3']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name3;
					$board_file->filesize = $_FILES['file3']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_main';
					else $board_file->filetype = 'content_visual';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			$tools->alertJavaGo("등록하였습니다.", "/admin/bbs/list.php?$querystring"); 
		}
		else{
			@unlink($_FILES['file1']['tmp_name']);
			@unlink($_FILES['file2']['tmp_name']);

			$tools->errMsg('등록시 오류가 발생하였습니다.');
		}
	}
	else if($command === 'update')
	{
		if(!$is_notice) $is_notice = 'N';

		$board_data->category_idx = $category_idx;
		$board_data->subject = $subject;
		$board_data->content = $content;
		$board_data->last_update = date('YmdHis');
		$board_data->ipaddress = $_SERVER['REMOTE_ADDR'];
		$board_data->is_notice = $is_notice;
		$board_data->notice_start_date = $notice_start_date;
		$board_data->notice_end_date = $notice_end_date;
		$board_data->youtube_url = $youtube_url;
		$board_data->stream_url = $stream_url;
		$board_data->stream_url_pc = $stream_url_pc;
		$board_data->tag = $tag;
		$board_data->is_show = $is_show;
		$board_data->is_show_main = $is_show_main;
		$board_data->sort = $sort;
		$board_data->homepage = $homepage;
		$board_data->reg_date = $reg_date;
		$board_data->idx = $idx;

		if($board_data->update2()){

			$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/file/attach/'.date('Ymd');

			if(!is_dir($upload_dir)){
				mkdir($upload_dir);
			}

			if($_FILES['file1']['size']>0) {
				$file_name1	= time()."_".$_FILES['file1']['name'];

				if(@move_uploaded_file($_FILES['file1']['tmp_name'], $upload_dir."/".$file_name1))
				{
					@unlink($_FILES['file1']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file1']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name1;
					$board_file->filesize = $_FILES['file1']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_pc';
					else $board_file->filetype = 'list_thumb';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			if($_FILES['file2']['size']>0) {
				$file_name2	= time()."_".$_FILES['file2']['name'];

				if(@move_uploaded_file($_FILES['file2']['tmp_name'], $upload_dir."/".$file_name2))
				{
					@unlink($_FILES['file2']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file2']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name2;
					$board_file->filesize = $_FILES['file2']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_mobile';
					else $board_file->filetype = 'content_visual';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			if($_FILES['file3']['size']>0) {
				$file_name3	= time()."_".$_FILES['file3']['name'];

				if(@move_uploaded_file($_FILES['file3']['tmp_name'], $upload_dir."/".$file_name3))
				{
					@unlink($_FILES['file3']['tmp_name']);
					$board_file->board_data_idx = $idx;
					$board_file->origin_filename = $_FILES['file3']['name'];
					$board_file->filename = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_dir).'/'.$file_name3;
					$board_file->filesize = $_FILES['file3']['size'];
					$board_file->reg_date = date('YmdHis');
					$board_file->ipaddress = $_SERVER['REMOTE_ADDR'];
					if($code=='client') $board_file->filetype = 'client_logo_main';
					else $board_file->filetype = 'content_visual';
					$board_file->put();
				}else $tools->errMsg("파일 업로드시 오류가 발생하였습니다.");
			}

			$tools->alertJavaGo("수정하였습니다.", "/admin/bbs/list.php?$querystring"); 
		}
		else{
			@unlink($_FILES['file1']['tmp_name']);
			@unlink($_FILES['file2']['tmp_name']);
			$tools->errMsg('수정시 오류가 발생하였습니다.');
		}
	}
	else if($command === 'del')
	{
		$board_data->idx = $idx;
		if($board_data->del()){
			$tools->alertJavaGo("삭제하였습니다.", "/admin/bbs/list.php?$querystring"); 
		}
		else $tools->errMsg('삭제시 오류가 발생하였습니다.');
	}
	else if($command === 'del_file')
	{
		$board_file->idx = $file_idx;
		$fileinfo= $board_file->get();
		@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$fileinfo['filename']);

		$board_file->idx = $file_idx;
		if($board_file->del()){
			$tools->alertJavaGo("파일을 삭제하였습니다.", $PHP_SELF.'?idx='.$idx.$querystring); 
		}
		else $tools->errMsg('파일 삭제시 오류가 발생하였습니다.');
	}

	// 게시판 글 리스트를 가져온다
	if($idx){
		$board_data->idx = $idx;
		$row = $board_data->get();

		if($code=='client'){
			$board_file->filetype = 'client_logo_pc';
			$board_file->board_data_idx = $idx;
			$client_logo_pc = $board_file->lists();
			$client_logo_pc = $client_logo_pc[0];

			$board_file->filetype = 'client_logo_mobile';
			$board_file->board_data_idx = $idx;
			$client_logo_mobile = $board_file->lists();
			$client_logo_mobile = $client_logo_mobile[0];

			$board_file->filetype = 'client_logo_main';
			$board_file->board_data_idx = $idx;
			$client_logo_main = $board_file->lists();
			$client_logo_main = $client_logo_main[0];
		}else{
			$board_file->filetype = 'list_thumb';
			$board_file->board_data_idx = $idx;
			$list_thumb = $board_file->lists();
			$list_thumb = $list_thumb[0];

			$board_file->filetype = 'content_visual';
			$board_file->board_data_idx = $idx;
			$content_visual = $board_file->lists();
			$content_visual = $content_visual[0];
		}

		include_once($CLASS_DIR."/class_comment.php");
		$comment = new comment($DBINFO);
		$comment->board_data_idx = $idx;
		$comments = $comment->lists();
	}

	// 카테고리 정보를 가져온다
	include_once($CLASS_DIR."/class_board_category.php");
	$board_category = new board_category($DBINFO);
	$board_category->board_idx = $board_idx;
	$categories = $board_category->lists();

	$querystring = "code=".$code."&search_item=".$search_item."&search_word=".$search_word."&search_category_idx=".$search_category_idx;

	// 템플릿설정
	$_template['body'] = $ADMIN_SKIN_DIR."bbs/write.php";
	if($code=='client') $_template['body'] = $ADMIN_SKIN_DIR."bbs/write_client.php";

	include_once $_template['layout'];
?>