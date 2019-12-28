<?php include_once('layout/header.php') ?>
	<h2 style="font-size: 30px;color: #009345;text-align: left" class="vc_custom_heading title_sub" ><?= $lang_text['sm_site_map'][$lang] ?></h2>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<h2 style="text-align: left" class="vc_custom_heading custom_menu_title" ><?= $lang_text['m_about'][$lang] ?> </h2>
			<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey" >
				<span class="vc_sep_holder vc_sep_holder_l"><span  class="vc_sep_line"></span></span>
				<span class="vc_sep_holder vc_sep_holder_r"><span  class="vc_sep_line"></span></span>
			</div>
			<div class="wpb_text_column wpb_content_element " >
				<div class="wpb_wrapper">
					<ul>
						<li class="custom_list_menu"><a href="about_us.php"><?= $lang_text['m_wwa'][$lang] ?></a></li>
						<li class="custom_list_menu"><a><?= $lang_text['m_csr'][$lang] ?></a>
							<ul>
								<li class="custom_list_menu"><a href="activity.php"><?= $lang_text['m_activity'][$lang] ?></a></li>
								<li class="custom_list_menu"><a href="certificate.php"><?= $lang_text['m_certificate'][$lang] ?></a></li>
							</ul>
						</li>
						<li class="custom_list_menu"><a href="honor_and_award.php"><?= $lang_text['m_honor'][$lang] ?></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<h2 style="text-align: left" class="vc_custom_heading custom_menu_title" ><?= $lang_text['m_project'][$lang] ?> </h2>
			<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey" >
				<span class="vc_sep_holder vc_sep_holder_l"><span  class="vc_sep_line"></span></span>
				<span class="vc_sep_holder vc_sep_holder_r"><span  class="vc_sep_line"></span></span>
			</div>
			<div class="wpb_text_column wpb_content_element " >
				<div class="wpb_wrapper">
					<ul>
						<li class="custom_list_menu"><a href="project.php?project_type_id=2"><?= $lang_text['l_current_pro'][$lang] ?></a></li>
						<li class="custom_list_menu"><a href="project.php?project_type_id=1"><?= $lang_text['l_future_pro'][$lang] ?></a></li>
						<li class="custom_list_menu"><a href="project.php?project_type_id=3"><?= $lang_text['l_exist_pro'][$lang] ?></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<h2 style="text-align: left" class="vc_custom_heading custom_menu_title" ><?= $lang_text['m_news'][$lang] ?> </h2>
			<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey" >
				<span class="vc_sep_holder vc_sep_holder_l"><span  class="vc_sep_line"></span></span>
				<span class="vc_sep_holder vc_sep_holder_r"><span  class="vc_sep_line"></span></span>
			</div>
			<div class="wpb_text_column wpb_content_element " >
				<div class="wpb_wrapper">
					<ul class="custom_dropdown-menu">
						<li class="custom_list_menu"><a href="hot_sale.php"><?= $lang_text['m_promotion'][$lang] ?></a></li>
						<li class="custom_list_menu"><a href="news.php"><?= $lang_text['m_news'][$lang] ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php include_once('layout/footer.php') ?>