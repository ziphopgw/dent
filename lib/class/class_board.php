<?
/**
**		author	:	ziphopgw
**		table		:	gw_board
**/
class board extends dbConnect
{
	var $table = "gw_board";
	var $idx;
	var $code;
	var $reg_date;

	function board($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	// select
	function get()
	{
		$add_where = "WHERE 1=1";
		if($this->code) $add_where .= " AND code = '". $this->code ."'";

		$query = "
			SELECT * FROM gw_board
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
}
?>