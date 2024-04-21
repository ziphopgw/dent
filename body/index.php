<div class="main-wrap">
					<div class="main-visual square-0">
						<div class="owl-carousel owl-theme" id="mainVs">
							<?for($i=0; $i<count($visuals); $i++){?>
								<div class="item">
									<?if($visuals[$i]['main_file']){?>
										<a href="<?=$visuals[$i]['main_link']?$visuals[$i]['main_link']:'javascript:;'?>" <?=$visuals[$i]['main_target']=='Y'?'target="blank_"':''?>>
											<video width="100%" controls="false" autoplay muted loop poster="<?=$visuals[$i]['main_img']?>">
												<source src="<?=$visuals[$i]['main_file']?>" type="video/mp4" />
											</video>
											<div class="main-visual-txt">
												<em><?=$visuals[$i]['main_title']?></em>
												<strong><?=$visuals[$i]['main_subtitle']?></strong>
											</div>
										</a>
									<?}else{?>
										<a href="<?=$visuals[$i]['main_link']?$visuals[$i]['main_link']:'javascript:;'?>" <?=$visuals[$i]['main_target']=='Y'?'target="blank_"':''?>><img src="<?=$visuals[$i]['main_img']?>" alt="" >
											<div class="main-visual-txt">
												<em><?=$visuals[$i]['main_title']?></em>
												<strong><?=$visuals[$i]['main_subtitle']?></strong>
											</div>
										</a>
									<?}?>
								</div>
							<?}?>
						</div>
						<div class="main-visual-num"></div>
					</div>
					
					<div class="main-row">
						<div class="main-img square-1" id="mImg1">
							<?for($i=0; $i<count($img_a); $i++){?>
								<a href="<?=$img_a[$i]['main_link']?$img_a[$i]['main_link']:'javascript:;'?>" <?=$img_a[$i]['main_target']=='Y'?'target="blank_"':''?> dsrc="<?=$img_a[$i]['main_link']?>" msrc="<?=$img_a[$i]['main_link']?>"><img src="<?=$img_a[$i]['main_img']?>" alt="" ></a>
							<?}?>
						</div>
						<div class="main-pof col-1 square-2">
							<div class="owl-carousel owl-theme" id="mPof1-1">
								<?for($i=0; $i<count($pf_at); $i++){?>
									<div class="item">
										<a href="<?=$pf_at[$i]['main_link']?$pf_at[$i]['main_link']:'javascript:;'?>" <?=$pf_at[$i]['main_target']=='Y'?'target="blank_"':''?>><img src="<?=$pf_at[$i]['main_img']?>" dsrc="<?=$pf_at[$i]['main_img']?>" msrc="<?=$pf_at[$i]['main_img']?>" alt=""></a>
									</div>
								<?}?>
							</div>
							
						</div>
						<div class="main-square main-news square-3">
							<h3>News</h3>
							<div class="owl-carousel owl-theme" id="mainNews">
								<?for($i=0; $i<count($news); $i++){?>
									<div class="item">
										<span class="news-date"><?=substr(date('F', $news[$i]['reg_date']), 0, 3)?> <?=substr($news[$i]['reg_date'], 8, 2)?>, <?=substr($news[$i]['reg_date'], 0, 4)?></span>
										<a href="/news/view.php?idx=<?=$news[$i]['idx']?>" style="word-break:break-word"><?=iconv_substr(strip_tags($news[$i]['content']), 0, 50, "utf-8")?></a>
									</div>
								<?}?>
							</div>
							<a href="/news/list.php" class="btn-more"><span class="hide">more</span></a>
						</div>
					</div>

					<div class="main-row">
						<div class="main-img square-4" id="mImg2">
							<?for($i=0; $i<count($img_c); $i++){?>
								<a href="<?=$img_c[$i]['main_link']?$img_c[$i]['main_link']:'javascript:;'?>" <?=$img_c[$i]['main_target']=='Y'?'target="blank_"':''?> dsrc="<?=$img_c[$i]['main_link']?>" msrc="<?=$img_c[$i]['main_link']?>"><img src="<?=$img_c[$i]['main_img']?>" alt="" ></a>
							<?}?>
						</div>
						<div class="main-pof col-2 square-5">
							<div class="owl-carousel owl-theme" id="mPof2-1">
								<?for($i=0; $i<count($pf_bt); $i++){?>
									<div class="item">
										<a href="<?=$pf_bt[$i]['main_link']?$pf_bt[$i]['main_link']:'javascript:;'?>" <?=$pf_bt[$i]['main_target']=='Y'?'target="blank_"':''?>><img src="<?=$pf_bt[$i]['main_img']?>" dsrc="<?=$pf_bt[$i]['main_img']?>" msrc="<?=$pf_bt[$i]['main_img']?>" alt=""></a>
									</div>
								<?}?>
							</div>
						</div>
					</div>

					<div class="main-row">
						<div class="main-img square-8" id="mImg4">
							<?for($i=0; $i<count($img_d); $i++){?>
								<a href="<?=$img_d[$i]['main_link']?$img_d[$i]['main_link']:'javascript:;'?>" <?=$img_d[$i]['main_target']=='Y'?'target="blank_"':''?> dsrc="<?=$img_d[$i]['main_link']?>" msrc="<?=$img_d[$i]['main_link']?>"><img src="<?=$img_d[$i]['main_img']?>" alt="" ></a>
							<?}?>
						</div>
						<div class="main-img square-7" id="mImg3">
							<?for($i=0; $i<count($img_b); $i++){?>
								<a href="<?=$img_b[$i]['main_link']?$img_b[$i]['main_link']:'javascript:;'?>" <?=$img_b[$i]['main_target']=='Y'?'target="blank_"':''?> dsrc="<?=$img_b[$i]['main_link']?>" msrc="<?=$img_b[$i]['main_link']?>"><img src="<?=$img_b[$i]['main_img']?>" alt="" ></a>
							<?}?>
						</div>
						<div class="main-pof col-1 square-6">
							<div class="owl-carousel owl-theme" id="mPof3-1">
								<?for($i=0; $i<count($pf_ab); $i++){?>
									<div class="item">
										<a href="<?=$pf_ab[$i]['main_link']?$pf_ab[$i]['main_link']:'javascript:;'?>" <?=$pf_ab[$i]['main_target']=='Y'?'target="blank_"':''?>><img src="<?=$pf_ab[$i]['main_img']?>" dsrc="<?=$pf_ab[$i]['main_img']?>" msrc="<?=$pf_ab[$i]['main_img']?>" alt=""></a>
									</div>
								<?}?>
							</div>
						</div>
					</div>

					<div class="main-row">
						<div class="main-pof col-2 square-9">
							<div class="owl-carousel owl-theme" id="mPof4-1">
								<?for($i=0; $i<count($pf_bb); $i++){?>
									<div class="item">
										<a href="<?=$pf_bb[$i]['main_link']?$pf_bb[$i]['main_link']:'javascript:;'?>" <?=$pf_bb[$i]['main_target']=='Y'?'target="blank_"':''?>><img src="<?=$pf_bb[$i]['main_img']?>" dsrc="<?=$pf_bb[$i]['main_img']?>" msrc="<?=$pf_bb[$i]['main_img']?>" alt=""></a>
									</div>
								<?}?>
							</div>
							
						</div>
						<div class="main-square main-client square-10">
							<h3>Client Portfolio</h3>
							<div class="owl-carousel owl-theme" id="mainClient">
								<?for($i=0; $i<count($clients); $i++){?>
									<div class="item">
										<a href="/business/client.php" target="blank_"><img src="<?=$clients[$i]['client_logo_main']?>" alt=""></a>
									</div>
								<?}?>
							</div>
							<a href="/business/client.php" class="btn-more"><span class="hide">more</span></a>
						</div>
					</div>
				</div>