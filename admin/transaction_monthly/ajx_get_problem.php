<?php 
	include_once '../../config/database.php';
 ?>
 <?php 
 	$v_model_id = @$_GET['model_id'];
 	$get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model='$v_model_id'");
 	if(mysqli_num_rows($get_data)){
 		echo '<option value="" data-price="0" >Choose Problem</option>';
	 	while($row_data = mysqli_fetch_object($get_data)){
	 		echo '<option value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
	 	}
 	}else{
 		echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
 	}
 ?>