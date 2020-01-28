<?php
$is_index = true;
include_once('layout/header.php')
?>
<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
	<div class="ws_images">
		<ul>
			<?php
			$get_data_slide = $connect->query("SELECT A.*,B.username as name
					FROM tbl_certificates as A
					LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
					WHERE A.type='9' ORDER BY A.index ASC");
			$i = 0;
			while ($row_slide = mysqli_fetch_object($get_data_slide)) {
				echo '<li><a href="#"><img src="img/certificate/' . $row_slide->{'profile'} . '" alt="img' . $row_slide->id . '" title="' . $row_slide->{'title_' . $lang} . '" id="wows1_' . $i++ . '" /></a></li>';
			}
			?>
		</ul>
	</div>
	<div class="ws_shadow"></div>
</div>

<div class="strip_bg">
	<br><br>
	<br><br>
	<br><br>
	<div class="vc_row-fluid container">
		<div class="row">
			<div class="wpb_column vc_column_container vc_col-sm-6">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="widget-text-heading  default">
							<!-- <h3 class="title"> <span><?= $lang_text['hp_welcome'][$lang] ?></span> <?= $row_website_config->{'hp_title_' . $lang}  ?> </h3> -->
							<h3 class="title"> <?= $row_website_config->{'hp_title_' . $lang}  ?> </h3>
						</div>
						<div class="vc_empty_space" style="height: 10px"><span class="vc_empty_space_inner"></span></div>

						<div class="wpb_text_column wpb_content_element ">
							<div class="wpb_wrapper">
								<p class="welcome_text"><?= $row_website_config->{'hp_description_' . $lang}  ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wpb_column vc_column_container vc_col-sm-6">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wpb_gallery wpb_content_element vc_clearfix">
							<div class="wpb_wrapper">
								<div class="tlp-portfolio">
									<div class="tlp-portfolio-item">
										<div class="tlp-item">
											<div style="box-shadow: 0px 0px 3px #444;">
												<div class="tlp-overlay">
													<a class="tlp-zoom cboxElement" href="img/home_page/<?= $row_website_config->{'hp_image'} ?>">
														<img width="100%" src="img/home_page/<?= $row_website_config->{'hp_image'} ?>" alt="<?= $row_website_config->keywords ?>" />
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</div>
<div class="container">
	<div class="row">
		<div class="clearfix"></div>
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="vc_empty_space" style="height: 68px"><span class="vc_empty_space_inner"></span></div>
					<div class="widget-text-heading  default">
						<div class="visible-xs">
							<br>
						</div>
						<!-- <h3 class="title"><span><?= $row_website_config->{'feature_prefix_' . $lang} ?></span> <?= $row_website_config->{'feature_title_' . $lang} ?> </h3> -->
						<h3 class="title"> <?= $row_website_config->{'feature_title_' . $lang} ?> </h3>
					</div>
					<div class="vc_empty_space" style="height: 10px"><span class="vc_empty_space_inner"></span></div>
				</div>
			</div>
		</div>
		<div class="wpb_column vc_column_container vc_col-sm-6">
			<div class="vc_column-inner ">
				<div class="wpb_wrapper">
					<div class="wpb_raw_code wpb_content_element wpb_raw_html">
						<div class="wpb_wrapper">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="widget widget-location-banner ">
										<a href="<?= $row_website_config->{'feature_1_url'} ?>" class="widget-content">
											<div class="image-wrapper image-loaded">
												<img src="img/project/<?= $row_website_config->{'feature_1_image'} ?>" data-src="img/project/<?= $row_website_config->{'feature_1_image'} ?>" alt="" class="unveil-image">
											</div>
											<div class="content-meta">
												<h3 class="title"><?= $row_website_config->{'feature_1_title_' . $lang} ?></h3>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wpb_column vc_column_container vc_col-sm-6">
			<div class="vc_column-inner ">
				<div class="wpb_wrapper">
					<div class="wpb_raw_code wpb_content_element wpb_raw_html">
						<div class="wpb_wrapper">
							<div class="widget widget-location-banner ">
								<a href="<?= $row_website_config->{'feature_2_url'} ?>" class="widget-content">
									<div class="image-wrapper image-loaded">
										<img src="img/project/<?= $row_website_config->{'feature_2_image'} ?>" data-src="img/project/<?= $row_website_config->{'feature_2_image'} ?>" alt="" class="unveil-image">
									</div>
									<div class="content-meta">
										<h3 class="title"><?= $row_website_config->{'feature_2_title_' . $lang} ?></h3>
										<!-- <div class="properties">
											1 Property </div> -->
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="vc_row wpb_row vc_inner vc_row-fluid" style="margin-top: -4px;">
						<div class="wpb_column vc_column_container vc_col-sm-12">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="wpb_raw_code wpb_content_element wpb_raw_html">
										<div class="wpb_wrapper">
											<div class="widget widget-location-banner ">
												<a href="<?= $row_website_config->{'feature_3_url'} ?>" class="widget-content">
													<div class="image-wrapper image-loaded">
														<img src="img/project/<?= $row_website_config->{'feature_3_image'} ?>" data-src="img/project/<?= $row_website_config->{'feature_3_image'} ?>" alt="" class="unveil-image">
													</div>
													<div class="content-meta">
														<h3 class="title"><?= $row_website_config->{'feature_3_title_' . $lang} ?></h3>
														<!-- <div class="properties">
															0 Properties </div> -->
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="vc_column-inner strip_bg">
	<div class="wpb_wrapper container">
		<br>
		<br>
		<div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
		<div class="widget-text-heading  default">
			<!-- <h3 class="title"> <span><?= $row_website_config->{'vdo_prefix_' . $lang} ?></span> <?= $row_website_config->{'vdo_title_' . $lang} ?> </h3> -->
			<h3 class="title"> <?= $row_website_config->{'vdo_title_' . $lang} ?> </h3>
		</div>
		<div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="wpb_video_widget wpb_content_element vc_clearfix   vc_video-aspect-ratio-169 vc_video-el-width-100 vc_video-align-center">
							<div class="wpb_wrapper">
								<div class="wpb_video_wrapper">
									<iframe width="660" height="371" src="<?= $row_website_config->{'vdo_url'} ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="vc_empty_space" style="height: 70px"><span class="vc_empty_space_inner"></span></div>
	</div>
</div>

<div class="vc_column-inner">
	<div class="wpb_wrapper container">
		<br>
		<div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
		<div class="widget-text-heading  default">
			<!-- <h3 class="title"> <span>ព័ត៌មានថ្មី</span> ចុងក្រោយ </h3> -->
			<h3 class="title"> ព័ត៌មានថ្មីចុងក្រោយ </h3>
		</div>
		<div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
		<div class="widget-blogs no-margin clearfix carousel ">
			<div class="widget-content">
				<div class="owl-carousel posts owl-carousel-bottom" data-smallmedium="2" data-extrasmall="1" data-items="3" data-carousel="owl" data-pagination="true" data-nav="false">
					<?php
					$get_data = $connect->query("SELECT A.*,B.username as name
							FROM tbl_news as A
							LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
							ORDER BY A.date DESC
							LIMIT 0,25									
							");
					while ($row = mysqli_fetch_object($get_data)) {
						echo '<div class="item">
							<article class="post post-grid post-7477 type-post status-publish format-standard has-post-thumbnail hentry category-215 tag-319 %e1%9e%96%e1%9f%90%e1%9e%8f%e1%9f%8c%e1%9e%98%e1%9e%b6%e1%9e%93%e1%9e%94%e1%9f%92%e1%9e%9a%e1%9e%bc%e1%9e%98%e1%9f%89%e1%9e%bc%e1%9e%9f%e1%9e%b7%e1%9e%93">
								<figure class="entry-thumb effect-v6">
									<a class="post-thumbnail" href="news_detail.php?id=' . $row->id . '" aria-hidden="true">
										<div class="image-wrapper">
											<img src="img/news/' . $row->{'profile'} . '" data-src="img/news/' . $row->{'profile'} . '" width="780" height="641" alt="បញ្ចុះតម្លៃ៣% ទិញភ្លាម រស់នៅភ្លាម ពីវីឡាភ្លោះ ក្នុងគម្រោងបុរី ប៉េង ហួត ដឹស្តា ណេតឈឺរ៉ល" class="attachment-post-thumbnail unveil-image" />
										</div>
									</a>
								</figure>
								<div class="entry-content ">
									<div class="entry-meta">
										<div class="info">
											<h4 class="entry-title">
												<a href="news_detail.php?id=' . $row->id . '">' . $row->{'title_' . $lang} . '</a>
											</h4>
											<div class="meta">
												<span class="author"><a href="news_detail.php?id=' . $row->id . '" title="Posts by penghuoth" rel="author">penghuoth</a></span>
												<span class="date">' . $CustomDate->date_format($row->{'date'}, "d-F-Y", $lang) . '</span>
												<span class="comment">0 Comment</span>
											</div>
										</div>
									</div>
									<div class="more clearfix">
										<div class="pull-left">
											​​​​​​​​ <a class="btn-readmore" href="news_detail.php?id=' . $row->id . '"> <span>' . $lang_text['read_more'][$lang] . '</span></a>
										</div>
										<div class="pull-right">
											<a class="btn-readmore" href="news_detail.php?id=' . $row->id . '"> <i class="fa fa-long-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</article>
						</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="vc_row-full-width vc_clearfix"></div>
<div id="<?= $row_website_config->hp_popup_status?'welcome_message':'welcome_message_1' ?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<img width="100%" src="img/home_page/<?= $row_website_config->{'hp_image'} ?>" alt="<?= $row_website_config->keywords ?>" />
		</div>
	</div>
</div>
<style>
	.strip_bg {
		background-color: #f0f9fb;
	}

	.welcome_text {
		line-height: 30px;
	}

	.modal {
		text-align: center;
	}

	@media screen and (min-width: 768px) {
		.modal:before {
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 100%;
		}
	}

	.modal-dialog {
		display: inline-block;
		text-align: left;
		vertical-align: middle;
	}

	@media screen and (max-width: 768px) {
		.modal-dialog {
			margin-top: 150px;
		}
	}
	
	/* //  custom slider */
	#wowslider-container1 {
		margin-top: -25px !important;
		margin-bottom: -50px !important;
	}
	.ws_playpause,.ws-title-wrapper{
		display: none!important;
	}
	#wowslider-container1 .ws_controls > *{
		margin-top:  -50px!important;
	}
	#wowslider-container1 .ws_controls{
		display: none;  
	}
	#wowslider-container1:hover .ws_controls{
		display: block;
	}
	
</style>
<script>
	$(document).ready(function() {
		$("#welcome_message").modal('show');
		$(document).ready(function() {
			$('#slideshowHolder').jqFancyTransitions({
				effect: 'wave', // wave, zipper, curtain
				width: '100%', // width of panel
				height: 400, // height of panel
				strips: 20, // number of strips
				delay: 1000, // delay between images in ms
				stripDelay: 500, // delay beetwen strips in ms
				titleOpacity: 0.7, // opacity of title
				titleSpeed: 1000, // speed of title appereance in ms
				position: 'alternate', // top, bottom, alternate, curtain
				direction: 'fountainAlternate', // left, right, alternate, random, fountain, fountainAlternate
				navigation: true, // prev and next navigation buttons
				links: false // show images as links
			});
		});
	});
</script>
<?php include_once('layout/footer.php') ?>