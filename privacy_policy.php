<?php include_once('layout/header.php') ?>
	<div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h2 style="color: #009345;text-align: left" class="vc_custom_heading title_sub"><?= $lang_text['terms_of_use'][$lang] ?></h2>
		<div class="wpb_text_column wpb_content_element ">
			<div class="wpb_wrapper">
				<?php 
					$year = @$_GET['year']!=""?$_GET['year']:'2019';
					$condition = " AND DATE_FORMAT(A.date, '%Y')=".$year;
					$get_data = $connect->query("SELECT A.*,B.username as name
						FROM tbl_about_us as A
						LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
						WHERE type='2'
						ORDER BY A.index ASC");
					while ($row = mysqli_fetch_object($get_data)) {
						echo '<h3><strong>'.$row->{'title_'.$lang}.'</strong></h3>';
						echo '<br>';
						echo $row->{'detail_'.$lang};
						echo '<br><hr><br>';
					}
				?>
			</div>
		</div>
	</div></div></div></div>
<?php include_once('layout/footer.php') ?>