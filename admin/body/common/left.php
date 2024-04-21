<h1><img src="/admin/img/main/logo_sub.jpg" alt="웹사이트 관리자"></h1>
<div class="gnb_scroll">
<ul id="gnb">
<?if($_SESSION['ADMIN_LEVEL']==='100'){?>
	<li class="gnb_menu">
		<a href="/admin/member/list.php" class="btn_menu <?=((strpos($_SERVER['PHP_SELF'], '/admin/member/list.php')!==false || strpos($_SERVER['PHP_SELF'], '/admin/member/mod.php')!==false))?'active':''?>"><img src="<?=$IMG_ADMIN_DIR?>/gnb/icon_dashboard.png" alt="" class="icon">관리자 관리<!--<span class="arrow"></span>--></a>
	</li>
<?}?>
<li class="gnb_menu">
	<a href="/admin/portfolio/list.php" class="btn_menu <?=((strpos($_SERVER['PHP_SELF'], '/admin/portfolio/list.php')!==false || strpos($_SERVER['PHP_SELF'], '/admin/portfolio/mod.php')!==false))?'active':''?>"><img src="<?=$IMG_ADMIN_DIR?>/gnb/icon_02.png" alt="" class="icon">포트폴리오 관리<!--<span class="arrow"></span>--></a>
</li>
<li class="gnb_menu">
	<a href="/admin/bbs/list.php?code=news" class="btn_menu <?=($code=='news')?'active':''?>"><img src="<?=$IMG_ADMIN_DIR?>/gnb/icon_05.png" alt="" class="icon">뉴스 관리</a>
</li>
<li class="gnb_menu">
	<a href="/admin/bbs/list.php?code=client" class="btn_menu <?=($code=='client')?'active':''?>"><img src="<?=$IMG_ADMIN_DIR?>/gnb/icon_03.png" alt="" class="icon">클라이언트 관리<!--<span class="arrow"></span>--></a>
</li>
<li class="gnb_menu">
	<a href="/admin/etc/main_list.php" class="btn_menu <?=((strpos($_SERVER['PHP_SELF'], '/admin/etc/main_list.php')!==false || strpos($_SERVER['PHP_SELF'], '/admin/etc/main_mod.php')!==false))?'active':''?>"><img src="<?=$IMG_ADMIN_DIR?>/gnb/icon_04.png" alt="" class="icon">메인 관리<!--<span class="arrow"></span>--></a>
</li>
</ul>
</div>