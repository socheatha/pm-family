<?php
	include '../../config/database.php';
	// include '../../config/athonication.php';
	// include '../layout/header.php';
	ob_start();

	$ex = "SELECT * FROM tbl_pos_vat";
	$reex = $connect->query($ex);
	$row = $reex->fetch_assoc();
	$do_luy = $row['vat'];



	$invoice = $_POST['invoice'];
	$pro = $_POST['product'];
	$q2 = $_POST['qty'];
	$cash = $_POST['cash'];
	$date = $_POST['date'];
	$discount = $_POST['discount'];
	// $cus = $_POST['cus'];
	// $pay = $_POST['pay'];
	

	$code="";
	$name_en='';
	
	$name_kh='';
          
    $price='';
    $amount ='';
    $q1 = '';
    $cate = '';
    $c = "";
    $in = "";

  if (!empty($discount)){
   	$same = "SELECT * FROM tbl_pos_stockout WHERE code_out = '$pro' and invoice = '$invoice'";
    $resame = $connect->query($same);
    while ($row1 = $resame->fetch_assoc()) {
    	$c = $row1['code_out'];
    	$in = $row1['invoice'];
	}
	
    if( $pro == ''){
    	 echo "<script>alert('Please Choose Product Befor Click Add !');
    	 window.location.href='index.php?cash=$cash&invoice=$invoice';
    	 </script>"; 	
    }
    else if ( $c == $pro && $in == $invoice ) {
    		$product = "SELECT * FROM tbl_pos_stockin s INNER JOIN tbl_pos_product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product); 
		  	while($row = $repro->fetch_assoc())
			  { 
		          $cate = $row['cate_id'];
			}
    		$up = "UPDATE tbl_pos_stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
    		mysqli_query($connect, $up);
    	
    	$upout = "UPDATE tbl_pos_stockout SET qty_out = qty_out + '$q2' , amount = qty_out * price , vat = amount * '$do_luy' WHERE code_out = '$pro' AND invoice = '$invoice'";
    	mysqli_query($connect, $upout);
    	header("location:index.php?cash=$cash&invoice=$invoice");
    	
    }
    else {
		$product = "SELECT * FROM tbl_pos_stockin s INNER JOIN tbl_pos_product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
		 $repro = $connect->query($product);
		 $count = $repro->num_rows;
		 if($count > 0)
		 {
		 	while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code=$row["code_in"];
		            $name_en=$row["name_en"];
		            $name_kh=$row["name_kh"];
		            $q1=$row["qty_in"];
		            $price=$row["price_dolla"];
		            $amount = $price * $q2;
		            $cate = $row['cate_id'];

			}
			$vat = $q2 * $do_luy ;
			$discount1 = $discount / 100;
			$dis = $price * $discount1 * $q2;
			$price2 = $price - $dis;
			$amount2 = $price * $q2 - $dis;
	
				$balance = "UPDATE tbl_pos_stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
				mysqli_query($connect, $balance);

				$get_product_code = $connect->query("SELECT pro_id FROM tbl_pos_product WHERE code='$code'");
    			$v_pro_id = mysqli_fetch_object($get_product_code)->pro_id;
    			$v_user_id = $_SESSION['user']->id;
    			$date = date('Y-m-d');

				$stockout = "INSERT INTO tbl_pos_stockout ( invoice , code_out , pro_nameen, pro_namekh, qty_out, price , amount ,discount, vat,pro_id, date_out,so_user_id)
			 	VALUES ( '$invoice', '$code', '$name_en', '$name_kh', '$q2', '$price', '$amount2', '$dis', '$vat','$v_pro_id', '$date','$v_user_id')";
			 	$restockout = mysqli_query($connect, $stockout);
			 	if ($restockout){
			 		echo 'sucess';
			 	}
			 	else{
			 		echo 'fail';
			 	}
			 	header("location:index.php?cash=$cash&invoice=$invoice");
		 }
		 else{
		 	echo "<script>alert('Barcode is wrong no This items in Stock!');
    		 window.location.href='index.php?cash=$cash&invoice=$invoice';
    		 </script>";
		 }
	       
		  		
		  
	}


	//if no discount
   }
   else{
   	 $same = "SELECT * FROM tbl_pos_stockout WHERE code_out = '$pro' and invoice = '$invoice'";
    $resame = $connect->query($same);
    while ($row1 = $resame->fetch_assoc()) {
    	$c = $row1['code_out'];
    	$in = $row1['invoice'];
	}
	
    if( $pro == ''){
    	 echo "<script>alert('Please Choose Product Befor Click Add !');
    	 window.location.href='index.php?cash=$cash&invoice=$invoice';
    	 </script>"; 	
    }
    else if ( $c == $pro && $in == $invoice ) {
    		$product = "SELECT * FROM tbl_pos_stockin s INNER JOIN tbl_pos_product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product); 
		  	while($row = $repro->fetch_assoc())
			  { 
		          $cate = $row['cate_id'];
			}	
    		$up = "UPDATE tbl_pos_stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
    		mysqli_query($connect, $up);
    	
    	$upout = "UPDATE tbl_pos_stockout SET qty_out = qty_out + '$q2' , amount = qty_out * price , vat = amount * '$do_luy' WHERE code_out = '$pro' AND invoice = '$invoice'";
    	mysqli_query($connect, $upout);
    	header("location:index.php?cash=$cash&invoice=$invoice");
    }
    else {
		$product = "SELECT * FROM tbl_pos_stockin s LEFT JOIN tbl_pos_product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product);
			 $count = $repro->num_rows;
	       	if($count > 0)
	       	{
	       		while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code=$row["code_in"];
		            $name_en=$row["name_en"];
		            $name_kh=$row["name_kh"];
		            $q1=$row["qty_in"];
		            $cost=$row["price_riel"];
		            $price=$row["price_dolla"];
		            $amount = $price * $q2;
		            $cate = $row['cate_id'];

			}
			$vat = $q2 * $do_luy ;
				$balance = "UPDATE tbl_pos_stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
				mysqli_query($connect, $balance);

				$get_product_code = $connect->query("SELECT pro_id FROM tbl_pos_product WHERE code='$code'");
    			$v_pro_id = mysqli_fetch_object($get_product_code)->pro_id;
    			$v_user_id = $_SESSION['user']->id;
    			$date = date('Y-m-d');

				$stockout = "INSERT INTO tbl_pos_stockout ( invoice , code_out , pro_nameen, pro_namekh, qty_out,so_cost, price , amount ,discount, vat, date_out,pro_id,so_user_id)
			 	VALUES ( '$invoice', '$code', '$name_en', '$name_kh', '$q2', '$cost','$price', '$amount', '0', '$vat', '$date','$v_pro_id','$v_user_id')";
			 	$restockout = mysqli_query($connect, $stockout);
			 	if ($restockout){
			 		echo 'sucess';
			 	}
			 	else{
			 		echo 'fail';
			 	}
			 	header("location:index.php?cash=$cash&invoice=$invoice");
	       	}
	       	else{
	       		echo "<script>alert('Barcode is wrong no This items in Stock!');
    		 window.location.href='index.php?cash=$cash&invoice=$invoice';
    		 </script>";
	       	}
		  		
		  
	}
 }
?>