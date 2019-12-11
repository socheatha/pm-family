<?php 
	include_once '../../config/database.php';
 ?>
 <?php 
 	$v_current_year = date('Y-m');
    $get_data = $connect->query("SELECT *,
        (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost
        FROM tbl_transaction AS A 
        LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
        LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
        LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
        LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
        LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
        LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
    WHERE A.t_fix_status='3' AND DATE_FORMAT(A.t_date_cashed,'%Y-%m')='$v_current_year'
    ORDER BY A.t_date_cashed DESC");

    $api_data = [];
    while($row = mysqli_fetch_assoc($get_data)){
    	array_push($api_data, $row);
    }
    echo json_encode($api_data);
	
  ?>