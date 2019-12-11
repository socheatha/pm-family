<?php 
    include_once '../../config/database.php';
?>  
<?php 
    if(@$_POST['txt_status_id']!="" && @$_POST['txt_tran_id']){
    	$v_tran_id = @$_POST['txt_tran_id'];
    	$v_status_id = @$_POST['txt_status_id'];
        $v_user_id = @$_SESSION['user']->id;
        if($v_status_id!=3){
        	$connect->query("UPDATE tbl_transaction SET t_fix_status='$v_status_id' WHERE t_id='$v_tran_id'");
        }else{
	        $v_current_date = date('Y-m-d');
	        $connect->query("UPDATE tbl_transaction SET t_fix_status='$v_status_id',t_date_cashed='$v_current_date' WHERE t_id='$v_tran_id'");

	        // set to income
	        $get_data = $connect->query("SELECT *,((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount FROM tbl_transaction AS A WHERE t_id='$v_tran_id'");
	        $row_data = mysqli_fetch_object($get_data);
	        $connect->query("INSERT INTO tbl_account_income (ai_date,ai_title,ai_amount_dollar,ai_note,ai_created_by) VALUES(
	            '".@date('Y-m-d')."',
	            '".@sprintf('%08d',$v_tran_id)."::".@$row_data->t_issue_description."',
	            '".(@$row_data->t_fix_price-@$row_data->sum_discount)."',
	            '".@$row_data->t_note."',
	            '".@$v_user_id."'
	        )");
        }
        echo mysqli_error($connect);
    }
?>