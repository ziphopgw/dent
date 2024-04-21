<?
/**
**		author	:	ziphopgw
**		table		:	gw_comment
**/
class comment extends dbConnect
{
	var $table = "gw_comment";
	var $idx;
	var $board_idx;
	var $board_data_idx;
	var $parent_idx;
	var $is_secret;
	var $content;
	var $voted_count;
	var $blamed_count;
	var $password;
	var $userid;
	var $name;
	var $nick_name;
	var $member_idx;
	var $reg_date;
	var $last_update;
	var $ipaddress;

	function bbs_file($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	// select
	function lists()
	{
		$add_where = "WHERE 1=1";
		if(is_numeric($this->board_data_idx)) $add_where .= " AND board_data_idx = ". $this->board_data_idx;

		$query = "
			SELECT * FROM gw_comment
			". $add_where ."
			ORDER BY idx DESC
		";
		return $this->fetch_array_assoc_01($query);
	}
	function put(){
		if(!$this->board_data_idx) return false;
		$query = "
			INSERT INTO gw_comment
			SET
				board_idx = ". $this->board_idx ."
				, board_data_idx = ". $this->board_data_idx ."
				, userid = '". $this->userid ."'
				, name = '". $this->name ."'
				, nick_name = '". $this->nick_name ."'
				, content = '". $this->content ."'
				, reg_date = '". $this->reg_date ."'
				, ipaddress = '". $this->ipaddress ."'
		";
		return $this->excute($query);
	}
	function del(){
		if(!$this->idx) return false;
		$query = "DELETE FROM gw_comment WHERE idx = ". $this->idx;
		return $this->excute($query);
	}
	function init(){
		$this->idx = '';
		$this->board_idx = '';
		$this->board_data_idx = '';
		$this->parent_idx = '';
		$this->is_secret = '';
		$this->content = '';
		$this->voted_count = '';
		$this->blamed_count = '';
		$this->password = '';
		$this->userid = '';
		$this->name = '';
		$this->nick_name = '';
		$this->member_idx = '';
		$this->reg_date = '';
		$this->last_update = '';
		$this->ipaddress = '';
	}
}
?>