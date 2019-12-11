<?php include_once ('../../config/database.php'); ?>
<?php
ob_start();

$invoice = "";
if(isset($_GET["invoice"])){
	$invoice = $_GET["invoice"];
	$sql = "SELECT * from  tbl_pos_invoice A INNER JOIN tbl_pos_customer B ON A.cus = B.no where inv_no = '$invoice'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
    $pay_dollar=$row['pay_dollar'];
    $pay_riel=$row['pay_riel'];
    
}	
	$ex = "SELECT * FROM tbl_pos_exchange";
	$reex = $connect->query($ex);
	$do = $reex->fetch_assoc();
	$do_luy = $do['exchange'];

	$v = "SELECT * FROM tbl_pos_vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];

	$ci = "SELECT * FROM tbl_pos_con_invoice";
	$rci = $connect->query($ci);
	$c = $rci->fetch_assoc();
    
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content = "1; URL=index.php?cash=cash&invoice=<?= $invoice+1 ?>">
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
				<div class="text-center">
					<h5 style="font-family: 'Khmer OS Muol Light'">
						បង្កាន់ដៃបង់ប្រាក់ / RECEIPT
					</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">លេខបង្កាន់ដៃ / Receipt No</div>
			<div class="col-xs-6">: <?= sprintf('%08d',$row['inv_no']) ?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">អ្នកគិតលុយ / Cashier</div>
			<div class="col-xs-6">: <?= $row ['cashier_name']?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">អតិថិជន / Customer</div>
			<div class="col-xs-6">: <?= $row['cus_name']?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">កាលបរិច្ឆេទ / Date</div>
			<div class="col-xs-6">: <?= $row['date_sell']?></div>
		</div>
	</div><br>
	<div class="container-fliud">
		<table class="table table-hover table-responsive">
			<thead>
		      	<tr>
		        	<th class="text-center">បរិយាយ <br> Description</th>
		        	<th class="text-center">ចំនួន <br> QTY</th>
		        	<th class="text-center">តម្លៃ <br> Price</th>
		        	<th class="text-center">ចុះថ្លៃ <br> Dis.</th>
		        	<th class="text-right">សរុប <br> Amount</th>
		      	</tr>
		    </thead>
			<tbody>
		    	<?php
		    		$item = "SELECT * FROM tbl_pos_stockout AS A
                        LEFT JOIN tbl_pos_product AS B ON B.pro_id=A.pro_id WHERE invoice = '$invoice'";
		    		$reitem = mysqli_query($connect , $item);
		    		$i = 1;
		    		while($row1 = $reitem->fetch_assoc()) 
                	{   
	                	$items = $row1['name_en'];
	                	$qty = $row1['qty_out']; 
	                	$price = $row1['price'];
	                	$amount = $row1['amount'];
						$discount = $row1['discount']; 
			    	?>
		      		<tr>
				      <td><?= $items; ?></td>
				      <td class="text-center"><?= $qty; ?></td>
				      <td class="text-center"><?= number_format($price,2); ?></td>
				      <td class="text-center"><?= number_format($discount,0); ?></td>
				      <td class="text-right"><?= number_format($amount,2) ;?></td>
			      	</tr>
		      	<?php
		      		$i++;
		   		}
		       	?>
		    </tbody>
		    <tfoot>
		    	<tr>
			      	<td colspan="3" style="text-align:right"><b>Sub Total ($) :</b></td>
			      	<td class="text-right" colspan="2">
			      	<?php
						$sum= "SELECT sum(qty_out*price) FROM tbl_pos_stockout WHERE invoice = '$invoice'";
						$result1 = $connect->query($sum);
						for($i=0; $row1 = $result1->fetch_assoc(); $i++){
						$v_price=$row1['sum(qty_out*price)'];
							echo  '$ ' . number_format($v_price,2);
						}
					?>
			      	</td>
		    	</tr>
		    	<tr>	      
			      	<td colspan="3" style="text-align:right"><b>Discount Bill :</b></td>
			      	<td class="text-right" colspan="2">
			      		<?php
					      	$sum= "SELECT sum(discount) FROM tbl_pos_stockout WHERE invoice = '$invoice'";
							$result2 = $connect->query($sum);
							for($i=0; $row1 = $result2->fetch_assoc(); $i++){
							$dis=$row1['sum(discount)'];
								echo ' $ ' .  number_format($dis,2);
							}
						?>
			      	</td>
		    	</tr>
				<tr>
			      	<td colspan="3" style="text-align:right"><b>សរុបជាដុល្លារ ($) :</b></td>
			      	<td class="text-right" colspan="2">
			      		<?php
							$subtotal=$v_price-$dis;
							echo  ' $ ' . number_format($subtotal,2);
						?>
			      	</td>
		    	</tr>
		    	<tr>	      
			      	<td colspan="3" style="text-align:right"><b>សរុបជារៀល (៛) :</b></td>
			      	<td class="text-right" colspan="2">
			      		<?php
							$riel = $subtotal * $do_luy;
							echo number_format($riel,0). ' ៛';
						?>
			      	</td>
		    	</tr>
		    	<tr>
		    		<?php 
		    			$tds=($pay_riel/$do_luy)+$pay_dollar;
		    			$tdr=($pay_dollar*$do_luy)+$pay_riel;
		    		?>
		    		<td colspan="5">
		    			<table width="100%">
		    				<tr>
		    					<td><div style="min-width: 60px!important; display: inline-block;">ទទួលជា ($)​ </div>: $ <?= number_format($pay_dollar,2); ?></td>
		    					<td class="text-right">
			    					អាប់ជា ($) :​
		    						<div style="min-width: 60px!important; display: inline-block;">
			    					$ <?php 
                                    	$chs=$tds-$subtotal;
                                     	echo number_format(round($chs, 2),2);
                                    ?>
                               		</div>
                                </td>
		    				</tr>
		    				<tr>
		    					<td><div style="min-width: 60px!important; display: inline-block;">ទទួលជា (៛)  </div>: <?= number_format($pay_riel,0). ' ៛'; ?></td>
		    					<td class="text-right">
		    						អាប់ជា (៛) : 
									<div style="min-width: 60px!important; display: inline-block;">
										<?php 
		                                    echo number_format($chs*4000,0). ' ៛'; 
		                                ?>
		                            </div>
		    					</td>
		    				</tr>

		    			</table>
		    		</td>
		    	</tr>
		    </tfoot>
		</table>
	</div>	
	<center> <?= $c['shop_note'] ?> </center>
</body>
</html>


