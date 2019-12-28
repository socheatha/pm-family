<?php include_once('layout/header.php') ?>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="wpb_wrapper">
				<div class="widget-blogs no-margin clearfix list ">
					<div class="widget-content">
					<?php 
						$i = 0;
						$type = 1;
						$year = @$_GET['year']!=""?$_GET['year']:'2019';
						$condition = " AND DATE_FORMAT(A.date, '%Y')=".$year;
                        $get_data = $connect->query("SELECT A.*,B.username as name
                            FROM tbl_news as A
                            LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
                            WHERE A.type=$type $condition
							ORDER BY A.id DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<!-- Custom_list_news -->
							<div class="row list-inner">
								<div class="col-sm-5 image custom-img">
									<figure class="entry-thumb effect-v6">
										<a class="post-thumbnail" href="news_detail.php?id='.$row->id.'" aria-hidden="true">
											<div class="image-wrapper image-loaded">
												<img src="img/news/'.$row->profile.'" width="300" height="200" alt="'.$row_website_config->{'keywords'}.'" class="attachment-post-thumbnail unveil-image">
											</div>
										</a>
									</figure>                
									</div>
										<div class="col-sm-7 info">
											<div class="info-content">
											<h4 class="entry-title"> <a href="news_detail.php?id='.$row->id.'">'.$row->{'title_'.$lang}.'</a> </h4>
											<div class="date">
												<i class="fa fa-calendar fa-fw"></i> '.$CustomDate->date_format($row->{'date'},"d-F-Y",$lang).'
											</div>
											<div class="description">'.$row->{'short_description_'.$lang}.'</div>
											<div class="post_readmore">
												<a href="news_detail.php?id='.$row->id.'"><span class="btn_readmore">'.$lang_text['read_more'][$lang].'</span></a>
											</div>
										</div>
									</div>
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
		.info-content{
			margin-top: 15px;
		}
		.post_readmore a{
			text-decoration: none;
		}
	</style>
<?php include_once('layout/footer.php') ?>