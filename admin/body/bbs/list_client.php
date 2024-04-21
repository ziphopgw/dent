<h3>클라이언트 관리</h3>
<h4>클라이언트 리스트</h4>
<div class="list">
	<table>
		<colgroup>
			<col width="6%" />
			<col width="6%" />
			<col width="12%" />
			<col width="10%" />
			<col width="*" />
			<col width="8%" />
			<col width="8%" />
			<col width="8%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">순서</th>
				<th scope="col">클라이언트 로고</th>
				<th scope="col">클라이언트명</th>
				<th scope="col">홈페이지 URL</th>
				<th scope="col">메인 노출</th>
				<th scope="col">등록일</th>
				<th scope="col">Details</th>
			</tr>
		</thead>
		<tbody>
			<?for($i=0; $i<count($lists); $i++){
				$row = $lists[$i];
				$num = $totalList - (($nPAge*$listScale)+$i-$listScale);
			?>
				<tr>
					<td class="gary"><?=$num?></td>
					<td><?=$row['sort']?></td>
					<td><img src="<?=$row['client_logo_pc']?>" width="150" height="100"></td>
					<td style="text-align:left;"><?=$row['subject']?></td>
					<td><?=$row['name']?></td>
					<td><?=$row['is_notice']?></td>
					<td><?=substr($row['reg_date'], 0, 16)?></td>
					<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/bbs/write.php?idx=<?=$row['idx']?>&code=<?=$code?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
				</tr>
			<?}?>
		</tbody>
	</table>
</div>

<div class="paging">
	<? $page->common_admin( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring);?>
</div>

<div class="btn_r">
		<button type="button" class="btn btn-write" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/bbs/write.php?startPage=<?=$startPage?>&<?=$querystring?>';">등록</button>
</div>

<form action="<?=$PHP_SELF?>" method="get">
	<input type="hidden" name="code" value="<?=$code?>" />
	<div class="btn_c">
		<select name="search_item" class="w10">
			<option value="subject" <?=($search_item=='subject')?'selected':''?>>클라이언트</option>
		</select>
		<input type="text" class="w20" name="search_word" value="<?=$search_word?>" />
		<button type="submit" class="btn btn-ssearch">검색</button>
	</div>
</form>