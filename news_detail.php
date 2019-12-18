<?php include_once('layout/header.php') ?>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="wpb_wrapper">
				<div class="widget-blogs no-margin clearfix list ">
					<div class="widget-content">
					<?php 
                        $id = @$_GET['id'];
                        $type = 1;
                        if(!$id){ header('location: news.php'); }
                        $get_data = $connect->query("SELECT A.*,B.username as name
                            FROM tbl_news as A
                            LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
                            Where A.type=$type AND A.id='$id'
                            ORDER BY A.id DESC");
                        $row = mysqli_fetch_object($get_data);
                        echo '
                            <br>
                            <img src="img/news/'.$row->profile.'" width="100%" alt="'.$row_website_config->{'keywords'}.'">             
                            <div class="row list-inner">
                                <div class="col-sm-12 image custom-img">
                                    </div>
                                        <div class="col-sm-12 info">
                                            <div class="info-content">
                                            <h4 class="entry-title">'.$row->{'title_'.$lang}.'</h4>
                                            <div class="date">
                                                <i class="fa fa-calendar fa-fw"></i> '.$row->{'date'}.'
                                            </div>
                                            <div class="description">'.$row->{'detail_'.$lang}.'</div>
                                        </div>
                                    </div>
                                </div>							
                            <!-- Close_custom_list_news -->	 
                            ';
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
        .date{
            color: #077369;
            border-bottom: 1px solid #eee;
            margin-bottom: 25px; padding-bottom: 25px;
        }
	</style>
<?php include_once('layout/footer.php') ?>