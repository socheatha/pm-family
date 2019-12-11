<?php 
	include_once '../../config/database.php';
 ?>
 <?php 
 	$v_problem = $connect->real_escape_string(trim(@$_POST['problem']));
 	$v_price = @$_POST['price'];
 	$v_price_extra = @$_POST['price_extra'];
 	$v_model = @$_POST['model_id'];
    $check_exist = $connect->query("SELECT pmp_id FROM tbl_pos_product_model_problem WHERE pmp_name='$v_problem' AND pmp_model='$v_model'");
    if(mysqli_num_rows($check_exist)){
        echo 'exist'; exit();
    }

 	$query_add = "INSERT INTO tbl_pos_product_model_problem 
     	(
     		pmp_name,
     		pmp_price,
     		pmp_price_extra,
     		pmp_model
     	) 
	    VALUES 
     	(
     		'$v_problem',
     		'$v_price',
     		'$v_price_extra',
     		'$v_model'
     	)";
    if($connect->query($query_add)){
    	echo $connect->insert_id;
    }
 ?>