<?
/**
**		author	:	ziphopgw
**		table		:	gw_member
**/
class portfolio extends dbConnect
{
	var $table = "gw_portfolio";
	var $idx;
	var $ptf_cd;
	var $ptf_sort;
	var $ptf_title;
	var $ptf_year;
	var $ptf_main_copy;
	var $ptf_youtube;
	var $ptf_client;
	var $ptf_client_show;
	var $ptf_manager;
	var $ptf_manager2;
	var $ptf_manager3;
	var $ptf_manager4;
	var $ptf_manager_show;
	var $ptf_manager_show2;
	var $ptf_manager_show3;
	var $ptf_manager_show4;
	var $ptf_campaign_year;
	var $ptf_campaign_month;
	var $ptf_content;
	var $ptf_use_yn;
	var $ptf_list_thumb;
	var $ptf_title_img;
	var $ptf_award_thumb_json;
	var $ptf_youtube_json;
	var $ptf_img_json;
	var $ptf_rel_img_json;
	var $reg_date;
	var $limit1;
	var $limit2;
	var $search_item;
	var $search_word;
	var $del_ptf_list_thumb;
	var $del_ptf_title_img;
	var $mod_userid;
	var $mod_date;
	var $last_idx;
	var $ptf_url;
	var $next_idx;

	function portfolio($DBINFO)
	{
		$this->dbConnect($DBINFO['DB_HOST'], $DBINFO['DB_NAME'], $DBINFO['DB_USER'], $DBINFO['DB_PWD']);
	}
	function put(){
		$query = "
			INSERT INTO gw_portfolio
			SET
				userid = '". $this->userid ."'
				, ptf_cd = '". $this->ptf_cd ."'
				, ptf_sort = '". $this->ptf_sort ."'
				, ptf_title = '". $this->ptf_title ."'
				, ptf_year = '". $this->ptf_year ."'
				, ptf_main_copy = '". $this->ptf_main_copy ."'
				, ptf_client = '". $this->ptf_client ."'
				, ptf_client_show = '". $this->ptf_client_show ."'
				, ptf_manager = '". $this->ptf_manager ."'
				, ptf_manager2 = '". $this->ptf_manager2 ."'
				, ptf_manager3 = '". $this->ptf_manager3 ."'
				, ptf_manager4 = '". $this->ptf_manager4 ."'
				, ptf_manager_show = '". $this->ptf_manager_show ."'
				, ptf_manager_show2 = '". $this->ptf_manager_show2 ."'
				, ptf_manager_show3 = '". $this->ptf_manager_show3 ."'
				, ptf_manager_show4 = '". $this->ptf_manager_show4 ."'
				, ptf_campaign_year = '". $this->ptf_campaign_year ."'
				, ptf_campaign_month = '". $this->ptf_campaign_month ."'
				, ptf_content = '". $this->ptf_content ."'
				, ptf_use_yn = '". $this->ptf_use_yn ."'
				, ptf_list_thumb = '". $this->ptf_list_thumb ."'
				, ptf_title_img = '". $this->ptf_title_img ."'
				, ptf_award_thumb_json = '". $this->ptf_award_thumb_json ."'
				, ptf_youtube_json = '". $this->ptf_youtube_json ."'
				, ptf_img_json = '". $this->ptf_img_json ."'
				, ptf_rel_img_json = '". $this->ptf_rel_img_json ."'
				, reg_date = NOW()
				, mod_date = NOW()
				, mod_userid = '". $this->userid ."'
				, ptf_url = '". $this->ptf_url ."'
		";
		return $this->excute($query);
	}
	function update(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->ptf_list_thumb) $add_where .= ", ptf_list_thumb = '". $this->ptf_list_thumb ."'";
		if($this->ptf_title_img) $add_where .= ", ptf_title_img = '". $this->ptf_title_img ."'";
		if($this->ptf_award_thumb_json) $add_where .= ", ptf_award_thumb_json = '". $this->ptf_award_thumb_json ."'";
		if($this->ptf_img_json) $add_where .= ", ptf_img_json = '". $this->ptf_img_json ."'";
		if($this->ptf_rel_img_json) $add_where .= ", ptf_rel_img_json = '". $this->ptf_rel_img_json ."'";
		if($this->del_ptf_list_thumb) $add_where .= ", ptf_list_thumb = ''";
		if($this->del_ptf_title_img) $add_where .= ", ptf_title_img = ''";

		$query = "
			UPDATE gw_portfolio
			SET
				ptf_cd = '". $this->ptf_cd ."'
				, ptf_sort = '". $this->ptf_sort ."'
				, ptf_title = '". $this->ptf_title ."'
				, ptf_year = '". $this->ptf_year ."'
				, ptf_main_copy = '". $this->ptf_main_copy ."'
				, ptf_client = '". $this->ptf_client ."'
				, ptf_client_show = '". $this->ptf_client_show ."'
				, ptf_manager = '". $this->ptf_manager ."'
				, ptf_manager2 = '". $this->ptf_manager2 ."'
				, ptf_manager3 = '". $this->ptf_manager3 ."'
				, ptf_manager4 = '". $this->ptf_manager4 ."'
				, ptf_manager_show = '". $this->ptf_manager_show ."'
				, ptf_manager_show2 = '". $this->ptf_manager_show2 ."'
				, ptf_manager_show3 = '". $this->ptf_manager_show3 ."'
				, ptf_manager_show4 = '". $this->ptf_manager_show4 ."'
				, ptf_campaign_year = '". $this->ptf_campaign_year ."'
				, ptf_campaign_month = '". $this->ptf_campaign_month ."'
				, ptf_content = '". $this->ptf_content ."'
				, ptf_use_yn = '". $this->ptf_use_yn ."'
				, ptf_youtube_json = '". $this->ptf_youtube_json ."'
				, ptf_url = '". $this->ptf_url ."'
				, mod_date = NOW()
				, mod_userid = '". $this->mod_userid ."'

