<?php 
	include '../../config/database.php';
	include_once '../../config/athonication.php';

	if(@$_GET['del_id']!=""){
		$del_id = @$_GET['del_id'];
		$del_img = @$_GET['del_img'];

		$connect->query("DELETE FROM tbl_pos_user WHERE id='$del_id'");
	}
 ?>

 <script type="text/javascript">
 	window.location.assign("index.php")
 </script>