<?php
	include '../../config/database.php';

	$transaction_id = $_GET['id'];
	$invoice = $_GET['invoice'];
	$cash = $_GET['cash'];
	$q2 = $_GET['qty'];
	$pro= $_GET['code'];
	$cus= $_GET['cus'];
	$code = "";

	// echo $transaction_id;
	$cate = "";
	 
	$product = "SELECT * FROM tbl_pos_stockin s INNER JOIN tbl_pos_product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product);
	       
		  		while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code=$row["code_in"];
		            $name_en=$row["name_en"];
		            $name_kh=$row["name_kh"];
		            $q1=$row["qty_in"];
		            $price=$row["price"];
		            $amount = $price * $q2;
		            $cate = $row['cate_id'];

	}
	
		$balance = "UPDATE tbl_pos_stockin SET qty_left = qty_left - '$q2' 
						WHERE 
					code_in = '$pro'";
	mysqli_query($connect, $balance);
	
 	//delete from invoice
 	 $delete_invoice = "DELETE FROM tbl_pos_stockout WHERE transaction_id = '$transaction_id' ";
 	 $result = mysqli_query($connect, $delete_invoice);
	 header("location:index.php?cash=$cash&invoice=$invoice");
	
	
	
						
 ?>