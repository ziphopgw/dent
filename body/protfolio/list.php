<div class="tit-wrap type-portfolio">
	Our Works
</div>
<div class="inner-wrap mgt-xxxl">
	<div class="ui-tab" id="tabPortfolio">
		<div class="search-wrap">
			<input type="text" id="search_word" value="" onkeyup="if(event.keyCode==13){search();}">
			<button type="button" class="btn-search" onclick="search();"><span class="hide">검색</span></button>
		</div>
		<div class="ui-tab-btns">
			<button type="button" class="ui-tab-btn" onclick="changeCode('')"><i>All</i></button>
			<button type="button" class="ui-tab-btn" onclick="changeCode('TV')"><i>TV</i></button>
			<button type="button" class="ui-tab-btn" onclick="changeCode('Digital')"><i>Digital</i></button>
			<button type="button" class="ui-tab-btn" onclick="changeCode('Promotion')"><i>Promotion</i></button>
			<button type="button" class="ui-tab-btn" onclick="changeCode('OOH')"><i>OOH</i></button>
			<button type="button" class="ui-tab-btn" onclick="changeCode('Print')"><i>Print</i></button>
			
		</div>
		<div class="ui-tab-pnls">
			<section class="ui-tab-pnl">
				<ul class="list-item"></ul>
				<div class="btn-wrap">
					<button type="button" class="btn-listmore" onclick="lists();">More</button>
				</div>
			</section>
		</div>
	</div>

</div>

<script language="javascript">
$(document).ready(function(){
	lists();
});
var limit1 = 0;
var ptf_cd = '';
var searching = false;
function lists(search_word){
	if(!search_word) search_word = '';

	if(search_word) ptf_cd = '';

	if(!searching){
		searching = true;
		$.ajax({
			type: "post"
			, url: "/ajax/portfolios.php"
			, data: "&limit1="+limit1+"&ptf_cd="+ptf_cd+"&search_word="+search_word
			, success: function(res){
				searching = false;
				var list = JSON.parse(res);
				if(list.length == 0){
					var html = '<div class="list-none list-none-portfolio">';
					html += '	<p>검색된 항목이 없습니다.</p>';
					html += '</div>';

					$('.btn-listmore').hide();
					$('.list-item').append(html);
				}

				var html = '';
				var client = '';
				for(var i=0; i<list.length; i++){
					client = '';
					if(list[i].ptf_client_show == 'Y'){
						client = list[i].ptf_client;
					}
					html += '	<li>';
					html += '	<a href="/protfolio/view.php?idx='+ list[i].idx +'">';
					html += '		<div class="list-item-img">';
					html += '			<img src="'+ list[i].ptf_title_img +'" alt="'+ list[i].ptf_title +'">';
					html += '		</div>';
					html += '		<div class="list-item-info">';
					html += '			<span class="n1">'+ client +'</span>';
					html += '			<span class="n2"><b>'+ list[i].ptf_cd +'</b></span>';
					html += '			<strong><i>'+ list[i].ptf_title +'</i></strong>';
					html += '		</div>';
					html += '	</a>';
					html += '	<div class="list-item-sns">';
					html += '		<a href="javascript:sendSns(\'twitter\', \'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx='+ list[i].idx +'\', \''+ list[i].ptf_title +'\')" class="ico-tw"><span class="hide"> twitter</span></a>';
					html += '		<a href="javascript:sendSns(\'facebook\', \'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx='+ list[i].idx +'\', \''+ list[i].ptf_title +'\')" class="ico-fb"><span class="hide">facebook</span></a>';
					html += '		<a href="javascript:copyToClipboard(\'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx='+ list[i].idx +'\')" class="ico-lk"><span class="hide">link</span></a>';
					html += '	</div>';
					html += '</li>';
				}

				limit1 = limit1 + list.length;

				for(var i=0; i<list.length; i++){
					console.log(list[i].last_idx + '||' + list[i].idx);
					if(list[i].last_idx == list[i].idx){
						$('.btn-listmore').hide();
						break;
					}
				}

				$('.list-item').append(html);
			}
		});
	}
}

function changeCode(cd){
	last_idx = '';
	limit1 = 0;
	ptf_cd = cd;
	$('.list-item').html('');
	$('#search_word').val('');
	$('.btn-listmore').show();
	lists();
}
function search(){
	last_idx = '';
	limit1 = 0;
	$('.list-item').html('');
	$('.btn-listmore').show();
	lists($('#search_word').val());
}
;(function($, win, doc, undefined) {
	$(doc).ready(function(){
		$plugins.uiTab({ 
			id:'tabPortfolio', 
			current:0, 
			unres:true, 
			callback:tabPortfolioList 
		});
		function tabPortfolioList(v){
			console.log(v.current);
		}
	});
})(jQuery, window, document);
</script>