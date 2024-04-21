<h3>관리자 관리</h3>
<h4>관리자 <?=$idx?'수정':'등록'?></h4>
<div class="write">
	<form name="frm" id="frm" action="<?=$PHP_SELF?>" method="post">
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
				<th scope="col">관리자 ID</th>
				<td>
					<?if($idx){?>
						<?=$row['userid']?>
					<?}else{?>
						<input type="text" name="userid" class="w01" size="30" value="<?=$row['userid']?>" required />
					<?}?>
				</td>
			</tr>
			<tr>
				<th scope="col">관리자 비밀번호</th>
				<td>
					<input type="password" name="passwd" class="w01" size="30" value="" required />
					* 생성시와 변경시에만 입력
				</td>
			</tr>
			<tr>
				<th scope="col">관리자 소속</th>
				<td>
					<input type="text" name="user_group" class="w01" size="30" value="<?=$row['user_group']?>" required />
				</td>
			</tr>
			<tr>
				<th scope="col">메모</th>
				<td>
					<textarea name="note" style="width:90%"><?=$row['note']?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</div>

<div class="btn_c">
	<?if($idx && $row['admin_level'] != 100){?>
		<button type="button" class="btn btn-delete" onclick="del();">삭제</button>
	<?}?>
	<button type="button" class="btn btn-list" onclick="location.href='/admin/member/list.php?<?=$querystring?>';">취소</button>
	<button type="button" class="btn btn-modify" onclick="sendit();"> <?=$idx?'수정':'등록'?></button>
</div>

<script language="javascript">
function sendit(){
	if($('#command').val()=='insert'){
		if($('input[name=userid]').val()===''){
			alert('아이디를 입력하세요');
			$('input[name=userid]').focus();
			return false;
		}
		if($('input[name=passwd]').val()===''){
			alert('비밀번호를 입력하세요');
			$('input[name=passwd]').focus();
			return false;
		}
	}

	$('#frm')[0].submit();
}
function del(){
	if(confirm('정말로 삭제하시겠습니까?')){
		location.href = '/admin/member/mod.php?idx=<?=$idx?>&command=delete';
	}
}
</script>