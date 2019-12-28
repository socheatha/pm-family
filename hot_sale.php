<?php include_once('layout/header.php') ?>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="wpb_wrapper">
				<div class="widget-blogs no-margin clearfix list ">
					<div class="widget-content">
					<?php 
						$i = 0;
						$type = 2;
						$year = @$_GET['year']!=""?$_GET['year']:'2019';
						$condition = " AND DATE_FORMAT(A.date, '%Y')=".$year;
						$get_data = $connect->query("SELECT A.*,B.username as name
							FROM tbl_news as A
							LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
							WHERE A.type=$type $condition
							ORDER BY A.id DESC");
						while ($row = mysqli_fetch_object($get_data)) {
							echo '<!-- Custom_list_news -->
							<div class="col-md-6 col-sm-6 col-xs-12">
									 
							<article class="post post-grid grid-1 post-6242 type-post status-publish format-standard has-post-thumbnail hentry category-hot-sale-en-2 tag-217 hot-sale-en-2">
								<figure class="entry-thumb effect-v6"><a class="post-thumbnail" href="hot_sale_detail.php?id='.$row->id.'" aria-hidden="true"><div class="image-wrapper image-loaded"><img src="img/news/'.$row->{'profile'}.'" data-src="" width="780" height="440" alt="'.$row_website_config->{'keywords'}.'" class="attachment-post-thumbnail unveil-image"></div></a></figure>    
								<div class="entry-content ">
									<div class="entry-meta">
										<div class="info">
										<h4 class="entry-title">
											<a href="hot_sale_detail.php?id='.$row->id.'">'.$row->{'title_'.$lang}.'</a>
										</h4>
										<div class="meta">
												<span class="date">'.$CustomDate->date_format($row->{'date'},"d-F-Y",$lang).'</span>
											</div>
										</div>
										<div class="description">'.$row->{'short_description_'.$lang}.'</div>
										</div>
									<div class="more clearfix">
										<div class="pull-left">
											<a class="btn-readmore" href="hot_sale_detail.php?id='.$row->id.'"> <span>'.$lang_text['read_more'][$lang].'</span></a>
										</div>
										<div class="pull-right">
											<a class="btn-readmore" href="hot_sale_detail.php?id='.$row->id.'"> <i class="icon-ap_arrow-right"></i></a>
										</div>
									</div>
								</div>
							</article>														 

							</div>					
							<!-- Close_custom_list_news -->	 ';
						}
					?>
					</div>
					<div class=" pt-cv-pagination-wrapper"> </div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<?php include_once 'news_aside.php'; ?>
		</div>
	</div>
	<style>
		.entry-title a, .recentTitle h5, .entry-title{
            color: #444!important;
			font-family: "Neuron-Bold", serif!important;
            font-weight: bold!important;
		} 
		.widget-content{
			margin-top: 45px;
		}
		.post_readmore a{
			text-decoration: none;
		}
	</style>
<?php include_once('layout/footer.php') ?>