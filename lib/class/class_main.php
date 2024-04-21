<?
/**
**		author	:	ziphopgw
**		table		:	gw_main
**/
class main extends dbConnect
{
	var $table = "gw_main";
	var $idx;
	var $code;
	var $main_title;
	var $main_subtitle;
	var $main_sort;
	var $main_sect;
	var $main_file;
	var $main_img;
	var $main_link;
	var $main_target;
	var $main_use_yn;
	var $userid;
	var $reg_date;
	var $limit1;
	var $limit2;
	var $search_item;
	var $search_word;
	var $del_main_img;
	var $del_main_file;
	var $mod_userid;
	var $mod_date;

	function main($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	function put(){
		$add_where = "";

		$query = "
			INSERT INTO gw_main
			SET
				userid = '". $this->userid ."'
				, code = '". $this->code ."'
				, main_title = '". $this->main_title ."'
				, main_subtitle = '". $this->main_subtitle ."'
				, main_sort = '". $this->main_sort ."'
				, main_sect = '". $this->main_sect ."'
				, main_file = '". $this->main_file ."'
				, main_img = '". $this->main_img ."'
				, main_link = '". $this->main_link ."'
				, main_target = '". $this->main_target ."'
				, main_use_yn = '". $this->main_use_yn ."'
				, reg_date = NOW()
				, mod_date = NOW()
				, mod_userid = '". $this->userid ."'
				{$add_where}
		";
		return $this->excute($query);
	}
	function update(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->main_file) $add_where .= ", main_file = '". $this->main_file ."'";
		if($this->main_img) $add_where .= ", main_img = '". $this->main_img ."'";
		if($this->del_main_img) $add_where .= ", main_img = ''";
		if($this->del_main_file) $add_where .= ", main_file = ''";

		$query = "
			UPDATE gw_main
			SET
				main_title = '". $this->main_title ."'
				, main_subtitle = '". $this->main_subtitle ."'
				, main_sort = '". $this->main_sort ."'
				, main_sect = '". $this->main_sect ."'
				, main_link = '". $this->main_link ."'
				, main_target = '". $this->main_target ."'
				, main_use_yn = '". $this->main_use_yn ."'
				, mod_date = NOW()
				, mod_userid = '". $this->mod_userid ."'
				{$add_where}
			WHERE idx = '". $this->idx ."'
		";
		return $this->excute($query);
	}
	function update2(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->main_file) $add_where .= ", main_file = '". $this->main_file ."'";
		if($this->main_img) $add_where .= ", main_img = '". $this->main_img ."'";
		if($this->del_main_img) $add_where .= ", main_img = ''";
		if($this->del_main_file) $add_where .= ", main_file = ''";

		$add_where = substr($add_where, 2);

		$query = "
			UPDATE gw_main
			SET
				{$add_where}
			WHERE idx = '". $this->idx ."'
		";
		return $this->excute($query);
	}
	function get()
	{
		$add_where = "WHERE 1=1";
		if($this->idx) $add_where .= " AND idx = ". $this->idx;
		if($this->userid) $add_where .= " AND userid = '". $this->userid ."'";
		$query = "
			SELECT * FROM gw_main
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
	function del()
	{
		if(!$this->idx) return false;

		$query = "DELETE FROM gw_main WHERE idx = '". $this->idx ."'";
		return $this->excute($query);
	}
	function lists(&$totalcount)
	{
		$add_where = "WHERE 1=1";
		if($this->code) $add_where .= " AND code = '$this->code'";
		if($this->main_sect) $add_where .= " AND main_sect = '$this->main_sect'";
		if($this->main_use_yn) $add_where .= " AND main_use_yn = '$this->main_use_yn'";
		if($this->search_item && $this->search_word){
			if($this->search_item=='all'){
				$add_where .= " AND ( main_title LIKE '%$this->search_word%' )";
//				$add_where .= " OR ptf_client LIKE '%$this->search_word%' )";
			}else{
				$add_where .= " AND $this->search_item LIKE '%$this->search_word%'";
			}
		}
		if(is_numeric($this->limit1) && is_numeric($this->limit2)){
			$add_limit = " LIMIT $this->limit1, $this->limit2";
		}
		$query = "
			SELECT COUNT(1) FROM gw_main
			". $add_where ."
		";
		$totalcount = $this->fetch_row($query);

		$query = "
			SELECT * FROM gw_main
			". $add_where ."
			ORDER BY main_sort DESC, idx DESC
			". $add_limit ."
		";
		return $this->fetch_array_assoc_01($query);
	}
	function init(){
		$this->idx = '';
		$this->code = '';
		$this->main_title = '';
		$this->main_subtitle = '';
		$this->main_sort = '';
		$this->main_sect = '';
		$this->main_file = '';
		$this->main_img = '';
		$this->main_link = '';
		$this->main_target = '';
		$this->main_use_yn = '';
		$this->userid = '';
		$this->reg_date = '';
		$this->limit1 = '';
		$this->limit2 = '';
		$this->search_item = '';
		$this->search_word = '';
		$this->del_main_img = '';
		$this->del_main_file = '';
		$this->mod_userid = '';
		$this->mod_date = '';
	}
}
?>