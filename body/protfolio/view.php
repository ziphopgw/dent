<div class="item-view" style="background-image:url(<?=$row['ptf_title_img']?>)">
	<div class="item-view-head">
		<h2><?=$row['ptf_title']?></h2>
	</div>
	<div class="item-view-body">
		<div class="item-view-info">
			<dl>
				<?if($row['ptf_client_show']=='Y'){?>
					<dt>CLIENT</dt>
					<dd><?=$row['ptf_client']?></dd>
				<?}?>
				<?if($row['ptf_campaign_year']){?>
					<dt>DATE</dt>
					<dd>
						<?=$row['ptf_campaign_year']?>
						<?if($row['ptf_campaign_month']){
							if($row['ptf_campaign_month']<10) echo '0'.$row['ptf_campaign_month'];
							else echo $row['ptf_campaign_month'];
						}?>
					</dd>
				<?}?>
				<?$arr_ptf_award_thumb = json_decode($row['ptf_award_thumb_json']);?>
				<?if(count($arr_ptf_award_thumb)>0){?>
					<dt>AWARDS</dt>
					<dd>
						<?for($i=0; $i<count($arr_ptf_award_thumb); $i++){?>
							<span><img src="<?=$arr_ptf_award_thumb[$i]->img?>" alt=""><?=$arr_ptf_award_thumb[$i]->award?></span>
						<?}?>
					</dd>
				<?}?>
				<?if($row['ptf_manager'] && $row['ptf_manager_show']=='Y'){?>
					<dt>The person in charge</dt>
					<dd>
						<?
							$person = '';
							if($row['ptf_manager'] && $row['ptf_manager_show']=='Y'){
								echo $row['ptf_manager'];
							}
//							if($row['ptf_manager2'] && $row['ptf_manager_show2']=='Y'){
//								if($person) $person .=', '.$row['ptf_manager2'];
//								else $person .=$row['ptf_manager2'];
//							}
//							if($row['ptf_manager3'] && $row['ptf_manager_show3']=='Y'){
//								if($person) $person .=', '.$row['ptf_manager3'];
//								else $person .=$row['ptf_manager3'];
//							}
//							if($row['ptf_manager4'] && $row['ptf_manager_show4']=='Y'){
//								if($person) $person .=', '.$row['ptf_manager4'];
//								else $person .=$row['ptf_manager4'];
//							}
							echo $person;
						?>
					</dd>
				<?}?>
			</dl>
			<?if($row['ptf_url']){?>
				<a href="<?=$row['ptf_url']?>" class="btn-website" target="blank_">VIEW WEB SITE</a>
			<?}?>
			<div class="item-view-sns">
				<a href="javascript:sendSns('twitter', 'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx=<?=$row['idx']?>', '<?=$row['ptf_title']?>')" class="ico-tw"><span class="hide"> twitter</span></a>
				<a href="javascript:sendSns('facebook', 'http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx=<?=$row['idx']?>', '<?=$row['ptf_title']?>')" class="ico-fb"><span class="hide">facebook</span></a>
				<a href="javascript:copyToClipboard('http://<?=$_SERVER[HTTP_HOST]?>/protfolio/view.php?idx=<?=$row['idx']?>')" class="ico-lk"><span class="hide">link</span></a>
			</div>
		</div>
		<div class="item-view-cont">
			<!-- 내용 -->

			<div class="view-txt view-txt1">
				<?=$row['ptf_main_copy']?>
			</div>

			<?$arr_ptf_img = json_decode($row['ptf_img_json']);?>
			<?for($i=0; $i<count($arr_ptf_img); $i++){?>
				<div class="view-img">
					<img src="<?=$arr_ptf_img[$i]->img?>" alt="">
				</div>
			<?}?>

			<?$arr_ptf_youtube = json_decode($row['ptf_youtube_json']);?>
			<?for($i=0; $i<count($arr_ptf_youtube); $i++){?>
				<?if($arr_ptf_youtube[0]!=''){?>
					<div class="view-move">
						<iframe width="100%" height="100%" id="vod-iframe" src="<?=$arr_ptf_youtube[$i]?>?enablejsapi=1&amp;showinfo=0&amp;rel=0"  frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
				<?}?>
			<?}?>

			<div class="view-txt">
				<?=$row['ptf_content']?>
			</div>

			<?$ptf_rel_img_json = json_decode($row['ptf_rel_img_json']);?>
			<?for($i=0; $i<count($ptf_rel_img_json); $i++){?>
				<div class="view-img">
					<img src="<?=$ptf_rel_img_json[$i]->img?>" alt="">
				</div>
			<?}?>
		</div>

		<?if($next_row['idx']){?>
			<div class="item-view-link">
				<div class="tit">Next</div>
				<a href="<?=$PHP_SELF?>?idx=<?=$next_row['idx']?>">
					<?if($next_row['ptf_client_show']=='Y'){?>
						<span><?=$next_row['ptf_client']?></span>
					<?}?>
					<strong><i><?=$next_row['ptf_title']?></i></strong>
				</a>
			</div>
		<?}?>

	</div>
	
</div>