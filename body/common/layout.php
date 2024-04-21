<!doctype html>
<html lang="ko">
<head>
	<?include $_template['header']?>
</head>



<body>
	<div class="base-skip" id="baseSkip"></div>
	<div class="base-layer" id="baseLayer"></div>

	<div class="base-wrap" id="baseWrap">
		<header class="base-header" id="baseHeader"></header>

		<div class="base-body" id="baseBody">
			<main role="main" class="base-main <?=($PHP_SELF=='/business/client.php')?'type-client':''?>" id="baseMain">
				<?include $_template['body']?>
			</main>
		</div>

		<footer class="base-footer" id="baseFooter"></footer>
	</div>

	<script> 
	;(function($, win, doc, undefined) {
		$(doc).ready(function(){
			setTimeout(function(){
				$('body').addClass('ready');
			},10)

			$('#mainVs').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				//autoHeight:true,
				autoplay:true,
				smartSpeed: 900,
				onInitialized  : counter, 
                onTranslated : counter,
				responsive:{
					0:{
						items:1
					}
				}
			});


			function counter(event) {
                var element   = event.target;      
                var items     = event.item.count; 
                var item      = event.item.index - 1; 
            
                if(item > items) {
                    item = item - items
                }
                $('.main-visual-num').html('<b>'+ item +'</b><span> / '+ items +'</span>');
            }

			$('#mainNews').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:6000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('#mPof1-1').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:6000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('#mPof2-1').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:6000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('#mPof3-1').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:6000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('#mPof4-1').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:6000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('#mainClient').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				autoplay:true,
				autoplayTimeout:7000,
				smartSpeed: 900,
				responsive:{
					0:{
						items:1
					}
				}
			});
			
		});
	})(jQuery, window, document);
	</script>

	<script language="javascript">
	function sendSns(sns, url, txt)
	{
		var o;

		if(!url) url = document.URL;
		if(!txt) txt = 'dentsu KOREA';

		var _url = url;
		var _txt = encodeURIComponent(txt);
		var _br  = encodeURIComponent('\r\n');

		switch(sns)
		{
			case 'facebook':
				o = {
					method:'popup',
					url:'http://www.facebook.com/sharer/sharer.php?u=' + _url
				};
				break;
	 
			case 'twitter':
				o = {
					method:'popup',
					url:'http://twitter.com/intent/tweet?text=' + _txt + '&url=' + _url
				};
				break;
	 
			case 'me2day':
				o = {
					method:'popup',
					url:'http://me2day.net/posts/new?new_post[body]=' + _txt + _br + _url + '&new_post[tags]=epiloum'
				};
				break;
	 
			case 'kakaotalk':
				o = {
					method:'web2app',
					param:'sendurl?msg=' + _txt + '&url=' + _url + '&type=link&apiver=2.0.1&appver=2.0&appid=dev.epiloum.net&appname=' + encodeURIComponent('Epiloum 개발노트'),
					a_store:'itms-apps://itunes.apple.com/app/id362057947?mt=8',
					g_store:'market://details?id=com.kakao.talk',
					a_proto:'kakaolink://',
					g_proto:'scheme=kakaolink;package=com.kakao.talk'
				};
				break;
	 
			case 'kakaostory':
				o = {
					method:'web2app',
					param:'posting?post=' + _txt + _br + _url + '&apiver=1.0&appver=2.0&appid=dev.epiloum.net&appname=' + encodeURIComponent('Epiloum 개발노트'),
					a_store:'itms-apps://itunes.apple.com/app/id486244601?mt=8',
					g_store:'market://details?id=com.kakao.story',
					a_proto:'storylink://',
					g_proto:'scheme=kakaolink;package=com.kakao.story'
				};
				break;
	 
			case 'band':
				o = {
					method:'web2app',
					param:'create/post?text=' + _txt + _br + _url,
					a_store:'itms-apps://itunes.apple.com/app/id542613198?mt=8',
					g_store:'market://details?id=com.nhn.android.band',
					a_proto:'bandapp://',
					g_proto:'scheme=bandapp;package=com.nhn.android.band'
				};

			case 'line':
				o = {
					method:'popup',
					url:"http://line.me/R/msg/text/?" + encodeURIComponent(_txt) + " " + encodeURIComponent(_url)
				};
				break;
	 
		

			default:
				alert('지원하지 않는 SNS입니다.');
				return false;
		}
	 
		switch(o.method)
		{
			case 'popup':
				window.open(o.url, '', 'width=600, height=500');
				break;
	 
			case 'web2app':
				if(navigator.userAgent.match(/android/i))
				{
					// Android
					setTimeout(function(){ location.href = 'intent://' + o.param + '#Intent;' + o.g_proto + ';end'}, 100);
				}
				else if(navigator.userAgent.match(/(iphone)|(ipod)|(ipad)/i))
				{
					// Apple
					setTimeout(function(){ location.href = o.a_store; }, 200);          
					setTimeout(function(){ location.href = o.a_proto + o.param }, 100);
				}
				else
				{
					alert('이 기능은 모바일에서만 사용할 수 있습니다.');
				}
				break;
		}
	}
	function copyToClipboard(val) {
		var t = document.createElement("textarea");
		document.body.appendChild(t);
		t.value = val;
		t.select();
		document.execCommand('copy');
		document.body.removeChild(t);
		alert('링크가 복사되었습니다.');
	}
	</script>
</body>
</html>
