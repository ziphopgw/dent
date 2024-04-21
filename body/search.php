<div class="tit-wrap type-search">
	Search
</div>
<div class="inner-wrap type-search">
	<div class="search-wrap">
		<div class="search-inp">
			<input type="text" id="search_word" value="<?=$search_word?>" onkeyup="if(event.keyCode==13){search();}">
			<button type="button" class="btn-search" onclick="search();"><span class="hide">검색</span></button>
		</div>
		<p class="search-txt">총 <b id="total_cnt">0</b> 건의 항목이 검색되었습니다. <span class="m-block">(Portfolio <b id="portfolio_cnt">0</b> 건, News <b id="news_cnt">0</b> 건)</span></p>
	</div>
	
	<section class="search-result">
		<h3>Portfolio <b id="portfolio_cnt2">0</b></h3>
		<div class="list-none list-none-portfolio" style="display:none">
			<p>검색된 항목이 없습니다.</p>
		</div>
		<ul class="list-item list-portfolio"></ul>
	</section>

<!-- 	<div class="btn-wrap"> -->
<!-- 		<button type="button" class="btn-listmore btn-listmore-portfolio">More</button> -->
<!-- 	</div> -->

	<section class="search-result type-news">
		<h3>News <b id="news_cnt2">0</b></h3>
		<div class="list-none list-none-news" style="display:none">
			<p>검색된 항목이 없습니다.</p>
		</div>
		<ul class="list-item list-news"></ul>
	</section>

<!-- 	<div class="btn-wrap"> -->
<!-- 		<button type="button" class="btn-listmore btn-listmore-news">More</button> -->
<!-- 	</div> -->


</div>

<script language="javascript">
$(document).ready(function(){
	<?if($search_word){?>
		search();
	<?}?>
});
var last_portfolio_idx = '';
var last_news_idx = '';
var searching = false;
function search(){
	last_portfolio_idx = '';
	last_news_idx = '';

	if(!searching){
		searching = true;

		$('.list-item').html('');

		var search_word = $('#search_word').val();

		$.ajax({
			type: "post"
			, url: "/ajax/search.php"
			, data: "&last_portfolio_idx="+last_portfolio_idx+"&last_news_idx="+last_news_idx+"&search_word="+search_word
			, success: function(res){
				var data = JSON.parse(res);
				var portfolios = data.portfolios;
				var news = data.news;
				var total_cnt = portfolios.length + news.length;
				searching = false;

				$('#total_cnt').text(total_cnt);
				$('#portfolio_cnt, #portfolio_cnt2').text(portfolios.length);
				$('#news_cnt, #news_cnt2').text(news.length);

				if(portfolios.length > 0 ){
					$('.list-none-portfolio').hide();
				}
				if(portfolios.length == 0 ){
					$('.list-none-portfolio').show();
				}

	//			if(portfolios.length != 10){
	//				$('.btn-listmore-portfolio').hide();
	//			}

				for(var i=0; i<portfolios.length; i++){
					var html = '<li>';
					html += '	<a href="/protfolio/view.php?idx='+ portfolios[i].idx +'">';
					html += '		<div class="list-item-img">';
					html += '			<img src="'+ portfolios[i].ptf_title_img +'" alt="'+ portfolios[i].ptf_title +'">';
					html += '		</div>';
					html += '		<div class="list-item-info">';
					html += '			<span class="n1"></span>';
					html += '			<span class="n2">'+ portfolios[i].ptf_year +'. <b>'+ portfolios[i].ptf_cd +'</b></span>';
					html += '			<strong><i>'+ portfolios[i].ptf_title +'</i></strong>';
					html += '		</div>';
					html += '	</a>';
					html += '	<div class="list-item-sns">';
					html += '		<a href="javascript:sendSns(\'twitter\', \'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx='+ portfolios[i].idx +'\', \''+ portfolios[i].ptf_title +'\')" class="ico-tw"><span class="hide"> twitter</span></a>';
					html += '		<a href="javascript:sendSns(\'facebook\', \'http://<?=$_SERVER[HTTP_HOST]?>\', \''+ portfolios[i].ptf_title +'\')" class="ico-fb"><span class="hide">facebook</span></a>';
					html += '		<a href="javascript:copyToClipboard(\'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx='+ portfolios[i].idx +'\')" class="ico-lk"><span class="hide">link</span></a>';
					html += '	</div>';
					html += '</li>';

					$('.list-portfolio').append(html);

					if(i==portfolios.length-1){
						last_portfolio_idx = portfolios[i].idx;
					}
				}

				if(news.length > 0 ){
					$('.list-none-news').hide();
				}
				if(news.length == 0 ){
					$('.list-none-news').show();
				}

	//			if(portfolios.length != 10){
	//				$('.btn-listmore-news').hide();
	//			}

				for(var i=0; i<news.length; i++){
					var html = '<li>';
					var dt = new Date(news[i].reg_date.substring(0, 10));
					var y = dt.getFullYear();
					var m = dt.getMonth();
					var d = dt.getDate();

					var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

					html += '	<a href="/news/view.php?idx='+ news[i].idx +'&search_word='+ search_word +'">';
					html += '		<div class="list-item-img">';
					html += '			<img src="'+ news[i].list_thumb +'" alt="'+ news[i].subject +'">';
					html += '		</div>';
					html += '		<div class="list-item-info">';
					html += '			<span class="n3">'+ month[m] +' '+ d +', '+ y +'</span>';
					html += '			<strong><i>'+ news[i].subject +'</i></strong>';
					html += '		</div>';
					html += '	</a>';
					html += '	<div class="list-item-sns">';
					html += '		<a href="javascript:sendSns(\'twitter\', \'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx='+ news[i].idx +'\', \''+ news[i].subject +'\')" class="ico-tw"><span class="hide"> twitter</span></a>';
					html += '		<a href="javascript:sendSns(\'facebook\', \'http://<?=$_SERVER[HTTP_HOST]?>\', \''+ news[i].subject +'\')" class="ico-fb"><span class="hide">facebook</span></a>';
					html += '		<a href="javascript:copyToClipboard(\'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx='+ news[i].idx +'\')" class="ico-lk"><span class="hide">link</span></a>';
					html += '	</div>';
					html += '</li>';

					$('.list-news').append(html);

					if(i==news.length-1){
						last_news_idx = news[i].idx;
					}
				}
			}
		});
	}
}
</script>