				{$add_where}
			WHERE idx = '". $this->idx ."'
		";
//		print_p($query);
		return $this->excute($query);
	}
	function update2(){
		if(!$this->idx) return false;

		$add_where = "";
		if($this->ptf_list_thumb) $add_where .= ", ptf_list_thumb = '". $this->ptf_list_thumb ."'";
		if($this->ptf_title_img) $add_where .= ", ptf_title_img = '". $this->ptf_title_img ."'";
		if($this->ptf_award_thumb_json) $add_where .= ", ptf_award_thumb_json = '". $this->ptf_award_thumb_json ."'";
		if($this->ptf_img_json) $add_where .= ", ptf_img_json = '". $this->ptf_img_json ."'";
		if($this->ptf_rel_img_json) $add_where .= ", ptf_rel_img_json = '". $this->ptf_rel_img_json ."'";
		if($this->del_ptf_list_thumb) $add_where .= ", ptf_list_thumb = ''";
		if($this->del_ptf_title_img) $add_where .= ", ptf_title_img = ''";

		$add_where = substr($add_where, 1);;

		$query = "
			UPDATE gw_portfolio
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
			SELECT * FROM gw_portfolio
			". $add_where ."
		";
		return $this->fetch_array_assoc_02($query);
	}
	function del()
	{
		if(!$this->idx) return false;

		$query = "DELETE FROM gw_portfolio WHERE idx = '". $this->idx ."'";
		return $this->excute($query);
	}
	function lists(&$totalcount)
	{
		$add_where = "WHERE 1=1";
		if($this->search_item && $this->search_word){
			if($this->search_item=='all'){
				$add_where .= " AND ( ptf_title LIKE '%$this->search_word%'";
				$add_where .= " OR ptf_client LIKE '%$this->search_word%' )";
			}else{
				$add_where .= " AND $this->search_item LIKE '%$this->search_word%'";
			}
		}
		if($this->ptf_use_yn){
			$add_where .= " AND ptf_use_yn = '". $this->ptf_use_yn ."'";
		}
		if($this->last_idx){
			$add_where .= " AND idx < ". $this->last_idx;
		}
		if($this->ptf_cd){
			$add_where .= " AND ptf_cd LIKE '%". $this->ptf_cd ."%'";
		}

		if(is_numeric($this->limit1) && is_numeric($this->limit2)){
			$add_limit = " LIMIT $this->limit1, $this->limit2";
		}
		$query = "
			SELECT COUNT(1) FROM gw_portfolio
			". $add_where ."
		";
		$totalcount = $this->fetch_row($query);

		if($this->next_idx){
			$query = "
				SELECT
					*
					, (SELECT idx FROM gw_portfolio ". $add_where ." ORDER BY ptf_sort ASC, ptf_campaign_year ASC, ptf_campaign_month ASC, idx ASC LIMIT 1) AS last_idx
				FROM gw_portfolio
				". $add_where ."
				ORDER BY ptf_sort DESC, ptf_campaign_year DESC, ptf_campaign_month DESC, idx DESC
			";
			$result = $this->fetch_array_assoc_01($query);

			for($i=0; $i<count($result); $i++){
				if($result[$i]['idx'] == $this->next_idx){
					return $result[$i+1];
				}
			}
		}else{
			$query = "
				SELECT
					*
					, (SELECT idx FROM gw_portfolio ". $add_where ." ORDER BY ptf_sort ASC, ptf_campaign_year ASC, ptf_campaign_month ASC, idx ASC LIMIT 1) AS last_idx
				FROM gw_portfolio
				". $add_where ."
				ORDER BY ptf_sort DESC, ptf_campaign_year DESC, ptf_campaign_month DESC, idx DESC
				". $add_limit ."
			";
		}

		return $this->fetch_array_assoc_01($query);
	}
	function init(){
		$this->idx = '';
		$this->ptf_cd = '';
		$this->ptf_sort = '';
		$this->ptf_title = '';
		$this->ptf_year = '';
		$this->ptf_main_copy = '';
		$this->ptf_client = '';
		$this->ptf_client_show = '';
		$this->ptf_manager = '';
		$this->ptf_manager2 = '';
		$this->ptf_manager3 = '';
		$this->ptf_manager4 = '';
		$this->ptf_manager_show = '';
		$this->ptf_manager_show2 = '';
		$this->ptf_manager_show3 = '';
		$this->ptf_manager_show4 = '';
		$this->ptf_campaign_year = '';
		$this->ptf_campaign_month = '';
		$this->ptf_content = '';
		$this->ptf_use_yn = '';
		$this->ptf_list_thumb = '';
		$this->ptf_title_img = '';
		$this->ptf_award_thumb_json = '';
		$this->ptf_youtube_json = '';
		$this->ptf_img_json = '';
		$this->ptf_rel_img_json = '';
		$this->reg_date = '';
		$this->limit1 = '';
		$this->limit2 = '';
		$this->search_item = '';
		$this->search_word = '';
		$this->del_ptf_list_thumb = '';
		$this->del_ptf_title_img = '';
		$this->mod_userid = '';
		$this->mod_date = '';
		$this->last_idx = '';
		$this->ptf_url = '';
		$this->next_idx = '';		
	}
}
?>