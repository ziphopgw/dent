<h3>포트폴리오 관리</h3>
<h4>포트폴리오 리스트</h4>
<div class="list">
	<table>
		<colgroup>
			<col width="5%" />
			<col width="14%" />
			<col width="14%" />
			<col width="14%" />
			<col width="14%" />
			<col width="14%" />
			<col width="14%" />
			<col width="14%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">순서</th>
				<th scope="col">썸네일(리스트용)</th>
				<th scope="col">타이틀</th>
				<th scope="col">클라이언트</th>
				<th scope="col">대표파일</th>
				<th scope="col">업데이트</th>
				<th scope="col">사용유무</th>
				<th scope="col">Details</th>
			</tr>
		</thead>
		<tbody>
			<?for($i=0; $i<count($lists); $i++){
				$row = $lists[$i];
				$num = $totalList - (($nPAge*$listScale)+$i-$listScale);
			?>
				<tr>
					<td><?=$row['ptf_sort']?></td>
					<td><img src="<?=$row['ptf_title_img']?>" width="150" height="100"></td>
					<td><?=$row['ptf_title']?></td>
					<td><?=$row['ptf_client']?></td>
					<td><?=$row['ptf_title_img']?></td>
					<td><?=substr($row['mod_date'], 0, 16)?></td>
					<td><?=$row['ptf_use_yn']?></td>
					<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/portfolio/mod.php?idx=<?=$row['idx']?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
				</tr>
			<?}?>
		</tbody>
	</table>
</div>

<div class="paging">
	<? $page->common_admin( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring);?>
</div>


<div class="btn_r">
	<button type="button" class="btn btn-write" onclick="location.href='/admin/portfolio/mod.php';">등록</button>
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
			<option value="ptf_title" <?=($search_item=='ptf_title')?'selected':''?>>타이틀</option>
			<option value="ptf_client" <?=($search_item=='ptf_client')?'selected':''?>>클라이언트</option>
		</select>
		<input type="text" class="w20" name="search_word" value="<?=$search_word?>" />
		<button type="submit" class="btn btn-ssearch">검색</button>
	</div>
</form>