<h3>관리자 관리</h3>
<h4>관리자 리스트</h4>
<div class="list">
	<table>
		<colgroup>
			<col width="5%" />
			<col width="20%" />
			<col width="20%" />
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">아이디</th>
				<th scope="col">소속</th>
				<th scope="col">등록일</th>
				<th scope="col">최근 방문일</th>
				<th scope="col">Details</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?for($i=0; $i<count($lists); $i++){
				$row = $lists[$i];
				$num = $totalList - (($nPAge*$listScale)+$i-$listScale);
			?>
				<tr>
					<td class="gary"><?=$num?></td>
					<td><?=$row['userid']?></td>
					<td><?=$row['user_group']?></td>
					<td><?=substr($row['reg_date'], 0, 16)?></td>
					<td><?=substr($row['last_date'], 0, 16)?></td>
					<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/member/mod.php?idx=<?=$row['idx']?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
					<?if($row['admin_level'] == '100'){?>
						<td><span style="color:red">삭제불가</span></td>
					<?}else{?>
						<td><button type="button" class="btn btn-small" onclick="location.href='<?=$PHP_SELF?>?command=delete&idx=<?=$row['idx']?>&startPage=<?=$startPage?><?=$querystring?>';">삭제</button></td>
					<?}?>
				</tr>
			<?}?>
		</tbody>
	</table>
</div>

<div class="paging">
	<? $page->common_admin( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring);?>
</div>


<div class="btn_r">
	<button type="button" class="btn btn-write" onclick="location.href='/admin/member/mod.php';">등록</button>
	<!--
	  <button type="submit" class="btn btn-modify">수정</button>
	  <button type="submit" class="btn btn-list">목록</button>
	  <button type="submit" class="btn btn-write">등록</button>
	  <button type="submit" class="btn btn-delete">삭제</button>
	  -->
</div>


<form action="<?=$PHP_SELF?>" method="get">
	<div class="btn_c">
		<select name="search_item" class="w10">
			<option value="all" <?=($search_item=='all')?'selected':''?>>전체</option>
			<option value="userid" <?=($search_item=='userid')?'selected':''?>>아이디</option>
			<option value="name" <?=($search_item=='name')?'selected':''?>>이름</option>
		</select>
		<input type="text" class="w20" name="search_word" value="<?=$search_word?>" />
		<button type="submit" class="btn btn-ssearch">검색</button>
	</div>
</form>