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
<h3>클라이언트 관리</h3>
<h4>클라이언트 <?=$idx?'수정':'등록'?></h4>
<div class="write">
	<table>
		<colgroup>
			<col width="10%" />
			<col width="*" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="col">클라이언트명</th>
				<td><input type="text" name="subject" class="w01" size="80" value="<?=$row['subject']?>" required /></td>
			</tr>
			<tr>
				<th scope="col">순서</th>
				<td><input type="text" name="sort" class="w01" size="10" value="<?=$row['sort']?>" required /></td>
			</tr>
			<tr>
				<th scope="col">클라이언트 로고<br>(PC용)</th>
				<td colspan="3">
					<input type="file" name="file1" class="w01" size="30" value="" />(사이즈: 220*220)
					<?if($client_logo_pc){?>
						<br/><img src="<?=$client_logo_pc['filename']?>">
						&nbsp;<a href="javascript:del_file(<?=$client_logo_pc['idx']?>);" style="text-decoration:underline;">삭제</a><br/>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">클라이언트 로고<br>(모바일용)</th>
				<td colspan="3">
					<input type="file" name="file2" class="w01" size="30" value="" />(사이즈: 220*220)
					<?if($client_logo_mobile){?>
						<br/><img src="<?=$client_logo_mobile['filename']?>">
						&nbsp;<a href="javascript:del_file(<?=$client_logo_mobile['idx']?>);" style="text-decoration:underline;">삭제</a><br/>
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">홈페이지 URL</th>
				<td>
					<input type="text" name="homepage" class="w01" size="80" value="<?=$row['homepage']?>" required  />
					<br>http://를 url 앞에 입력해주세요
				</td>
			</tr>
			<tr>
				<th scope="col">메인노출 여부</th>
				<td>
					<input type="checkbox" name="is_notice" class="w01" size="80" value="Y" <?=($row['is_notice']=='Y')?'checked':''?> /> 메인 노출
				</td>
			</tr>
			<tr>
				<th scope="col">메인노출 이미지</th>
				<td colspan="3">
					<input type="file" name="file3" class="w01" size="30" value="" />(사이즈: 220*220)
					<?if($client_logo_main){?>
						<br/><img src="<?=$client_logo_main['filename']?>">
						&nbsp;<a href="javascript:del_file(<?=$client_logo_main['idx']?>);" style="text-decoration:underline;">삭제</a><br/>
					<?}?>
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
	$("#notice_start_date, #notice_end_date").datepicker({
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