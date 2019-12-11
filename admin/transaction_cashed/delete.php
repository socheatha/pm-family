<?php 
    $menu_active =9998;
    $layout_title = "Welcome Dashboard";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 
	if(@$_SESSION['user']->position_id != 1){
		exit();
	}
?>

<?php 
	if(@$_GET['del_id'] != ""){
		$del_id = @$_GET['del_id'];
		$v_current_time_stamp=date('Y-m-d H:i:s');
		$v_user_name=$_SESSION['user']->username;
		if($connect->query("INSERT INTO tbl_transaction_audit (`t_id`, `t_date_received`, `t_customer`, `t_customer_phone_number`, `t_product_ref`, `t_product_model`, `t_product_machine_type`, `t_product_board_number`, `t_product_description`, `t_issue`, `t_issue_description`, `t_alert_inform_date`, `t_fix_by_employee`, `t_fix_price`,`t_discount_status`,`t_discount_dollar`,`t_discount_percentage`, `t_price_detail`, `t_discount_detail`, `t_fix_status`, `t_date_finished`, `t_date_cashed`, `t_note`, `t_user_id`, `t_created_at`, `t_updated_at`) SELECT * FROM tbl_transaction WHERE t_id='$del_id'")){
			$connect->query("UPDATE tbl_transaction_audit SET t_action='deleted',t_action_by='$v_user_name',t_action_at='$v_current_time_stamp' WHERE t_id='$del_id'");
			$connect->query("DELETE FROM tbl_transaction WHERE t_id='$del_id'");
		}
	}
?>
<script type="text/javascript">
	window.location.replace("index.php");
</script>