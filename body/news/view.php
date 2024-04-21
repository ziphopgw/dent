<div class="tit-wrap type-news">
	News
</div>

<div class="item-view type-news">
	<div class="item-view-body">
		<div class="item-view-info">
			<?
				$month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			?>
			<span class="date"><?=$month[(int)substr($row['reg_date'],5,2)-1]?> <?=substr($row['reg_date'],8,2)?>, <?=substr($row['reg_date'],0,4)?></span>
			<h2><?=$row['subject']?></h2>

			<div class="item-view-sns">
				<a href="javascript:sendSns('twitter', 'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx=<?=$row['idx']?>', '<?=$row['subject']?>')" class="ico-tw"><span class="hide"> twitter</span></a>
				<a href="javascript:sendSns('facebook', 'http://<?=$_SERVER[HTTP_HOST]?>', '<?=$row['subject']?>')" class="ico-fb"><span class="hide">facebook</span></a>
				<a href="javascript:copyToClipboard('http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx=<?=$row['idx']?>')" class="ico-lk"><span class="hide">link</span></a>
			</div>
		</div>

		<div class="item-view-cont">
			<!-- 내용 -->
			<?if($row['content_visual']){?>
				<div class="view-img">
					<img src="<?=$row['content_visual']?>" alt="">
				</div>
			<?}?>

			<div class="view-txt">
				<?=$row['content']?>
			</div>

			<div class="view-tag">
				<?for($i=0; $i<count($tags); $i++){?>
					<span><a href="/search.php?search_word=<?=$tags[$i]?>">#<?=$tags[$i]?></a></span>
				<?}?>
			</div>
		</div>
		<div class="btn-wrap">
			<a href="/news/list.php?search_word=<?=$search_word?>" class="btn-base">LIST</a>
		</div>
		<?if(count($relates) > 0){?>
				<div class="item-view-list">
					<div class="tit">Contents Related</div>
					<ul class="list-item">
						<?for($i=0; $i<count($relates); $i++){?>
							<li>
								<a href="/news/view.php?idx=<?=$relates[$i]['idx']?>&search_word=<?=$search_word?>">
									<div class="list-item-img">
										<img src="<?=$relates[$i]['list_thumb']?>" alt="">
									</div>
									<div class="list-item-info">
										<span class="n3"><?=$month[(int)substr($relates[$i]['reg_date'],5,2)-1]?> <?=substr($relates[$i]['reg_date'],8,2)?>, <?=substr($relates[$i]['reg_date'],0,4)?></span>
										<strong><i><?=$relates[$i]['subject']?></i></strong>
									</div>
								</a>
								<div class="list-item-sns">
									<a href="javascript:sendSns('twitter', 'http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx=<?=$relates[$i]['idx']?>', '<?=$relates[$i]['subject']?>')" class="ico-tw"><span class="hide"> twitter</span></a>
									<a href="javascript:sendSns('facebook', 'http://<?=$_SERVER[HTTP_HOST]?>', '<?=$relates[$i]['subject']?>')" class="ico-fb"><span class="hide">facebook</span></a>
									<a href="javascript:copyToClipboard('http://<?=$_SERVER[HTTP_HOST]?>/news/view.php?idx=<?=$relates[$i]['idx']?>')" class="ico-lk"><span class="hide">link</span></a>
								</div>
							</li>
						<?}?>
					</ul>
				</div>
		<?}?>

	</div>
	
</div>