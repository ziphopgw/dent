<?
/**
**		author	:	ziphopgw
**		table		:	gw_board_category
**/
class board_category extends dbConnect
{
	var $table = "gw_board_category";
	var $board_idx;
	var $code;
	var $reg_date;

	function board_category($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	// select
	function lists()
	{
		$add_where = "WHERE 1=1";
		if(is_numeric($this->board_idx)) $add_where .= " AND board_idx = ". $this->board_idx;

		$query = "
			SELECT * FROM gw_board_category
			". $add_where ."
			ORDER BY idx DESC
		";
		return $this->fetch_array_assoc_01($query);
	}
}
?>