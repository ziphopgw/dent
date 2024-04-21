<?
/**
**		author	:	ziphopgw
**		table		:	gw_board_file
**/
class board_file extends dbConnect
{
	var $table = "gw_board_file";
	var $idx;
	var $board_data_idx;
	var $filetype;
	var $filename;
	var $origin_filename;
	var $filesize;
	var $ipaddress;
	var $reg_date;

	function bbs_file($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	// select
	function lists()
	{
		$add_where = "WHERE 1=1";
		if(is_numeric($this->board_data_idx)) $add_where .= " AND board_data_idx = ". $this->board_data_idx;
		if($this->filetype) $add_where .= " AND filetype = '". $this->filetype ."'";

		$query = "
			SELECT * FROM gw_board_file
			". $add_where ."
			ORDER BY reg_date DESC
		";
		return $this->fetch_array_assoc_01($query);
	}
	function get()
	{
		$add_where = "WHERE 1=1";
		if(is_numeric($this->bbs_idx)) $add_where .= " AND board_data_idx = ". $this->bbs_idx;
		if(is_numeric($this->idx)) $add_where .= " AND idx = ". $this->idx;
		if($this->filetype) $add_where .= " AND filetype = '". $this->filetype ."'";

		$query = "
			SELECT * FROM gw_board_file
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
	// insert
	function put()
	{
		$add_where = "";

		if($this->board_data_idx) $add_where .= ", board_data_idx = '". $this->board_data_idx ."'";
		if($this->filename) $add_where .= ", filename = '". $this->filename ."'";
		if($this->origin_filename) $add_where .= ", origin_filename = '". $this->origin_filename ."'";
		if($this->filesize) $add_where .= ", filesize = '". $this->filesize ."'";
		if($this->filetype) $add_where .= ", filetype = '". $this->filetype ."'";
		if($this->ipaddress) $add_where .= ", ipaddress = '". $this->ipaddress ."'";
		if($this->reg_date) $add_where .= ", reg_date = '". $this->reg_date ."'";
		$add_where = substr($add_where, 2);

		$query = "
			INSERT gw_board_file
			SET
				". $add_where ."
		";
		return $this->excute($query);
	}
	function del()
	{
		if(!$this->idx) return false;

		$query = "DELETE FROM gw_board_file WHERE idx = ". $this->idx ."";
		return $this->excute($query);
	}
	function init(){
		$this->idx = '';
		$this->board_data_idx = '';
		$this->filetype = '';
		$this->filename = '';
		$this->origin_filename = '';
		$this->filesize = '';
		$this->ipaddress = '';
		$this->reg_date = '';
	}
}
?>