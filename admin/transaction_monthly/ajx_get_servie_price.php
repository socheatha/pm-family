<?php 
	include_once '../../config/database.php';
 ?>
 <?php 
 	$v_ser_id = @$_GET['ser_id'];
 	$get_ser_tel = $connect->query("SELECT s_price FROM tbl_pos_service WHERE s_id='$v_ser_id'");
 	$row_ser_tel = mysqli_fetch_object($get_ser_tel);
 	echo $row_ser_tel->s_price;
 ?>