<?php
include '../../config/database.php';
ob_start();
$v_user_id = $_SESSION['user']->id;


$select = "SELECT * FROM tbl_pos_invoice Order by transaction_id desc ";
  $query_select = $connect->query($select);
  $sel = $query_select->fetch_array();
  $tt = $query_select->num_rows;
  $no = $sel['transaction_id'];
  $no1 = $sel['inv_no'];
  $finalcode = '';

  if($tt > 0 ){
     $finalcode = $no1 + 1;
  }
  else{
     $finalcode = $no + 1;
  }

if (isset($_POST['print'])) {
    $cus = $_POST['cus_name'];
    $invoice = $_POST['invoice'];
    $cashier = $_POST['cashier'];
    // $date = $_POST['date'];
    $date = date('Y-m-d');
    $total = $_POST['total'];
    $vat = $_POST['txt_vat'];
    $cus = $_POST['cus_name'];
    $pay_dollar = $_POST['pay_dollar'];
    $pay_riel = $_POST['pay_riel'];
    $select = "select * from tbl_pos_invoice";
    $resultselect = mysqli_query($connect , $select);
    while($row = $resultselect->fetch_assoc()){
      $inv = $row['inv_no'];
    } 
    if ($total == 0 ){

      echo "<script>alert('Please Choose Product Befor Total  !');
           window.location.href='index.php?cash=$cash&invoice=$invoice';
           </script>";

    } 
    else if ( $invoice == $inv ){
        $update = "UPDATE tbl_pos_invoice SET amount = '$total',
                                      vat = '$vat' ,
                                     
                                      pay_dollar = '$pay_dollar',
                                      pay_riel = '$pay_riel'
                                        WHERE 
                                   inv_no = '$invoice'";
          mysqli_query($connect, $update);
          header("location:print_preview.php?invoice=$invoice");
          }
    else{

        $insert = "INSERT INTO tbl_pos_invoice (inv_no, cashier_name , cus , date_sell , amount , vat, pay_dollar, pay_riel,user_id  ) 
        VALUES ( '$invoice' , '$cashier' , '$cus' , '$date' , '$total' , '$vat', '$pay_dollar', '$pay_riel', '$v_user_id')";
//        echo $insert;
        $resultinsert = mysqli_query($connect, $insert); 
        if($resultinsert){
          header("location:print_preview.php?invoice=$invoice");}
        }
}

if (isset($_POST['back'])) {
    $cash = $_POST['cash'];
    $invoice = $_POST['invoice'];
    $cashier = $_POST['cashier'];
    $date = $_POST['date'];
    $total = $_POST['total'];
    $vat = $_POST['txt_vat'];
     $cus = $_POST['cus_name'];
    $pay_dollar = $_POST['pay_dollar'];
    $pay_riel = $_POST['pay_riel'];
    $select = "select * from invoice";
    $resultselect = mysqli_query($connect , $select);
    while($row = $resultselect->fetch_assoc()){
      $inv = $row['inv_no'];
    } 
    if ($total == 0 ){

      echo "<script>alert('Please Choose Product Befor Total  !');
           window.location.href='index.php?cash=$cash&invoice=$invoice';
           </script>";

    } 
    else if ( $invoice == $inv ){
        $update = "UPDATE tbl_pos_invoice SET amount = '$total',
                                      vat = '$vat' ,
                                      
                                      pay_dollar = '$pay_dollar',
                                      pay_riel = '$pay_riel'
                                        WHERE 
                                   inv_no = '$invoice'";
          $result = mysqli_query($connect, $update);
            if ($result) {
              header("location:back.php?b=1");
            }
            
          }
    else{

        $insert = "INSERT INTO tbl_pos_invoice (inv_no, cashier_name , cus , date_sell , amount , vat,pay_dollar,pay_riel,user_id ) 
        VALUES ( '$invoice' , '$cashier' , '$cus' , '$date' , '$total' , '$vat', '$pay_dollar','$pay_riel','$v_user_id' )";
        $resultinsert = mysqli_query($connect, $insert);
        if ($resultinsert) {
            header("location:back.php?b=1");
         } 
    }
}


?>