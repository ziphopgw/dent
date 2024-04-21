<script src="/lib/ckeditor/ckeditor.js"></script>
<script src="/lib/ckeditor/js/sample.js"></script>
<link rel="stylesheet" href="/lib/ckeditor/css/samples.css">
<link rel="stylesheet" href="/lib/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">

<form name="frm" id="frm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="idx" value="<?=$idx?>" />
<input type="hidden" name="command" value="<?=($idx)?'update':'put'?>" />
<input type="hidden" name="search_item" value="<?=$search_item?>" />
<input type="hidden" name="search_word" value="<?=$search_word?>" />
<input type="hidden" name="search_category_idx" value="<?=$search_category_idx?>" />
<input type="hidden" name="startPage" value="<?=$startPage?>" />
<input type="hidden" name="code" value="<?=$code?>" />
<h3>뉴스 관리</h3>
<h4>뉴스 <?=$idx?'수정':'등록'?></h4>
<div class="write">
	<table>
		<colgroup>
			<col width="10%" />
			<col width="*" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="col">구분</th>
				<td>
					<input type="checkbox" name="is_notice" class="w01" size="80" value="Y" <?=($row['is_notice']=='Y')?'checked':''?> /> 중요상단고정&nbsp;&nbsp;
					<input type="text"name="notice_start_date" id="notice_start_date" size="10" value="<?=substr($row['notice_end_date'],0,10)?>">
					<span>~</span>
					<input type="text"name="notice_end_date" id="notice_end_date" size="10" value="<?=substr($row['notice_end_date'],0,10)?>">
				</td>
			</tr>
			<tr>
				<th scope="col">뉴스등록 날짜</th>
				<td colspan="3">
					<input type="text" name="reg_date" id="reg_date" size="10" value="<?=substr($row['reg_date'], 0, 10)?>">
				</td>
			</tr>
			<tr>
				<th scope="col">리스트용 썸네일</th>
				<td colspan="3">
					<input type="file" name="file1" class="w01" size="30" value="" />(사이즈: 660*330)
					<?if($list_thumb){?>
						<br/><img src="<?=$list_thumb['filename']?>">
						&nbsp;<a href="javascript:del_file(<?=$list_thumb['idx']?>);" style="text-decoration:underline;">삭제</a><br/>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">제목</th>
				<td><input type="text" name="subject" class="w01" size="80" value="<?=$row['subject']?>" required /></td>
			</tr>
			<tr>
				<th scope="col">본문 Key 비주얼</th>
				<td colspan="3">
					<input type="file" name="file2" class="w01" size="30" value="" />(사이즈: 1000*세로@)
					<?if($content_visual){?>
						<br/><img src="<?=$content_visual['filename']?>">
						&nbsp;<a href="javascript:del_file(<?=$content_visual['idx']?>);" style="text-decoration:underline;">삭제</a><br/>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">내용</th>
				<td scope="col">
					<textarea name="content" id="content" rows="10" cols="50" required><?=replace_content($row['content'])?></textarea>
				</td>
			</tr>
			<script>
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('content', {
					width: '90%'
					, height: 350
				});
			</script>
			<tr>
				<th scope="col">태그</th>
				<td>
					<input type="text" name="tag" class="w01" size="80" value="<?=$row['tag']?>" required  placeholder="콤마로 구분하세요" />
				</td>
			</tr>
			<tr>
				<th scope="col">메인노출 여부</th>
				<td>
					<input type="checkbox" name="is_show_main" class="w01" size="80" value="Y" <?=($row['is_show_main']=='Y')?'checked':''?> /> 메인 노출
				</td>
			</tr>
			<tr>
				<th scope="col">사용여부</th>
				<td colspan="3">
					<input type="radio" name="is_show" id="is_show1" value="Y" <?=$row['is_show']=='Y' ||$row['is_show']==''?'checked':''?>><label for="is_show1"> 사용함</label>
					<input type="radio" name="is_show" id="is_show2" value="N" <?=$row['is_show']=='N'?'checked':''?>><label for="is_show2"> 사용안함</label>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="btn_c">
	<?if($idx){?>
		<button type="button" class="btn btn-modify" onclick="sendit();">수정</button>
		<button type="button" class="btn btn-delete" onclick="del();">삭제</button>
	<?}else{?>
		<button type="button" class="btn btn-write" onclick="sendit();">등록</button>
	<?}?>
	<button type="button" class="btn btn-list" onclick="location.href='/admin/bbs/list.php?<?=$querystring?>';">목록</button>
</div>
</form>

<script language="javascript">
$(document).ready(function()
{
	$("#notice_start_date, #notice_end_date, #reg_date").datepicker({
		changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
		changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
		minDate: '-1y', // 현재날짜로부터 100년이전까지 년을 표시한다.
		nextText: '다음 달', // next 아이콘의 툴팁.
		prevText: '이전 달', // prev 아이콘의 툴팁.
		showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다. 
		currentText: '오늘 날짜' , // 오늘 날짜로 이동하는 버튼 패널
		closeText: '닫기',  // 닫기 버튼 패널
		dateFormat: "yy-mm-dd", // 텍스트 필드에 입력되는 날짜 형식.
		showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], // 요일의 한글 형식.
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식
		minDate: new Date(2012, 1 - 1, 1),
	});
});
function sendit(){
	if($('input[name=subject]').val() === ''){
		alert('제목을 입력하세요');
		$('input[name=subject]').focus();
	//}else if(CKEDITOR.instances.content.getData() === ''){
		//alert('내용을 입력하세요');
		//CKEDITOR.instances.content.focus();
	}else{
		$('#frm')[0].submit();
	}
}
function del(){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '<?=$PHP_SELF?>?idx=<?=$idx?>&command=del&search_item=<?=$search_item?>&search_word=<?=$search_word?>&search_category_idx=<?=$search_category_idx?>&startPage=<?=$startPage?>&code=<?=$code?>';
	}
}
function del_file(file_idx){
	if(confirm('선택한 파일을 삭제하시겠습니까?')){
		location.href = '<?=$PHP_SELF?>?idx=<?=$idx?>&command=del_file&search_item=<?=$search_item?>&search_word=<?=$search_word?>&search_category_idx=<?=$search_category_idx?>&startPage=<?=$startPage?>&code=<?=$code?>&file_idx='+file_idx;
	}
}
</script>