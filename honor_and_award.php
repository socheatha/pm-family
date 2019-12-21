<?php include_once('layout/header.php') ?>
<div class="vc_row wpb_row vc_row-fluid">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner ">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
							<div class="rt-container-fluid tlp-portfolio" id="tlp-portfolio-container-881694611">
								<div class="row layoutisotope">
									<div id="tlp-portfolio-isotope-button" class="button-group filter-button-group option-set">
										<button data-filter="*" class="selected"><?= $lang_text['show_all'][$lang] ?></button>
										<?php
											$type = 2;
											$get_data = $connect->query("SELECT A.*,
												DATE_FORMAT(A.date, '%Y') as formated_date
												FROM tbl_certificates as A
												WHERE A.type=$type
												GROUP BY formated_date
												ORDER BY formated_date ASC
												");
											while ($row = mysqli_fetch_object($get_data)) {
												echo '<button data-filter=".'.$row->formated_date.'">'.$row->formated_date.'</button>';
											}
										?>
									</div>
									<div class="tlp-portfolio-isotope">
										<?php 
											$type = 2;
											$year = @$_GET['year']!=""?$_GET['year']:null;
											$condition = $year&&" AND DATE_FORMAT(A.date, '%Y')=".$year;
											$get_data = $connect->query("SELECT A.*
												FROM tbl_certificates as A
												WHERE A.type=$type $condition
												ORDER BY A.index ASC");
											while ($row = mysqli_fetch_object($get_data)) {
												echo '<div class="tlp-item tlp-single-item tlp-equal-height tlp-col-lg-3 tlp-col-md-3 tlp-col-sm-6 tlp-col-xs-12 '.date("Y", strtotime($row->date)).'">
													<div class="tlp-portfolio-item">
														<div class="tlp-portfolio-thum tlp-item">
															<img class="img-responsive" src="img/certificate/'.$row->{'profile'}.'" alt="'.$row->{'title_'.$lang}.' - '.$row->{'short_description_'.$lang}.'">
															<div class="tlp-overlay">
																<p class="link-icon" style="margin-top: 58.5px;">
																	<a class="tlp-zoom cboxElement" href="img/certificate/'.$row->{'profile'}.'">
																		<i class="fa fa-search-plus"></i>
																	</a>
																	<a target="_blank" href="honor_and_award_detail.php?id='.$row->id.'"><i class="fa fa-external-link"></i></a>
																</p>
															</div>
														</div>
														<div class="tlp-content">
															<div class="tlp-content-holder">
																<h3><a href="honor_and_award_detail.php?id='.$row->id.'">'.$row->{'title_'.$lang}.'</a></h3>
																<p>'.$row->{'short_description_'.$lang}.'</p>
															</div>
														</div>
													</div>
												</div>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include_once('layout/footer.php') ?>