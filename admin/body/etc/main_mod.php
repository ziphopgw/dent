<script src="/lib/ckeditor/ckeditor.js"></script>
<script src="/lib/ckeditor/js/sample.js"></script>
<link rel="stylesheet" href="/lib/ckeditor/css/samples.css">
<link rel="stylesheet" href="/lib/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">

<h3>메인관리</h3>
<h4>메인관리 <?=$idx?'수정':'등록'?></h4>

<div id="tabs" style="background:#fff">
	<ul style="background:#fff">
		<li <?=$code=='visual'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=visual';">메인 비쥬얼 관리</a></li>
		<li <?=$code=='image'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=image';">메인 이미지 관리</a></li>
		<li <?=$code=='portfolio'?'class="ui-tabs-active"':''?>><a href="javascript:;" onclick="location.href='/admin/etc/main_list.php?code=portfolio';">메인 포트폴리오 관리</a></li>
	</ul>
</div>

<div class="write">
	<form name="frm" id="frm" action="<?=$PHP_SELF?>" method="post" enctype='multipart/form-data'>
	<input type="hidden" name="command" id="command" value="<?=$idx?'update':'put'?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="search_item" value="<?=$search_item?>" />
	<input type="hidden" name="search_word" value="<?=$search_word?>" />
	<input type="hidden" name="startPage" value="<?=$startPage?>" />
	<input type="hidden" name="code" value="<?=$code?>" />
	<table>
		<colgroup>
			<col width="15%" />
			<col width="*" />
		</colgroup>
		<tbody>
			<?if($code=='visual'){?>
				<tr>
					<th scope="col">비주얼 노출 제목</th>
					<td>
						<input type="text" name="main_title" class="w01" size="80" value="<?=$row['main_title']?>" /><br/>
						<input type="text" name="main_subtitle" class="w01" size="80" value="<?=$row['main_subtitle']?>" />
					</td>
				</tr>
				<tr>
					<th scope="col">순서</th>
					<td>
						<input type="text" name="main_sort" class="w01" value="<?=$row['main_sort']?>" />
					</td>
				</tr>
				<tr>
					<th scope="col">이미지파일</th>
					<td>
						<input type="file" name="main_img" class="w01" size="50" value="" />(사이즈: 1120*560)
						<?if($row['main_img']){?>
							<br/><img src="<?=$row['main_img']?>"> <a href="javascript:del_file('main_img');">삭제</a>
						<?}?>
					</td>
				</tr>
				<tr>
					<th scope="col">영상파일</th>
					<td>
						<input type="file" name="main_file" class="w01" size="50" value="" />
						<?if($row['main_file']){?>
							<br/><?=substr($row['main_file'], strrpos($row['main_file'], '/')+1)?>&nbsp;<a href="javascript:del_file('main_file');">삭제</a>
						<?}?>
						<br>
						<br>ex) 동영상사이즈 : 1120 X 560 또는 같은 비율, 용량 : 20MB 이하
					</td>
				</tr>
			<?}else if($code=='image'){?>
				<tr>
					<th scope="col">이미지 내용</th>
					<td>
						<input type="text" name="main_title" class="w01" size="80" value="<?=$row['main_title']?>" />
					</td>
				</tr>
				<tr>
					<th scope="col">구분</th>
					<td>
						<input type="radio" name="main_sect" id="main_sect1" value="A" <?=$row['main_sect']=='A'?'checked':''?>><label for="main_sect1"> A(상단)</label>
						<input type="radio" name="main_sect" id="main_sect2" value="B" <?=$row['main_sect']=='B'?'checked':''?>><label for="main_sect2"> B(중간좌측)</label>
						<input type="radio" name="main_sect" id="main_sect3" value="C" <?=$row['main_sect']=='C'?'checked':''?>><label for="main_sect3"> C(중간우측)</label>
						<input type="radio" name="main_sect" id="main_sect4" value="D" <?=$row['main_sect']=='D'?'checked':''?>><label for="main_sect4"> D(하단)</label>
					</td>
				</tr>
				<tr>
					<th scope="col">이미지파일</th>
					<td>
						<input type="file" name="main_img" class="w01" size="50" value="" />(사이즈: 220*220)
						<?if($row['main_img']){?>
							<br/><img src="<?=$row['main_img']?>"> <a href="javascript:del_file('main_img');">삭제</a>
						<?}?>
					</td>
				</tr>
			<?}else if($code=='portfolio'){?>
				<tr>
					<th scope="col">포트폴리오 내용</th>
					<td>
						<input type="text" name="main_title" class="w01" size="80" value="<?=$row['main_title']?>" />
					</td>
				</tr>
				<tr>
					<th scope="col">구분</th>
					<td>
						<select name="main_sect">
							<option value="AT" <?=($row['main_sect']=='AT')?'selected':''?>>A type(작은거) 상단</option>
							<option value="AB" <?=($row['main_sect']=='AB')?'selected':''?>>A type(작은거) 하단</option>
							<option value="BT" <?=($row['main_sect']=='BT')?'selected':''?>>B type(작은거) 상단</option>
							<option value="BB" <?=($row['main_sect']=='BB')?'selected':''?>>B type(작은거) 하단</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="col">순서</th>
					<td>
						<input type="text" name="main_sort" class="w01" value="<?=$row['main_sort']?>" />
					</td>
				</tr>
				<tr>
					<th scope="col">이미지파일</th>
					<td>
						<input type="file" name="main_img" class="w01" size="50" value="" />(사이즈: A : 280*280 / B : 560*280)
						<?if($row['main_img']){?>
							<br/><img src="<?=$row['main_img']?>"> <a href="javascript:del_file('main_img');">삭제</a>
						<?}?>
					</td>
				</tr>
				<tr>
					<th scope="col">영상파일</th>
					<td>
						<input type="file" name="main_file" class="w01" size="50" value="" />
						<?if($row['main_file']){?>
							<br/><?=substr($row['main_file'], strrpos($row['main_file'], '/')+1)?>&nbsp;<a href="javascript:del_file('main_file');">삭제</a>
						<?}?>
						<br>
						<br>ex) 동영상사이즈 : 1120 X 560 또는 같은 비율, 용량 : 20MB 이하
					</td>
				</tr>
			<?}?>
			<tr>
				<th scope="col">링크 주소</th>
				<td colspan="3">
					<input type="text" name="main_link" class="w80" size="80" value="<?=$row['main_link']?>" required />
					<input type="checkbox" name="main_target" class="w01" value="Y" <?=($row['main_target']=='Y')?'checked':''?> /> 새창
				</td>
			</tr>
			<tr>
				<th scope="col">사용여부</th>
				<td colspan="3">
					<input type="radio" name="main_use_yn" id="main_use_yn1" value="Y" <?=$row['main_use_yn']=='Y' || !$row['ptf_use_yn']?'checked':''?>><label for="main_use_yn1"> 사용함</label>
					<input type="radio" name="main_use_yn" id="main_use_yn2" value="N" <?=$row['main_use_yn']=='N'?'checked':''?>><label for="main_use_yn2"> 미사용</label>
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
	<button type="button" class="btn btn-list" onclick="location.href='/admin/etc/main_list.php?code=<?=$code?>&<?=$querystring?>';">취소</button>
	<button type="button" class="btn btn-modify" onclick="sendit();"> <?=$idx?'수정':'등록'?></button>
</div>

<script language="javascript">
$(document).ready(function(){
	$("#tabs").tabs();
});
function sendit(){
	if(!$('input[name=main_title]').val()){
		alert('제목을 선택하세요');
		$('input[name=main_title]').focus();
		return false;
	}

	$('#frm')[0].submit();
}
function del(){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$_SERVER[PHP_SELF]?>?idx=<?=$idx?>&code=<?=$code?>&command=delete&<?=$querystring?>';
	}
}
function del_file(field){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$_SERVER[PHP_SELF]?>?command=del_file&idx=<?=$idx?>&code=<?=$code?>&field='+field+'&<?=$querystring?>';
	}
}
</script>