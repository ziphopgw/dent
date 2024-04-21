<?
/**
**		author	:	ziphopgw
**		table		:	gw_board_data
**/
class board_data extends dbConnect
{
	var $table = "gw_board_data";
	var $idx;
	var $board_idx;
	var $category_idx;
	var $is_notice;
	var $is_secret;
	var $subject;
	var $content;
	var $hit;
	var $password;
	var $userid;
	var $name;
	var $nick_name;
	var $email;
	var $last_update;
	var $ipaddress;
	var $reg_date;
	var $search_item;
	var $search_word;
	var $limit1;
	var $limit2;
	var $in_board_idx;
	var $in_category_idx;
	var $tag;
	var $is_show;
	var $is_show_main;
	var $sort;
	var $homepage;
	var $last_idx;
	var $tags = array();
	var $not_in_idx;

	function board_data($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	// select
	function lists()
	{
		$add_where = "WHERE 1=1";
		if($this->is_notice) $add_where .= " AND is_notice = '". $this->is_notice ."'";
		if(is_numeric($this->idx)) $add_where .= " AND idx = ". $this->idx;
		if(is_numeric($this->board_idx)) $add_where .= " AND board_idx = ". $this->board_idx;
		if(is_numeric($this->category_idx)) $add_where .= " AND category_idx = ". $this->category_idx;
		if($this->name) $add_where .= " AND name = '". $this->name ."'";
		if($this->subject) $add_where .= " AND subject = '". $this->subject ."'";
		if($this->in_board_idx) $add_where .= " AND board_idx IN (". $this->in_board_idx .")";
		if($this->in_category_idx) $add_where .= " AND category_idx IN (". $this->in_category_idx .")";
		if($this->is_show) $add_where .= " AND is_show = '". $this->is_show ."'";
		if($this->is_show_main) $add_where .= " AND is_show_main = '". $this->is_show_main ."'";

		if($this->search_item && $this->search_word)
		{
			if($this->search_item=='all')
			{
				$add_where .= " AND ( ";
				$add_where .= " name LIKE '%". $this->search_word ."%'";
				$add_where .= " OR subject LIKE '%". $this->search_word ."%'";
				$add_where .= " OR content LIKE '%". $this->search_word ."%'";
				$add_where .= " )";
			}
			else $add_where .= " AND " . $this->search_item ." LIKE '%". $this->search_word ."%'";
		}

		if($this->last_idx){
			$add_where .= " AND bd.idx < ". $this->last_idx;
		}

		if(count($this->tags) > 0){
			$add_where .= " AND ( ";
			for($i=0; $i<count($this->tags); $i++){
				if($i==0) $add_where .= " tag LIKE '%". $this->tags[$i] ."%' ";
				else $add_where .= " OR tag LIKE '%". $this->tags[$i] ."%' ";
			}
			$add_where .= " ) ";
		}

		if($this->not_in_idx){
			$add_where .= " AND idx NOT IN (". $this->not_in_idx .")";
		}

		if(is_numeric($this->limit1) && is_numeric($this->limit2)){
			$add_limit = " LIMIT $this->limit1, $this->limit2";
		}

		if($this->code == 'client' || $this->board_idx == '2'){
			$orderby = "
				ORDER BY 
					sort DESC,
					if(ascii(substr(subject, 1,1)) > 128, 1, 9) asc,
					if((ascii(substr(subject, 1,1)) >= 65 AND ascii(substr(subject, 1,1)) <= 90) OR (ascii(substr(subject, 1,1)) >= 97 
					AND ascii(substr(subject, 1,1))<= 122) , 1, 9) asc,
					if(ascii(substr(subject, 1,1)) = 48, 1, 9) asc
					, subject ASC
					, idx DESC
			";
		}else if($this->orderby){
			$orderby = $this->orderby;
		}else{
			$orderby = "ORDER BY sort DESC, subject, idx DESC";
		}

		$query = "
			SELECT 
				*, (SELECT COUNT(1) FROM gw_board_data ". $add_where .") AS totalcount
				, (SELECT idx FROM gw_board_data ". $add_where ." ORDER BY sort ASC, subject DESC, idx ASC LIMIT 1) AS last_idx
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'list_thumb' ORDER BY reg_date DESC LIMIT 1) AS list_thumb 
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'content_visual' ORDER BY reg_date DESC LIMIT 1) AS content_visual 
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'client_logo_pc' ORDER BY reg_date DESC LIMIT 1) AS client_logo_pc 
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'client_logo_mobile' ORDER BY reg_date DESC LIMIT 1) AS client_logo_mobile 
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'client_logo_main' ORDER BY reg_date DESC LIMIT 1) AS client_logo_main 
			FROM gw_board_data bd
			". $add_where ."
			". $orderby ."
			". $add_limit ."
		";
		return $this->fetch_array_assoc_01($query);
	}
	function lists2()
	{
		if(!$this->idx) return false;
		$add_where = "WHERE 1=1";
		if($this->is_notice) $add_where .= " AND is_notice = '". $this->is_notice ."'";
		if(is_numeric($this->board_idx)) $add_where .= " AND board_idx = ". $this->board_idx;
		if(is_numeric($this->category_idx)) $add_where .= " AND category_idx = ". $this->category_idx;
		if($this->name) $add_where .= " AND name = '". $this->name ."'";
		if($this->subject) $add_where .= " AND subject = '". $this->subject ."'";
		if($this->in_board_idx) $add_where .= " AND board_idx IN (". $this->in_board_idx .")";
		if($this->in_category_idx) $add_where .= " AND category_idx IN (". $this->in_category_idx .")";
		if($this->is_show) $add_where .= " AND is_show = '". $this->is_show ."'";
		if($this->is_show_main) $add_where .= " AND is_show_main = '". $this->is_show_main ."'";

		if($this->search_item && $this->search_word)
		{
			if($this->search_item=='all')
			{
				$add_where .= " AND ( ";
				$add_where .= " name LIKE '%". $this->search_word ."%'";
				$add_where .= " OR userid LIKE '%". $this->search_word ."%'";
				$add_where .= " OR subject LIKE '%". $this->search_word ."%'";
				$add_where .= " OR content LIKE '%". $this->search_word ."%'";
				$add_where .= " )";
			}
			else $add_where .= " AND " . $this->search_item ." LIKE '%". $this->search_word ."%'";
		}

		$query = "
			SELECT 
				*, (SELECT COUNT(1) FROM gw_board_data ". $add_where .") AS totalcount
				, (SELECT COUNT(1) FROM gw_comment WHERE board_data_idx = bd.idx) AS comment_count
				, (SELECT COUNT(1) FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'file') AS file_count
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'image' ORDER BY filename LIMIT 1) AS image
				, (SELECT name FROM gw_board_category WHERE idx = bd.category_idx) AS category_name
				, (SELECT code FROM gw_board WHERE idx = bd.board_idx) AS code
			FROM gw_board_data bd
			". $add_where ."
			AND idx >= ". $this->idx ."
			ORDER BY sort DESC, subject, idx DESC
			LIMIT 11
		";
		$result = $this->fetch_array_assoc_01($query);
		$result = array_reverse($result);

		$query = "
			SELECT 
				*, (SELECT COUNT(1) FROM gw_board_data ". $add_where .") AS totalcount
				, (SELECT COUNT(1) FROM gw_comment WHERE board_data_idx = bd.idx) AS comment_count
				, (SELECT COUNT(1) FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'file') AS file_count
				, (SELECT filename FROM gw_board_file WHERE board_data_idx = bd.idx AND filetype = 'image' ORDER BY filename LIMIT 1) AS image
				, (SELECT name FROM gw_board_category WHERE idx = bd.category_idx) AS category_name
				, (SELECT code FROM gw_board WHERE idx = bd.board_idx) AS code
			FROM gw_board_data bd
			". $add_where ."
			AND idx < ". $this->idx ."
			ORDER BY sort DESC, subject, idx DESC
			LIMIT 10
		";
		$result2 = $this->fetch_array_assoc_01($query);

		$result3 = array_merge($result, $result2);
		return $result3;
	}
	// insert
	function put()
	{
		$add_where = "";

		if($this->board_idx) $add_where .= ", board_idx = '". $this->board_idx ."'";
		if($this->category_idx) $add_where .= ", category_idx = '". $this->category_idx ."'";
		if($this->is_notice) $add_where .= ", is_notice = '". $this->is_notice ."'";
		if($this->userid) $add_where .= ", userid = '". $this->userid ."'";
		if($this->name) $add_where .= ", name = '". $this->name ."'";
		if($this->subject) $add_where .= ", subject = '". $this->subject ."'";
		if($this->content) $add_where .= ", content = '". $this->content ."'";
		if($this->ipaddress) $add_where .= ", ipaddress = '". $this->ipaddress ."'";
		if($this->youtube_url) $add_where .= ", youtube_url = '". $this->youtube_url ."'";
		if($this->stream_url) $add_where .= ", stream_url = '". $this->stream_url ."'";
		if($this->tag) $add_where .= ", tag = '". $this->tag ."'";
		if($this->notice_start_date) $add_where .= ", notice_start_date = '". $this->notice_start_date ."'";
		if($this->notice_end_date) $add_where .= ", notice_end_date = '". $this->notice_end_date ."'";
		if($this->is_show) $add_where .= ", is_show = '". $this->is_show ."'";
		if($this->is_show_main) $add_where .= ", is_show_main = '". $this->is_show_main ."'";
		if($this->sort) $add_where .= ", sort = '". $this->sort ."'";
		if($this->homepage) $add_where .= ", homepage = '". $this->homepage ."'";
		if($this->reg_date) $add_where .= ", reg_date = '". $this->reg_date ."'";
		else $add_where .= ", reg_date = NOW()";

		$add_where = substr($add_where, 2);

		$query = "
			INSERT gw_board_data
			SET
				". $add_where ."
		";
//		print_p2($query);
		return $this->excute($query);
	}
	// update
	function update()
	{
		if(!$this->idx) return false;

		$add_where = "";

		if($this->is_notice) $add_where .= ", is_notice = '". $this->is_notice ."'";
		if($this->category_idx) $add_where .= ", category_idx = '". $this->category_idx ."'";
		if($this->is_notice) $add_where .= ", is_notice = '". $this->is_notice ."'";
		if($this->subject) $add_where .= ", subject = '". $this->subject ."'";
		if($this->content) $add_where .= ", content = '". $this->content ."'";
		if($this->last_update) $add_where .= ", last_update = '". $this->last_update ."'";
		if($this->youtube_url) $add_where .= ", youtube_url = '". $this->youtube_url ."'";
		if($this->stream_url) $add_where .= ", stream_url = '". $this->stream_url ."'";
		if($this->stream_url_pc) $add_where .= ", stream_url_pc = '". $this->stream_url_pc ."'";
		if($this->hit) $add_where .= ", hit = '". $this->hit ."'";
		if($this->tag) $add_where .= ", tag = '". $this->tag ."'";
		if($this->notice_start_date) $add_where .= ", notice_start_date = '". $this->notice_start_date ."'";
		if($this->notice_end_date) $add_where .= ", notice_end_date = '". $this->notice_end_date ."'";
		if($this->is_show) $add_where .= ", is_show = '". $this->is_show ."'";
		if($this->is_show_main) $add_where .= ", is_show_main = '". $this->is_show_main ."'";
		if($this->sort) $add_where .= ", sort = '". $this->sort ."'";
		if($this->homepage) $add_where .= ", homepage = '". $this->homepage ."'";
		if($this->reg_date) $add_where .= ", reg_date = '". $this->reg_date ."'";

		$add_where = substr($add_where, 2);

		$query = "
			UPDATE gw_board_data
			SET
				". $add_where ."
			WHERE idx = ". $this->idx ."
		";
//		print_p2($query);
		return $this->excute($query);
	}
	// update
	function update2()
	{
		if(!$this->idx) return false;

		$add_where = "";

		if($this->category_idx) $add_where .= ", category_idx = '". $this->category_idx ."'";
		if($this->is_notice) $add_where .= ", is_notice = '". $this->is_notice ."'";
		if($this->subject) $add_where .= ", subject = '". $this->subject ."'";
		if($this->last_update) $add_where .= ", last_update = '". $this->last_update ."'";
		$add_where .= ", content = '". $this->content ."'";
		$add_where .= ", youtube_url = '". $this->youtube_url ."'";
		$add_where .= ", stream_url = '". $this->stream_url ."'";
		$add_where .= ", stream_url_pc = '". $this->stream_url_pc ."'";
		$add_where .= ", sort = '". $this->sort ."'";
		if($this->tag) $add_where .= ", tag = '". $this->tag ."'";
		if($this->notice_start_date) $add_where .= ", notice_start_date = '". $this->notice_start_date ."'";
		if($this->notice_end_date) $add_where .= ", notice_end_date = '". $this->notice_end_date ."'";
		if($this->is_show) $add_where .= ", is_show = '". $this->is_show ."'";
		if($this->is_show_main) $add_where .= ", is_show_main = '". $this->is_show_main ."'";
		if($this->homepage) $add_where .= ", homepage = '". $this->homepage ."'";
		if($this->reg_date) $add_where .= ", reg_date = '". $this->reg_date ."'";

		$add_where = substr($add_where, 2);

		$query = "
			UPDATE gw_board_data
			SET
				". $add_where ."
			WHERE idx = ". $this->idx ."
		";
		return $this->excute($query);
	}
	function get()
	{
		$add_where = "";
		if($this->is_notice) $add_where .= " AND is_notice = '". $this->is_notice ."'";
		if(is_numeric($this->idx)) $add_where .= " AND idx = ". $this->idx;
		if(is_numeric($this->board_idx)) $add_where .= " AND board_idx = ". $this->board_idx;
		if($this->name) $add_where .= " AND name = '". $this->name ."'";
		if($this->subject) $add_where .= " AND subject = '". $this->subject ."'";

		if(!$add_where) return false;

		$query = "
			SELECT * FROM gw_board_data
			WHERE 1=1
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
	function getNext(){
		if(!$this->idx || !$this->board_idx) return false;

		$add_where = "";
		if($this->category_idx) $add_where .= "AND category_idx = '". $this->category_idx ."'";
		if($this->search_item && $this->search_word)
		{
			if($this->search_item=='all')
			{
				$add_where .= " AND ( ";
				$add_where .= " name LIKE '%". $this->search_word ."%'";
				$add_where .= " OR userid LIKE '%". $this->search_word ."%'";
				$add_where .= " OR subject LIKE '%". $this->search_word ."%'";
				$add_where .= " OR content LIKE '%". $this->search_word ."%'";
				$add_where .= " )";
			}
			else $add_where .= " AND " . $this->search_item ." LIKE '%". $this->search_word ."%'";
		}

		$query = "
			SELECT * FROM gw_board_data
			WHERE 1=1
			AND board_idx = ". $this->board_idx ."
			AND idx > ". $this->idx ."
			". $add_where ."
			ORDER BY sort DESC, subject, idx DESC
			LIMIT 1
		";
		return $this->fetch_array_assoc_02($query);
	}
	function getPrev(){
		if(!$this->idx || !$this->board_idx) return false;

		$add_where = "";
		if($this->category_idx) $add_where .= "AND category_idx = '". $this->category_idx ."'";
		if($this->search_item && $this->search_word)
		{
			if($this->search_item=='all')
			{
				$add_where .= " AND ( ";
				$add_where .= " name LIKE '%". $this->search_word ."%'";
				$add_where .= " OR userid LIKE '%". $this->search_word ."%'";
				$add_where .= " OR subject LIKE '%". $this->search_word ."%'";
				$add_where .= " OR content LIKE '%". $this->search_word ."%'";
				$add_where .= " )";
			}
			else $add_where .= " AND " . $this->search_item ." LIKE '%". $this->search_word ."%'";
		}

		$query = "
			SELECT * FROM gw_board_data
			WHERE 1=1
			AND board_idx = ". $this->board_idx ."
			AND idx < ". $this->idx ."
			". $add_where ."
			ORDER BY sort DESC, subject, idx DESC
			LIMIT 1
		";
		return $this->fetch_array_assoc_02($query);
	}
	function del()
	{
		if(!$this->idx) return false;

		$query = "DELETE FROM gw_board_data WHERE idx = ". $this->idx ."";
		return $this->excute($query);
	}
	function init(){
		$this->idx = '';
		$this->board_idx = '';
		$this->category_idx = '';
		$this->is_notice = '';
		$this->is_secret = '';
		$this->subject = '';
		$this->content = '';
		$this->hit = '';
		$this->password = '';
		$this->userid = '';
		$this->name = '';
		$this->nick_name = '';
		$this->email = '';
		$this->last_update = '';
		$this->ipaddress = '';
		$this->reg_date = '';
		$this->search_item = '';
		$this->search_word = '';
		$this->limit1 = '';
		$this->limit2 = '';
		$this->in_board_idx = '';
		$this->tag = '';
		$this->is_show = '';
		$this->is_show_main = '';
		$this->sort = '';
		$this->homepage = '';
		$this->last_idx = '';
		$this->tags = array();
		$this->not_in_idx = '';
	}
}
?>