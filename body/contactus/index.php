<div class="tit-wrap type-contact">
	Contact Us
</div>
<div class="inner-wrap type-contact">
	<div class="contact-info">
		<dl>
			<dt>덴츠코리아</dt>
			<dd>서울시 강남구 테헤란로 79길 6 (삼성동, JS타워 11층)</dd>
			<dd>11F, JS Tower, 6, Teheran-ro 79-gil, Gangnam-gu, Seoul, Korea</dd>
		</dl>
		<ul>
			<li>
				<span>Tel.</span> <b>+82 2 6005 0006</b>
			</li>
			<li>
				<span>Fax.</span> <b>+82 2 6005 0100</b>
			</li>
			<li>
				<span>Email.</span> <b>bumsuk.kim@dentsubrand.com</b>
			</li>
		</ul>
	</div>

	<div class="map-wrap">
		<!-- 지도 들어갈 자리 -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.033653632083!2d127.05446963707034!3d37.50712440725719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca4138eb989cf%3A0xc99d35c8cadf9093!2z64207Lig!5e0!3m2!1sko!2skr!4v1550374030691" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
</div>

<script> 
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