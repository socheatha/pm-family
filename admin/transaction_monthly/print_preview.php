<?php include_once ('../../config/database.php'); ?>
<?php include_once ('../../language/index.php'); ?>
<?php
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$sql = "SELECT *,
	((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount
	from  tbl_transaction AS A 
	LEFT JOIN tbl_pos_user AS B ON B.id=A.t_user_id 
	LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer 
	LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue 
	LEFT JOIN tbl_machine_type AS E ON E.mt_id=A.t_product_machine_type
	LEFT JOIN tbl_pos_employee AS F ON F.emp_id=A.t_fix_by_employee
	LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
	WHERE  t_id = '$id'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
    
}	
	$ci = "SELECT * FROM tbl_pos_con_invoice";
	$rci = $connect->query($ci);
	$c = $rci->fetch_assoc();
    
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content = "1; URL=<?= $_GET['action_back'] ?>">
	<link rel="stylesheet" href="../../assets/global/plugins/bootstrap/css/bootstrap.css">
	<script src="print_offline/jquery.min.js"></script>
	<style type="text/css">
		*{ font-family: 'khmer os content'; font-size: 10px!important; }
		@media print {
            .table thead tr th{
                -webkit-print-color-adjust: exact;
                background: #222 !important;
                color: #fff !important;
            }
            .table tfoot tr td.bg{
                -webkit-print-color-adjust: exact;
                background: #444 !important;
                color: #fff !important;
            }
            .table *{ padding-bottom: 2px!important; padding-top: 2px!important; }
        }
		.bd{ border-bottom: 0.5px dotted #444!important; padding-left: 5px; }
		.td_title{ white-space: nowrap!important; }
		table{ margin-bottom: 10px; }
	</style>
</head>
<body onload="window.print();">
	<div class="container">
		<div class="row">
			<div id="content">
				<div class="col-xs-4 text-center">
					<img src="../../img/img_invoice/<?php echo $c['logo']?>" alt="logo" width="100%">
				</div>	
				<div class="col-xs-8 text-center" style="padding-left: 0px;">
					<p><?php echo $c['shop_name'] ?></p>
				</div>	
				<hr>
			</div>
		</div>
		<hr style="border: 1.5px solid #000; padding: 0px; margin: 0px;">
		<div class="row">
			<div class="col-xs-5"><h4 style="font-family: 'khmer Moul'; font-weight: bold;">
				<?= $lang_text['invoice'][$lang] ?> <?php if($row['t_date_cashed']!='0000-00-00'){ echo '<br>'.$lang_text['date'][$lang]; } ?>
			</h4></div>
			<div class="col-xs-7 text-right">
				<h4 style="font-family: 'khmer Moul'; font-weight: bold;">N<sup>o</sup> : <?= sprintf('%08d',$row['t_id']) ?><?php if($row['t_date_cashed']!='0000-00-00'){ echo '<br>'.$row['t_date_cashed'];} ?></h4>
			</div>
		</div><br>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['model'][$lang] ?> :</td>
				<td width="95%" class="bd"><?= $row['name_en']?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['boardNumber'][$lang] ?> :</td>
				<td width="95%" class="bd"><?= $row['t_product_board_number']?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['productStatus'][$lang] ?> :</td>
				<td width="95%" class="bd"><?= $row['mt_name']?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['problem'][$lang] ?> :</td>
				<td width="95%" class="bd"><?= $row['t_issue_description']?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['price'][$lang] ?> :</td>
				<td width="95%" class="bd text-center">$ <?= number_format($row['t_fix_price'],2) ?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['discount'][$lang] ?> :</td>
				<td width="95%" class="bd text-center">$ <?= number_format($row['sum_discount'],2) ?></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['subTotal'][$lang] ?> :</td>
				<td width="95%" class="bd text-center"><strong>$ <?= number_format(($row['t_fix_price']-$row['sum_discount']),2) ?></strong></td>
			</tr>
		</table>
		<table width="100%">
			<tr>
				<td class="td_title"><?= $lang_text['customer'][$lang] ?> :</td>
				<td width="95%" class="bd"><?= $row['t_customer_phone_number']?></td>
			</tr>
		</table>
		<table width="100%">
			<tr><td colspan="2" class="td_title"><?= $lang_text['note'][$lang] ?> :</td></tr>
			<tr><td colspan="2"><blockquote><?= $row['t_note']?></blockquote></td></tr>
		</table>
		<div class="row">
			<div class="col-xs-6"><strong><?= $lang_text['checkinDate'][$lang] ?>:</strong><br> <?= $row['t_date_received']?></div>
			<div class="col-xs-6 text-right">
				<strong><?= $lang_text['alertDate'][$lang] ?>:</strong><br> <?= $row['t_alert_inform_date']?>
				<?php if($row['t_date_finished']!='0000-00-00'){ ?>
				<br><strong><?= $lang_text['finishedDate'][$lang] ?>:</strong><br> <?= $row['t_date_finished']?>
				<?php } ?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-xs-6">
				<strong><?= $lang_text['receivedBy'][$lang] ?><br></strong><?= $row['username']?>
			</div>
			<div class="col-xs-6 text-right">
				<strong><?= $lang_text['fixByEmployee'][$lang] ?><br></strong><?= $row['name_english']?>
			</div>
		</div>
		<br>
		<?php echo $c['shop_note']?>
	</div>
</body>
</html>


