<h3>메인 관리</h3>
<h4>메인 관리 리스트</h4>
<p style="color:red">메인에 노출되는 클라이언트는 `클라이언트 관리`에서 해주세요</p><br/>
<div id="tabs" style="background:#fff">
	<ul style="background:#fff">
		<li <?=$code=='visual'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=visual';">메인 비쥬얼 관리</a></li>
		<li <?=$code=='image'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=image';">메인 이미지 관리</a></li>
		<li <?=$code=='portfolio'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=portfolio';">메인 포트폴리오 관리</a></li>
	</ul>
</div>
<?if($code=='portfolio'){?>
	<div style="text-align:right">
		<select onchange="location.href='/admin/etc/main_list.php?code=<?=$code?>&search_main_sect='+this.value;">
			<option value="" <?=($search_main_sect=='')?'selected':''?>>구분</option>
			<option value="AT" <?=($search_main_sect=='AT')?'selected':''?>>A type(작은거) 상단</option>
			<option value="AB" <?=($search_main_sect=='AB')?'selected':''?>>A type(작은거) 하단</option>
			<option value="BT" <?=($search_main_sect=='BT')?'selected':''?>>B type(작은거) 상단</option>
			<option value="BB" <?=($search_main_sect=='BB')?'selected':''?>>B type(작은거) 하단</option>
		</select
	</div>
<?}?>
<div class="dts_gutter">
	<div class="dts_left">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td colspan="4" rowspan="2" bgcolor="#3caee7"><a href="/admin/etc/main_list.php?code=visual">메인 비주얼</a></td>
			<td bgcolor="#70b748"><a href="/admin/etc/main_list.php?code=image&search_main_sect=A">메인 이미지 A</a></td>
		  </tr>
		  <tr>
			<td bgcolor="#ee7850"><a href="/admin/etc/main_list.php?code=portfolio&search_main_sect=AT">메인 포폴<br>A type</a></td>
		  </tr>
		  <tr>
			<td bgcolor="#70b748"><a href="/admin/etc/main_list.php?code=image&search_main_sect=B">메인 이미지 B</a></td>
			<td colspan="2" bgcolor="#ee7850"><a href="/admin/etc/main_list.php?code=portfolio&search_main_sect=BT">메인 포폴<br>B type</a></td>
			<td bgcolor="#70b748"><a href="/admin/etc/main_list.php?code=image&search_main_sect=C">메인 이미지 C</a></td>
			<td bgcolor="#f8bf4c"><a href="#">뉴스(고정)</a></td>
		  </tr>
		  <tr>
			<td bgcolor="#f8bf4c"><a href="#">클라이언트(고정)</a></td>
			<td  bgcolor="#ee7850"><a href="/admin/etc/main_list.php?code=portfolio&search_main_sect=AB">메인 포폴<br>A type</a></td>
			<td bgcolor="#70b748"><a href="/admin/etc/main_list.php?code=image&search_main_sect=D">메인 이미지 D</a></td>
			<td colspan="2" bgcolor="#ee7850"><a href="/admin/etc/main_list.php?code=portfolio&search_main_sect=BB">메인 포폴<br>B type</a></td>
			</tr>
		</table>
	</div>
	<div class="dts_right">
		<div class="list">
			<?if($code=='visual'){?>
				<table>
					<colgroup>
						<col width="6%" />
						<col width="12%" />
						<col width="10%" />
						<col width="*" />
						<col width="8%" />
						<col width="8%" />
						<col width="8%" />
						<col width="8%" />
					</colgroup>
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">썸네일</th>
							<th scope="col">제목</th>
							<th scope="col">파일</th>
							<th scope="col">형식</th>
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
								<td class="gary"><?=$num?></td>
								<td>
									<?if($row['main_img']){?>
										<img src="<?=$row['main_img']?>" width="150" height="100" />
									<?}?>
								</td>
								<td><?=$row['main_title']?></td>
								<td>
										<?
											if(strrpos($row['main_file'], '/')!==false){
												echo substr($row['main_file'], strrpos($row['main_file'], '/')+1);
											}
											else echo $row['main_file'];
										?>
								</td>
								<td>
									<?
										if($row['main_file']){
											echo '영상';
										}else{
											if($row['main_img']){
												echo '이미지';
											}
										}
									?>
								<td><?=substr($row['mod_date'], 0, 16)?></td>
								<td><?=$row['main_use_yn']?></td>
								<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/etc/main_mod.php?idx=<?=$row['idx']?>&code=<?=$code?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
							</tr>
						<?}?>
					</tbody>
				</table>
			<?}else if($code=='image'){?>
				<table>
					<colgroup>
						<col width="6%" />
						<col width="12%" />
						<col width="*" />
						<col width="10%" />
						<col width="10%" />
						<col width="10%" />
						<col width="10%" />
					</colgroup>
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">썸네일</th>
							<th scope="col">내용</th>
							<th scope="col">구분</th>
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
								<td class="gary"><?=$num?></td>
								<td><img src="<?=$row['main_img']?>" width="150" height="100"></td>
								<td><?=$row['main_title']?></td>
								<td><?=$row['main_sect']?></td>
								<td><?=substr($row['mod_date'], 0, 16)?></td>
								<td><?=$row['main_use_yn']?></td>
								<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/etc/main_mod.php?idx=<?=$row['idx']?>&code=<?=$code?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
							</tr>
						<?}?>
					</tbody>
				</table>
			<?}else if($code=='portfolio'){?>
				<table>
					<colgroup>
						<col width="6%" />
						<col width="12%" />
						<col width="*" />
						<col width="10%" />
						<col width="10%" />
						<col width="10%" />
						<col width="10%" />
					</colgroup>
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">썸네일</th>
							<th scope="col">포트폴리오내용</th>
							<th scope="col">구분</th>
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
								<td class="gary"><?=$num?></td>
								<td><img src="<?=$row['main_img']?>" width="150" height="100"></td>
								<td><?=$row['main_title']?></td>
								<td>
									<?
										if($row['main_sect']=='AT') echo 'A type(작은거) 상단';
										else if($row['main_sect']=='AB') echo 'A type(작은거) 하단';
										else if($row['main_sect']=='BT') echo 'B type(작은거) 상단';
										else if($row['main_sect']=='BB') echo 'B type(작은거) 하단';
									?>
								</td>
								<td><?=substr($row['mod_date'], 0, 16)?></td>
								<td><?=$row['main_use_yn']?></td>
								<td><button type="button" class="btn btn-small" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/etc/main_mod.php?idx=<?=$row['idx']?>&code=<?=$code?>&startPage=<?=$startPage?><?=$querystring?>';">View</button></td>
							</tr>
						<?}?>
					</tbody>
				</table>
			<?}?>
		</div>

		<div class="paging">
			<? $page->common_admin( $totalPage, $totalList, $listScale, $pageScale, $startPage, $querystring);?>
		</div>

		<div class="btn_r">
				<button type="button" class="btn btn-write" onclick="location.href='<?=$ADMIN_VIEW_DIR?>/etc/main_mod.php?startPage=<?=$startPage?>&<?=$querystring?>';">등록</button>
		</div>
	</div>
</div>
<!--
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
-->
<script language="javascript">
$(document).ready(function(){
	$("#tabs").tabs();
});
</script>