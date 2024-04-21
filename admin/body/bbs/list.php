<h3>뉴스 관리</h3>
<h4>뉴스 리스트</h4>
<div class="list">
	<table>
		<colgroup>
			<col width="6%" />
			<col width="8%" />
			<col width="12%" />
			<col width="*" />
			<col width="8%" />
			<col width="8%" />
			<col width="8%" />
			<col width="8%" />
			<col width="8%" />
			<col width="8%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">유형</th>
				<th scope="col">리스트 썸네일</th>
				<th scope="col">제목</th>
				<th scope="col">작성자</th>
				<th scope="col">등록일</th>
				<th scope="col">태그</th>
				<th scope="col">조회수</th>
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
					<td><?=$row['is_notice']=='Y'?'중요<br/>상단고정':'일반'?></td>
					<td><img src="<?=$row['list_thumb']?>" width="150" height="100"></td>
					<td style="text-align:left;"><?=$row['subject']?></td>
					<td><?=$row['name']?></td>
					<td><?=substr($row['reg_date'], 0, 10)?></td>
					<td><?=$row['tag']?></td>
					<td><?=$row['hit']?></td>
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
			<option value="all" <?=($search_item=='all')?'selected':''?>>전체</option>
			<option value="name" <?=($search_item=='name')?'selected':''?>>이름</option>
			<option value="subject" <?=($search_item=='subject')?'selected':''?>>제목</option>
			<option value="content" <?=($search_item=='content')?'selected':''?>>내용</option>
		</select>
		<input type="text" class="w20" name="search_word" value="<?=$search_word?>" />
		<button type="submit" class="btn btn-ssearch">검색</button>
	</div>
</form>