<?
/**
**		author	:	ziphopgw
**		table		:	gw_member
**/
class member extends dbConnect
{
	var $table = "gw_member";
	var $idx;
	var $userid;
	var $passwd;
	var $email;
	var $name;
	var $nickname;
	var $homepage;
	var $blog;
	var $birthday;
	var $send_email;
	var $send_sms;
	var $authdi;
	var $authci;
	var $deny;
	var $limit_date;
	var $reg_date;
	var $last_date;
	var $is_admin;
	var $description;
	var $extra_vars;
	var $user_group;
	var $note;
	var $limit1;
	var $limit2;
	var $search_item;
	var $search_word;

	function member($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	function put(){
		$query = "
			INSERT INTO gw_member
			SET
				userid = '". $this->userid ."'
				, passwd = PASSWORD('". $this->passwd ."')
				, user_group = '". $this->user_group ."'
				, note = '". $this->note ."'
				, is_admin = '". $this->is_admin ."'
				, reg_date = NOW()
		";
		return $this->excute($query);
	}
	function lists(&$totalcount)
	{
		$add_where = "WHERE 1=1";
		if($this->userid) $add_where .= " AND userid = '". $this->userid ."'";
		if($this->email) $add_where .= " AND email = '". $this->email ."'";
		if($this->deny) $add_where .= " AND deny = '". $this->deny ."'";
		if($this->search_item && $this->search_word){
			if($this->search_item=='all'){
				$add_where .= " AND ( userid LIKE '%$this->search_word%'";
				$add_where .= " OR name LIKE '%$this->search_word%'";
				$add_where .= " OR email LIKE '%$this->search_word%' )";
			}else{
				$add_where .= " AND $this->search_item LIKE '%$this->search_word%'";
			}
		}
		if(is_numeric($this->limit1) && is_numeric($this->limit2)){
			$add_limit = " LIMIT $this->limit1, $this->limit2";
		}
		$query = "
			SELECT COUNT(1) FROM gw_member
			". $add_where ."
		";
		$totalcount = $this->fetch_row($query);

		$query = "
			SELECT * FROM gw_member
			". $add_where ."
			ORDER BY idx DESC
			". $add_limit ."
		";
		return $this->fetch_array_assoc_01($query);
	}
	function cnt()
	{
		$add_where = "WHERE 1=1";
		if($this->userid) $add_where .= " AND userid = '". $this->userid ."'";
		if($this->passwd) $add_where .= " AND passwd = PASSWORD('". $this->passwd ."')";
		if($this->is_admin) $add_where .= " AND is_admin = '". $this->is_admin ."'";
		$query = "
			SELECT COUNT(1) AS cnt FROM gw_member
			". $add_where ."
		";
		return $this->fetch_row($query);
	}
	function get()
	{
		$add_where = "WHERE 1=1";
		if($this->idx) $add_where .= " AND idx = ". $this->idx;
		if($this->userid) $add_where .= " AND userid = '". $this->userid ."'";
		if($this->passwd) $add_where .= " AND passwd = PASSWORD('". $this->passwd ."')";
		if($this->is_admin) $add_where .= " AND is_admin = '". $this->is_admin ."'";
		$query = "
			SELECT * FROM gw_member
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
	// 아이디 찾기
	function get2(){
		if(!$this->name || !$this->email)  return false;
		$add_where = "WHERE 1=1";
		if($this->name) $add_where .= " AND name = '". $this->name ."'";
		if($this->email) $add_where .= " AND email = '". $this->email ."'";
		$query = "
			SELECT * FROM gw_member
			". $add_where ."
			ORDER BY idx DESC
		";
		return $this->fetch_array_assoc_02($query);
	}
	// 비밀번호 찾기
	function get3(){
		if(!$this->name || !$this->userid)  return false;
		$add_where = "WHERE 1=1";
		if($this->name) $add_where .= " AND name = '". $this->name ."'";
		if($this->userid) $add_where .= " AND userid = '". $this->userid ."'";
		$query = "
			SELECT * FROM gw_member
			". $add_where ."
			ORDER BY idx DESC
		";
		return $this->fetch_array_assoc_02($query);
	}
	function update(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->last_date) $add_where .= ", last_date = NOW()";
		if($this->passwd) $add_where .= ", passwd = PASSWORD('". $this->passwd ."')";
		if($this->authdi) $add_where .= ", authdi = '". $this->authdi ."'";
		if($this->authci) $add_where .= ", authdi = '". $this->authci ."'";
		if($this->send_email) $add_where .= ", send_email = '". $this->send_email ."'";
		if($this->email) $add_where .= ", email = '". $this->email ."'";
		if($this->name) $add_where .= ", name = '". $this->name ."'";
		if($this->phone) $add_where .= ", phone = '". $this->phone ."'";
		if($this->passwd) $add_where .= ", passwd = PASSWORD('". $this->passwd ."')";

		$add_where = substr($add_where, 2);
		if(!$add_where) return false;

		$query = "
			UPDATE gw_member
			SET
				". $add_where ."
			WHERE idx = ". $this->idx ."
		";
		return $this->excute($query);
	}
	function update2(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->passwd) $add_where .= ", passwd = PASSWORD('". $this->passwd ."')";

		$query = "
			UPDATE gw_member
			SET
				user_group = '". $this->user_group ."'
				, note = '". $this->note ."'
				{$add_where}
			WHERE idx = ". $this->idx ."
		";
		return $this->excute($query);
	}
	function del(){
		if(!$this->idx) return false;
		$query = "DELETE FROM gw_member WHERE idx = ". $this->idx ."";
		return $this->excute($query);
	}
	function init(){
		$this->idx = '';
		$this->userid = '';
		$this->passwd = '';
		$this->email = '';
		$this->name = '';
		$this->nickname = '';
		$this->homepage = '';
		$this->blog = '';
		$this->birthday = '';
		$this->send_email = '';
		$this->send_sms = '';
		$this->deny = '';
		$this->limit_date = '';
		$this->reg_date = '';
		$this->last_date = '';
		$this->is_admin = '';
		$this->description = '';
		$this->extra_vars = '';
		$this->limit1 = '';
		$this->limit2 = '';
		$this->search_item = '';
		$this->search_word = '';
		$this->authdi = '';
		$this->authci = '';
	}
}
?>