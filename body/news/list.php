<div class="tit-wrap type-news">
	News
</div>
<div class="inner-wrap mgt-xxxl type-news">
	<div class="search-wrap">
		<input type="text" id="search_word" value="<?=$search_word?>" onkeyup="if(event.keyCode==13){search();}">
		<button type="button" class="btn-search" onclick="search();"><span class="hide">검색</span></button>
	</div>

	<ul class="list-item"></ul>

	<div class="btn-wrap">
		<button type="button" class="btn-listmore">More</button>
	</div>


</div>

<script language="javascript">
$(document).ready(function(){
	lists('<?=$search_word?>');
});
var limit1 = 0;
var searching = false;
function lists(search_word){
	if(!search_word) search_word = '';
	if(!searching){
		searching = true;
		$.ajax({
			type: "post"
			, url: "/ajax/news.php"
			, data: "&limit1="+limit1+"&search_word="+search_word
			, success: function(res){
				searching = false;

				var lists = JSON.parse(res);

				if(lists.length == 0 ){
					var html = '<div class="list-none list-none-portfolio">';
					html += '		<p>검색된 항목이 없습니다.</p>';
					html += '	</div>';
					$('.list-item').append(html);
					return;
				}

				for(var i=0; i<lists.length; i++){
					var html = '<li>';
					var dt = new Date(lists[i].reg_date.substr(0, 10));
					var y = dt.getFullYear();
					var m = dt.getMonth();
					var d = dt.getDate();

					var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

					html += '	<a href="/news/view.php?idx='+ lists[i].idx +'&search_word='+ search_word +'">';
					html += '		<div class="list-item-img">';
					html += '			<img src="'+ lists[i].list_thumb +'" alt="'+ lists[i].subject +'">';
					html += '		</div>';
					html += '		<div class="list-item-info">';
					html += '			<span class="n3">'+ month[m] +' '+ d +', '+ y +'</span>';
					html += '			<strong><i>'+ lists[i].subject +'</i></strong>';
					html += '		</div>';
					html += '	</a>';
					html += '	<div class="list-item-sns">';
					html += '		<a href="javascript:sendSns(\'twitter\', \'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx='+ lists[i].idx +'\', \''+ lists[i].subject +'\')" class="ico-tw"><span class="hide"> twitter</span></a>';
					html += '		<a href="javascript:sendSns(\'facebook\', \'http://<?=$_SERVER[HTTP_HOST]?>\', \''+ lists[i].subject +'\')" class="ico-fb"><span class="hide">facebook</span></a>';
					html += '		<a href="javascript:copyToClipboard(\'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx='+ lists[i].idx +'\')" class="ico-lk"><span class="hide">link</span></a>';
					html += '	</div>';
					html += '</li>';

					$('.list-item').append(html);
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
}
function search(){
	last_idx = '';
	$('.list-item').html('');
	lists($('#search_word').val());
}
</script>