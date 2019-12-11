<?php 
	include_once '../../config/database.php';
 ?>
 <?php 
 	$v_cus_id = @$_GET['cus_id'];
 	$get_cus_tel = $connect->query("SELECT phone FROM tbl_pos_customer WHERE no='$v_cus_id'");
 	$row_cus_tel = mysqli_fetch_object($get_cus_tel);
 	echo @$row_cus_tel->phone;
 ?>