<?
class Page {

	function common_admin( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring) {

		$prexImgName = '<img src="/admin/img/common/btn_prev.gif">';
		$nextImgName = '<img src="/admin/img/common/btn_next.gif" / >';
		$firstImgName = '<img src="/admin/img/common/btn_pprev.gif" / >';
		$lastImgName = '<img src="/admin/img/common/btn_nnext.gif" / >';
		$mv_data = $querystring;

		if( $totalList > $listScale ) {
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				echo "<a href='$_SERVER[PHP_SELF]?startPage=0&{$querystring}' class='pim'>$firstImgName</a>";
				echo "<a href='$_SERVER[PHP_SELF]?startPage={$prePage}&{$querystring}' class='pim'>$prexImgName</a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {

					if( $nextPage!= $startPage ) {
						echo "<a href='$_SERVER[PHP_SELF]?startPage={$nextPage}&{$querystring}'> $pageNum </a>";
					} else {
						echo "<a href='$_SERVER[PHP_SELF]?startPage={$nextPage}&{$querystring}' class='this'>$pageNum</a>";
					}
				}
			}

			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				echo "<a href='$_SERVER[PHP_SELF]?startPage={$nNextPage}&{$querystring}' class='pim2'>$nextImgName</a>";

				$nLastPage = (floor($totalList / $listScale) * $listScale) - $listScale;
				if($startPage < $nLastPage){
					echo "<a href='$_SERVER[PHP_SELF]?startPage={$nLastPage}&{$querystring}' class='pim2'>$lastImgName</a>";
				}
			}
		}

		if( $totalList <= $listScale) {
			echo "<b><font color='#000000' style='font-size:14px;'>1</font></b>";
		}
	}

	function common_front( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring) {

		$prexImgName = '<img src="/renew/admin/img/common/btn_prev.gif">';
		$nextImgName = '<img src="/renew/admin/img/common/btn_next.gif" / >';
		$firstImgName = '<img src="/renew/admin/img/common/btn_pprev.gif" / >';
		$lastImgName = '<img src="/renew/admin/img/common/btn_nnext.gif" / >';
		$mv_data = $querystring;

		if( $totalList > $listScale ) {
			if( $startPage+1 > $listScale*$pageScale ) {
				$prePage = $startPage - $listScale * $pageScale;
				echo "<a href='$_SERVER[PHP_SELF]?startPage=0&{$querystring}' class='first'></a>";
				echo "<a href='$_SERVER[PHP_SELF]?startPage={$prePage}&{$querystring}' class='prev'></a>";
			}

			for( $j=0; $j<$pageScale; $j++ ) {
				$nextPage = ($totalPage * $pageScale + $j) * $listScale;
				$pageNum = $totalPage * $pageScale + $j+1;
				if( $nextPage < $totalList ) {

					if( $nextPage!= $startPage ) {
						echo "<a href='$_SERVER[PHP_SELF]?startPage={$nextPage}&{$querystring}'> $pageNum </a>";
					} else {
						echo "<a href='$_SERVER[PHP_SELF]?startPage={$nextPage}&{$querystring}' class='active'>$pageNum</a>";
					}
				}
			}

			if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
				$nNextPage = ($totalPage+1) * $listScale * $pageScale;
				echo "<a href='$_SERVER[PHP_SELF]?startPage={$nNextPage}&{$querystring}' class='next'></a>";

				$nLastPage = (floor($totalList / $listScale) * $listScale) - $listScale;
				if($startPage < $nLastPage){
					echo "<a href='$_SERVER[PHP_SELF]?startPage={$nLastPage}&{$querystring}' class='last'></a>";
				}
			}
		}

		if( $totalList <= $listScale) {
			echo "<a href='javascript:;'>1</a>";
		}
	}

}
$page = new Page();
?>