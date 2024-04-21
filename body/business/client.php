<div class="tit-wrap type-business">
	Client Portfolio
</div>
<div class="inner-wrap type-client">
	<ul class="list-client"></ul>
	<div class="btn-wrap">
<!-- 		<button type="button" class="btn-listmore" onclick="lists();">More</button> -->
	</div>
</div>

<script language="javascript">
$(document).ready(function(){
	lists();
});
var limit1 = 0;
function lists(){
	$.ajax({
		type: "post"
		, url: "/ajax/clients.php"
		, data: "&limit1="+limit1
		, success: function(res){
			var lists = JSON.parse(res);

			for(var i=0; i<lists.length; i++){
				if(lists[i].homepage){
					var atag = '<a href="'+ lists[i].homepage +'" target="blank_">';
				}else{
					var atag = '<a href="javascript:;">';
				}
				<?if(isMobile()){?>
					$('.list-client').append('<li class="fadeinup active">'+ atag +'<img src="'+ lists[i].client_logo_mobile +'" alt="'+ lists[i].subject +'"></a></li>');
				<?}else{?>
					$('.list-client').append('<li class="fadeinup active">'+ atag +'<img src="'+ lists[i].client_logo_pc +'" alt="'+ lists[i].subject +'"></a></li>');
				<?}?>
			}

			limit1 = limit1 + lists.length;

			for(var i=0; i<lists.length; i++){
				if(lists[i].last_idx == lists[i].idx){
					$('.btn-listmore').hide();
					break;
				}
			}
		}
	});
}
</script>