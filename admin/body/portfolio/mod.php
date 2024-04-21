<script src="/lib/ckeditor/ckeditor.js"></script>
<script src="/lib/ckeditor/js/sample.js"></script>
<link rel="stylesheet" href="/lib/ckeditor/css/samples.css">
<link rel="stylesheet" href="/lib/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">

<h3>포드폴리오 관리</h3>
<h4>포트폴리오 <?=$idx?'수정':'등록'?></h4>
<div class="write">
	<form name="frm" id="frm" action="<?=$PHP_SELF?>" method="post" enctype='multipart/form-data'>
	<input type="hidden" name="command" id="command" value="<?=$idx?'update':'put'?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="search_item" value="<?=$search_item?>" />
	<input type="hidden" name="search_word" value="<?=$search_word?>" />
	<input type="hidden" name="startPage" value="<?=$startPage?>" />
	<table>
		<colgroup>
			<col width="15%" />
			<col width="*" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="col">포트폴리오 유형</th>
				<td>
					<input type="checkbox" name="ptf_cd[]" id="ptf_cd1" value="TV" <?=in_array('TV', $arr_ptf_cd)?'checked':''?>><label for="ptf_cd1"> TV</label>
					<input type="checkbox" name="ptf_cd[]" id="ptf_cd4" value="Digital" <?=in_array('Digital', $arr_ptf_cd)?'checked':''?>><label for="ptf_cd4"> Digital</label>
					<input type="checkbox" name="ptf_cd[]" id="ptf_cd5" value="Promotion" <?=in_array('Promotion', $arr_ptf_cd)?'checked':''?>><label for="ptf_cd5"> Promotion</label>
					<input type="checkbox" name="ptf_cd[]" id="ptf_cd3" value="OOH" <?=in_array('OOH', $arr_ptf_cd)?'checked':''?>><label for="ptf_cd3"> OOH</label>
					<input type="checkbox" name="ptf_cd[]" id="ptf_cd2" value="Print" <?=in_array('Print', $arr_ptf_cd)?'checked':''?>><label for="ptf_cd2"> Print</label>
					
				</td>
				<th scope="col">포트폴리오 순서</th>
				<td>
					<input type="text" name="ptf_sort" class="w01" value="<?=$row['ptf_sort']?>" />
				</td>
			</tr>
			<!--
			<tr>
				<th scope="col">리스트용 썸네일</th>
				<td colspan="3">
					<input type="file" name="ptf_list_thumb" class="w01" size="30" value="" />(사이즈: 660*330)
					<?if($row['ptf_list_thumb']){?>
						<br/><img src="<?=$row['ptf_list_thumb']?>"> <a href="javascript:del_file('ptf_list_thumb');">삭제</a>
					<?}?>
				</td>
			</tr>
			-->
			<tr>
				<th scope="col">타이틀 이미지</th>
				<td colspan="3">
					<input type="file" name="ptf_title_img" class="w01" size="30" value="" />(사이즈: 가로 2000 (16:9 이미지 권장))
					<?if($row['ptf_title_img']){?>
						<br/><img src="<?=$row['ptf_title_img']?>"> <a href="javascript:del_file('ptf_title_img');">삭제</a>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">타이틀</th>
				<td colspan="3">
					<input type="text" name="ptf_title" class="w80" size="30" value="<?=$row['ptf_title']?>" required />
				</td>
			</tr>
			<!--
			<tr>
				<th scope="col">포트폴리오 년도</th>
				<td colspan="3">
					<select name="ptf_year" style="width:100px;">
						<option value="">년</option>
						<?for($i=1980; $i<=date('Y')+6; $i++){?>
							<option value="<?=$i?>" <?=($i==$row['ptf_year'])?'selected':''?>><?=$i?>년</option>
						<?}?>
					</select>
				</td>
			</tr>
			-->
			<tr>
				<th scope="col">수상명 및 썸네일</th>
				<td colspan="3" id="cont_ptf_award">
					<?if($idx){
						$arr_ptf_award_thumb = json_decode($row['ptf_award_thumb_json']);
						if(count($arr_ptf_award_thumb) == 0){
							echo '
							<div>
								<input type="text" name="ptf_award[]" class="w01" size="30" value="" required />
								<input type="file" name="ptf_award_thumb[]" class="w01" size="30" value="" />(사이즈: 가로@*32) 
								<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_award_plus">+</button> 
							</div>
							';
						}
						for($i=0; $i<count($arr_ptf_award_thumb); $i++){
							$award_row = $arr_ptf_award_thumb[$i];
					?>
							<div>
								<?=$award_row->award?>
								<?if($i==0){?>
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_award_plus">+</button> 
								<?}?>
								<button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="del_file_json('ptf_award_thumb_json', '<?=$i?>');">-</button>
								<?if($award_row->img){?>
									<img src="<?=$award_row->img?>">
								<?}?>
							</div>
						<?}?>
					<?}else{?>
						<div>
							<input type="text" name="ptf_award[]" class="w01" size="30" value="" required />
							<input type="file" name="ptf_award_thumb[]" class="w01" size="30" value="" />(사이즈: 가로@*32) 
							<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_award_plus">+</button> 
						</div>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">상단 내용</th>
				<td colspan="3">
					<textarea name="ptf_main_copy" id="ptf_main_copy" rows="10" cols="50" required><?=replace_content($row['ptf_main_copy'])?></textarea>
				</td>
			</tr>
			<script>
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('ptf_main_copy', {
					width: '90%'
					, height: 350
				});
			</script>
			<tr>
				<th scope="col">광고영상(Main)<br/>유튜브URL</th>
				<td colspan="3" id="cont_ptf_youtube">
					<?if($row['ptf_youtube_json']){
						$arr_ptf_youtube = json_decode($row['ptf_youtube_json']);
						if(count($arr_ptf_youtube) == 0){
							echo '
								<div>
									<input type="text" name="ptf_youtube[]" class="w80" size="30" value="" placeholder="https://www.youtube.com/embed/xxxxx" required /> 
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_youtube_plus">+</button> 
								</div>
							';
						}
						for($i=0; $i<count($arr_ptf_youtube); $i++){
							$youtube_row = $arr_ptf_youtube[$i];
					?>
							<div>
								<input type="text" name="ptf_youtube[]" class="w80" size="30" value="<?=$youtube_row?>" required placeholder="https://www.youtube.com/embed/xxxxx" /> 
								<?if($i==0){?>
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_youtube_plus">+</button> 
								<?}?>
								<button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="$(this).parent().remove()">-</button>
							</div>
						<?}?>
					<?}else{?>
						<div>
							<input type="text" name="ptf_youtube[]" class="w80" size="30" value="" required placeholder="https://www.youtube.com/embed/xxxxx" /> 
							<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_youtube_plus">+</button> 
						</div>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">광고이미지(Main)</th>
				<td colspan="3" id="cont_ptf_img">
					<?if($idx){
						$arr_ptf_img = json_decode($row['ptf_img_json']);
						if(count($arr_ptf_img) == 0){
							echo '
								<div>
									<input type="file" name="ptf_img[]" class="w01" size="30" value="" />(사이즈: 가로 1220 (16:9 이미지 권장)) 
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_img_plus">+</button> 
								</div>
							';
						}
						for($i=0; $i<count($arr_ptf_img); $i++){
							$img_row = $arr_ptf_img[$i];
							if(count($arr_ptf_youtube) == 0){
								echo '
								<div>
									<input type="file" name="ptf_img[]" class="w01" size="30" value="" />(사이즈: 가로 1220 (16:9 이미지 권장)) 
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_img_plus">+</button> 
								</div>
								';
							}
					?>
							<div>
								<?if($i==0){?>
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_img_plus">+</button> 
								<?}?>
								<button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="del_file_json('ptf_img_json', '<?=$i?>');">-</button>
								<?if($img_row->img){?>
									<br/><img src="<?=$img_row->img?>">
								<?}?>
							</div>
						<?}?>
					<?}else{?>
						<div>
							<input type="file" name="ptf_img[]" class="w01" size="30" value="" />(사이즈: 가로 1220 (16:9 이미지 권장)) 
							<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_img_plus">+</button> 
						</div>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">클라이언트</th>
				<td colspan="3">
					<input type="text" name="ptf_client" class="w01" size="30" value="<?=$row['ptf_client']?>" /> 
					<input type="radio" name="ptf_client_show" id="ptf_client_show1" value="Y" <?=$row['ptf_client_show']=='Y'?'checked':''?>><label for="ptf_client_show1"> 노출함</label>
					<input type="radio" name="ptf_client_show" id="ptf_client_show2" value="N" <?=$row['ptf_client_show']=='N'?'checked':''?>><label for="ptf_client_show2"> 노출안함</label>
				</td>
			</tr>
			<tr>
				<th scope="col">캠페인 담당자</th>
				<td colspan="3">
					<input type="text" name="ptf_manager" class="w01" size="30" value="<?=$row['ptf_manager']?>" /> 
					<input type="radio" name="ptf_manager_show" id="ptf_manager_show1_1" value="Y" <?=$row['ptf_manager_show']=='Y'?'checked':''?>><label for="ptf_manager_show1_1"> 노출함</label>
					<input type="radio" name="ptf_manager_show" id="ptf_manager_show1_2" value="N" <?=$row['ptf_manager_show']=='N'?'checked':''?>><label for="ptf_manager_show1_2"> 노출안함</label><br/>
					<!--
					<input type="text" name="ptf_manager2" class="w01" size="30" value="<?=$row['ptf_manager2']?>" /> 
					<input type="radio" name="ptf_manager_show2" id="ptf_manager_show2_1" value="Y" <?=$row['ptf_manager_show2']=='Y'?'checked':''?>><label for="ptf_manager_show2_1"> 노출함</label>
					<input type="radio" name="ptf_manager_show2" id="ptf_manager_show2_2" value="N" <?=$row['ptf_manager_show2']=='N'?'checked':''?>><label for="ptf_manager_show2_2"> 노출안함</label><br/>
					<input type="text" name="ptf_manager3" class="w01" size="30" value="<?=$row['ptf_manager3']?>" /> 
					<input type="radio" name="ptf_manager_show3" id="ptf_manager_show3_1" value="Y" <?=$row['ptf_manager_show3']=='Y'?'checked':''?>><label for="ptf_manager_show3_1"> 노출함</label>
					<input type="radio" name="ptf_manager_show3" id="ptf_manager_show3_2" value="N" <?=$row['ptf_manager_show3']=='N'?'checked':''?>><label for="ptf_manager_show3_2"> 노출안함</label><br/>
					<input type="text" name="ptf_manager4" class="w01" size="30" value="<?=$row['ptf_manager4']?>" /> 
					<input type="radio" name="ptf_manager_show4" id="ptf_manager_show4_1" value="Y" <?=$row['ptf_manager_show4']=='Y'?'checked':''?>><label for="ptf_manager_show4_1"> 노출함</label>
					<input type="radio" name="ptf_manager_show4" id="ptf_manager_show4_2" value="N" <?=$row['ptf_manager_show4']=='N'?'checked':''?>><label for="ptf_manager_show4_2"> 노출안함</label><br/>
					-->
				</td>
			</tr>
			<tr>
				<th scope="col">캠페인 온에어</th>
				<td colspan="3">
					<select name="ptf_campaign_year" style="width:100px;">
						<option value="">년</option>
						<?for($i=2017; $i<=date('Y'); $i++){?>
							<option value="<?=$i?>" <?=($i==$row['ptf_campaign_year'])?'selected':''?>><?=$i?>년</option>
						<?}?>
					</select>
					<select name="ptf_campaign_month" style="width:100px;">
						<option value="">월</option>
						<?for($i=1; $i<=12; $i++){?>
							<option value="<?=$i?>" <?=($i==$row['ptf_campaign_month'])?'selected':''?>><?=$i?>월</option>
						<?}?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="col">세부내용</th>
				<td colspan="3">
					<textarea name="ptf_content" id="ptf_content" rows="10" cols="50" required><?=replace_content($row['ptf_content'])?></textarea>
				</td>
			</tr>
			<script>
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('ptf_content', {
					width: '90%'
					, height: 350
				});
			</script>
			<tr>
				<th scope="col">광고이미지(Sub)</th>
				<td colspan="3" id="cont_ptf_rel_img">
					<?if($idx){
						$arr_ptf_rel_img = json_decode($row['ptf_rel_img_json']);
						if(count($arr_ptf_rel_img) == 0){
							echo '
								<div>
									<input type="file" name="ptf_rel_img[]" class="w01" size="30" value="" />가로 600 (16:9 이미지 권장) 
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_rel_img_plus">+</button> 
								</div>
							';
						}
						for($i=0; $i<count($arr_ptf_rel_img); $i++){
							$rel_img_row = $arr_ptf_rel_img[$i];
					?>
							<div>
								<?if($i==0){?>
									<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_rel_img_plus">+</button> 
								<?}?>
								<button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="del_file_json('ptf_rel_img_json', '<?=$i?>');">-</button>
								<?if($rel_img_row->img){?>
									<br/><img src="<?=$rel_img_row->img?>">
								<?}?>
							</div>
						<?}?>
					<?}else{?>
						<div>
							<input type="file" name="ptf_rel_img[]" class="w01" size="30" value="" />가로 600 (16:9 이미지 권장) 
							<button type="button" class="btn btn-modify" style="padding:2px 9px" id="btn_ptf_rel_img_plus">+</button> 
						</div>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">사이트 URL</th>
				<td colspan="3">
					<input type="text" name="ptf_url" class="w80" size="30" value="<?=$row['ptf_url']?>" required />
				</td>
			</tr>
			<tr>
				<th scope="col">사용여부</th>
				<td colspan="3">
					<input type="radio" name="ptf_use_yn" id="ptf_use_yn1" value="Y" <?=$row['ptf_use_yn']=='Y'?'checked':''?>><label for="ptf_use_yn1"> 사용함</label>
					<input type="radio" name="ptf_use_yn" id="ptf_use_yn2" value="N" <?=$row['ptf_use_yn']=='N'?'checked':''?>><label for="ptf_use_yn2"> 사용안함</label>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</div>

<div class="btn_c">
	<?if($idx){?>
		<button type="button" class="btn btn-delete" onclick="del();">삭제</button>
	<?}?>
	<button type="button" class="btn btn-list" onclick="location.href='/admin/portfolio/list.php?<?=$querystring?>';">취소</button>
	<button type="button" class="btn btn-modify" onclick="sendit();"> <?=$idx?'수정':'등록'?></button>
</div>

<script language="javascript">
$(document).ready(function(){
	$('#btn_ptf_award_plus').click(function(){
		$('#cont_ptf_award').append('<div><input type="text" name="ptf_award[]" class="w01" size="30" value="" required /> <input type="file" name="ptf_award_thumb[]" class="w01" size="30" value="" />(사이즈: 가로@*32) <button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="$(this).parent().remove()">-</button> </div>');
	});
	$('#btn_ptf_img_plus').click(function(){
		$('#cont_ptf_img').append('<div><input type="file" name="ptf_img[]" class="w01" size="30" value="" />(사이즈: 가로 1220 (16:9 이미지 권장))  <button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="$(this).parent().remove()">-</button> </div>');
	});
	$('#btn_ptf_rel_img_plus').click(function(){
		$('#cont_ptf_rel_img').append('<div><input type="file" name="ptf_rel_img[]" class="w01" size="30" value="" />가로 600 (16:9 이미지 권장) <button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="$(this).parent().remove()">-</button> </div>');
	});
	$('#btn_ptf_youtube_plus').click(function(){
		$('#cont_ptf_youtube').append('<div><input type="text" name="ptf_youtube[]" class="w80" size="30" value="" required placeholder="https://www.youtube.com/embed/xxxxx" /> <button type="button" class="btn btn-delete" style="padding:2px 9px" onclick="$(this).parent().remove()">-</button> </div>');
	});
});
function sendit(){
//	if(!$('input[name=ptf_sort]').val()){
//		alert('포트폴리오 순서을 선택하세요');
//		$('input[name=ptf_sort]').focus();
//		return false;
//	}
	if(!$('input[name=ptf_title]').val()){
		alert('타이틀을 선택하세요');
		$('input[name=ptf_title]').focus();
		return false;
	}
	if(!$('input[name=ptf_use_yn]:checked').val()){
		alert('사용여부를 선택하세요');
		return false;
	}

	$('#frm')[0].submit();
}
function del(){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$_SERVER[PHP_SELF]?>?idx=<?=$idx?>&command=delete&search_item=<?=$search_item?>&search_word=<?=$search_word?>&search_category_idx=<?=$search_category_idx?>&startPage=<?=$startPage?>';
	}
}
function del_file(field){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$_SERVER[PHP_SELF]?>?command=del_file&idx=<?=$idx?>&field='+field+'&search_item=<?=$search_item?>&search_word=<?=$search_word?>&search_category_idx=<?=$search_category_idx?>&startPage=<?=$startPage?>';
	}
}
function del_file_json(field, i){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$_SERVER[PHP_SELF]?>?command=del_file_json&idx=<?=$idx?>&field='+field+'&index='+i+'&search_item=<?=$search_item?>&search_word=<?=$search_word?>&search_category_idx=<?=$search_category_idx?>&startPage=<?=$startPage?>';
	}
}
</script>