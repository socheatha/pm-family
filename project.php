<?php include_once('layout/header.php') ?>
	<div class="container">
		<div class="row clearfix">
			<div id="main-content" class="col-md-8 col-sm-12 col-xs-12 ">
				<main id="main" class="site-main content apus-properties-main" role="main">
					<div class="apus-properties-page-wrapper">
						<br>
						<div class="tab-content">
							<div id="tab-properties-list" class="tab-pane active">
								<div class="property-box-archive type-box">
									<?php 
										$i = 0;
										if(@$_GET['project_type_id']!=''){
											$_SESSION['project_type_id']=$_GET['project_type_id'];
										}else{
											if(!@$_SESSION['project_type_id']) $_SESSION['project_type_id']=2;
										}
										$type = $_SESSION['project_type_id'];
										$category_id = @$_GET['txt_category_id']!=""?$_GET['txt_category_id']:null;
										$condition = $category_id?" category_id=".$category_id." ":" 1=1 ";
										$get_data = $connect->query("SELECT 
											A.*,B.username as name,
											C.name_en,C.name_kh,
											GROUP_CONCAT(CONCAT(E.name_en,'_dev_socheatha_',E.name_kh,'_dev_socheatha_',E.profile) 
												ORDER BY E.name_en ASC 
												SEPARATOR '_dev_split_') 
											AS features
										FROM tbl_projects as A
										LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
										LEFT JOIN tbl_project_category AS C ON C.id=A.category_id
										LEFT JOIN tbl_proj_feat AS DE ON DE.project_id=A.id
                        				LEFT JOIN tbl_project_feature AS E ON E.id=DE.feature_id
										WHERE $condition AND A.type_id='$type'
										GROUP BY A.id
										ORDER BY A.date DESC");
										while ($row = mysqli_fetch_object($get_data)) {
											echo '<div class="cust-project-1 col-md-6 col-sm-6 col-property-box">		
												<div class="property-box property-box-grid property-box-wrapper" data-latitude="40.66781969999999" data-longitude="-73.99436759999998" data-markerid="marker-5441">
													
												<div class="property-box-image ">
													<a href="project_detail.php?id='.$row->id.'" class="property-box-image-inner">
														<div class="image-wrapper image-loaded">
															<img src="img/project/'.$row->profile.'" data-src="'.$row->profile.'" width="480" height="310" alt="'.$row_website_config->{'keywords'}. '" class="attachment-homesweet-standard-size unveil-image">
														</div>
													</a>
													
												</div><!-- /.property-image -->
												<div class="property-box-content">
													<div class="property-box-title-wrap">
														<div class="property-box-title">
															<h3 class="entry-title"><a href="project_detail.php?id=' . $row->id . '">'.$row->{'title_'.$lang}.'</a></h3>
															<div class="property-row-labels">
																<span class="property-badge-contract">Sale</span>
																<span class="property-badge feature">Featured</span>
															</div>				
															<div class="property-row-address">
																<i class="fa fa-envelope" aria-hidden="true"></i>
																'.$row->email_saler.'
															</div>
															<div class="property-box-price text-theme">
																<a href="tel:'.$row->phone_saler.'">
																	<span class="phone-property">&nbsp;&nbsp;'.$row->phone_saler.'</span>
																</a>
															</div>
														</div>
													</div><!-- /.property-box-title -->
													<br>
													<div class="property-box-field">
														<div class="property-box-meta">';
															
															foreach(explode('_dev_split_',@$row->features) AS $feaure){
																if($feaure){
																	$feature_data = explode('_dev_socheatha_',$feaure);
																	echo '<div class="field-item">
																	<img src="img/project/feature/'.$feature_data[2].'">   
																	<span>'.($lang=="kh"?$feature_data[1]:$feature_data[0]).'</span>
																	</div>';
																}
															}
														
														echo '</div>
													</div>
												</div>
											</div></div>';
										}
									?>
								</div></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="apus-pagination-wrapper"></div>
					</main><!-- .site-main -->
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pull-right">
					<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						<aside id="filter_widget-16" class="widget widget_filter_widget">
							<h2 class="widget-title"><span>    <?= $lang_text['p_find_project'][$lang] ?>    </span></h2>
							<form class="filter-property-form widget-filter-form vertical" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">							
								<div class="form-group group-select">
									<select class="form-control" name="txt_category_id" id="filter_widget-16_status">
										<option value=""> <?= $lang_text['p_all'][$lang] ?> </option>
										<?php
											$get_data = $connect->query("SELECT * FROM tbl_project_category ORDER BY name_".$lang." ASC");
											while ($row = mysqli_fetch_object($get_data)) {
												echo '<option value="'.$row->id.'" '.(@$_GET['txt_category_id']==$row->id?'selected':'').'>'.$row->{'name_'.$lang}.'</option>';
											}
										?>
									</select>
								</div><!-- /.form-group -->																																																																																						
							<div class="form-group">
						<button class="button btn btn-purple btn-block" id="btn-property"><?= $lang_text['p_search'][$lang] ?></button>
					</div><!-- /.form-group -->
				</form>
				<script>
					var idp = $('#filter_widget-3_property_type, #filter_widget-16_property_type, #filter_widget-3_status').val();
					$('#filter_widget-3_property_type, #filter_widget-16_property_type, #filter_widget-3_status,#filter_widget-16_status').on('change', function() {
						idp = this.value;
					});
				</script>
			</aside>
		</aside>
	</div>
</div>
</div>
<?php include_once('layout/footer.php') ?>