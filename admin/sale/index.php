<?php 
    $menu_active =999;
    $layout_title = "Welcome to System";;
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
?> 
<?php 
    
    ob_start();
    $inv = "";
    if(isset($_SESSION['user']->id)) {
      $user_id = $_SESSION['user']->id;
      $sql = "SELECT * FROM tbl_pos_user WHERE id = $user_id";
      $query = $connect->query($sql);
      $show = $query->fetch_array();
    }

  $time = date("m/d/Y");

  $ex = "SELECT * FROM tbl_pos_exchange";
  $reex = $connect->query($ex);
  $do = $reex->fetch_assoc();
  $do_luy = $do['exchange'];

  $v = "SELECT * FROM tbl_pos_vat";
  $rev = $connect->query($v);
  $a = $rev->fetch_assoc();
  $pun = $a['vat'];
  $v_vat = $a['vat'];
    
  $customer = "SELECT * FROM tbl_pos_customer";
  $re_cus = mysqli_query($connect, $customer);
  $row_cus = $re_cus ->fetch_assoc();
?>

<?php include_once '../layout/header.php'; ?>
<style type="text/css">
    .modal-backdrop{ border: 1px solid red; display: none; }
</style>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px">
                    <form action="incomming.php" method="post">
                    <div class="col-xs-12">
                            <input type="hidden"  name = "cus" value = "<?php echo @$_GET['cus']?>">
                            <input type="hidden"  name = "seller " value = "<?php echo @$show['username']?>">
                            <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
                            <input type="hidden" name="cash" value="<?php echo $_GET['cash']; ?>" />
                            <input type="hidden" class="form-control" name = "date" value = "<?php echo $time?>">
                            <input type = "hidden"  value="<?php echo @$_GET['pay']?>">
                    </div>
                    <div class="panel panel-default" style="margin-bottom: 0px;"> 
                        <div class="panel-heading" style="background: linear-gradient(#777 1%,#333 5%,#333 95%,#777 99%); color:#ddd;"> 
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="" style="font-family: 'khmer moul';"><i class="fa fa-barcode" aria-hidden="true"></i> លេខកូដទំនិញ | Merchandise Code :</label>
                                        <!-- <input type="text" class="form-control" name="" autofocus> -->
                                        <select name="product" class="form-control selectpicker" onchange="form.submit()" data-live-search="true" autofocus="">
                                            <option value=""></option>
                                            <?php 
                                                $v_get_product = $connect->query("SELECT * FROM tbl_pos_product ORDER BY code ASC");
                                                while ($v_row_product = mysqli_fetch_object($v_get_product)) {
                                                    echo '<option value="'.$v_row_product->code.'">'.$v_row_product->code.' :: '.$v_row_product->ref.' :: '.$v_row_product->name_en.' :: '.$v_row_product->name_en.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label for="" style="font-family: 'khmer moul';">ចំនួន | Amount :</label>
                                        <input type="number" class="form-control" name="qty" value="1"  placeholder="Qty" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label for="" style="font-family: 'khmer moul';">បញ្ចុះតំលៃ | Discount :</label>
                                        <input type="number" step="any" min="0" max="100" name="discount" class="form-control" value="" autocomplete="off"/ placeholder="%">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" style = "background: transparent;border: 0px;"class=""></button>
                                </div>
                           
                            </div>
                        </div>
                      </form>
                        <div class = "panel-body" style="padding: 9px; background: #eee;">
                            <div class="table-responsive">          
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <td style="font-family: 'khmer os content'; color: #444;">
                                                កូដ<br>Code<br>
                                            </td>
                                            <td style="font-family: 'khmer os content'; color: #444;">
                                                ឈ្មោះជាអង់គ្លេស<br>Name in English
                                            </td>
                                            <td style="font-family: 'khmer os content'; color: #444;">
                                                ឈ្មោះទំនិញ<br>Name in Khmer
                                            </td>
                                            <td class="text-center" style="font-family: 'khmer os content'; color: #444;">
                                                ចំនួន<br>Amount
                                            </td>
                                            <td class="text-center" style="font-family: 'khmer os content'; color: #444;">
                                                តំលៃ<br>Price
                                            </td>
                                            <td class="text-center" style="font-family: 'khmer os content'; color: #444;">
                                                បញ្ចុះតំលៃ<br>Discount
                                            </td>
                                            <td class="text-center" style="font-family: 'khmer os content'; color: #444;">
                                                សរុប<br>Total
                                            </td>
                                            <td class="text-center" style="font-family: 'khmer os content'; color: #444;">
                                                កែប្រែ
                                                <br>Edit
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $id=$_GET['invoice'];
                                                $sql = "SELECT * FROM tbl_pos_stockout AS A
                                                LEFT JOIN tbl_pos_product AS B ON B.pro_id=A.pro_id
                                                WHERE invoice = '$id' "; 
                                                $result = $connect->query($sql);
                                                while($row = @$result->fetch_assoc()) 
                                                {     
                                                  $barcode=$row["code_out"];
                                                  $name_en=$row["name_en"];
                                                  $name_kh=$row["name_kh"];
                                                  $qty=$row["qty_out"];
                                                  $price=$row["price"];
                                                  $dis = $row["discount"];
                                                  $amount =$row['amount'];
                                                  $vat = $row['vat']  ;       
                                                ?>
                                        <tr>
                                            <td><?php echo $barcode;?></td>
                                            <td><?php echo $name_en;?></td>
                                            <td><?php echo $name_kh;?></td>
                                            <td class="text-center"><?= number_format($qty,0) ?></td>
                                            <td class="text-center"><?= number_format($price,2) ?></td>
                                            <td class="text-center"><?= number_format($dis,2) ?></td>
                                            <td class="text-center"><?= number_format($amount,2) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#<?php echo $row['transaction_id']?>"><i class="fa fa-edit"></i></button>

                                                <!-- Modal -->
                                                <div id="<?php echo $row['transaction_id']?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Code : <?php echo $row['code_out']?></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                              <form action="edit_price.php" method = "post">
                                                                <div class="row">
                                                                    <div class="form-group col-sm-6">
                                                                      <label for="">Old Price :</label>
                                                                      <input type="text" name = "oldprice" class="form-control" value="<?php echo $price?>">
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                      <label for="">New price :</label>
                                                                      <input type="text" name = "newprice" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                      <label for=""> </label>
                                                                      <input type="hidden" name = "dis" class="form-control" placeholder="%">
                                                                    </div>
                                                                      <input type="hidden" name = "id" class="form-control" value="<?php echo $row['transaction_id']?>">
                                                                      <input type="hidden" name = "invoice" class="form-control" value="<?php echo $_GET['invoice']; ?>">
                                                                      <input type="hidden" name = "cash" class="form-control" value="<?php echo $_GET['cash']; ?>">
                                                                      <input type="hidden" name = "qty" class="form-control" value="<?php echo $row['qty_out'];?>">
                                                                      <input type="hidden" name = "code" class="form-control" value="<?php echo $row['code_out'];?>">
                                                                    <div class="form-group col-sm-12">
                                                                      <button type = "submit" class = "btn btn-success ">Change</button>
                                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                              </form>
                                                            </div>
                                                        </div>

                                                     </div>
                                                </div>
                                                <a href="delete_item.php?id=<?php echo $row['transaction_id'];?>&invoice=<?php echo $_GET['invoice']; ?>&cash=<?php echo $_GET['cash']; ?>&qty=<?php echo $row['qty_out'];?>&code=<?php echo $row['code_out'];?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <table align="right" style="border: 1px solid rgba(0,0,0,0);">
                                    <tr>
                                        <td class="text-right" style="font-family: 'khmer os content';"><label>តម្លៃ/Sub Total ($) : </label></td>
                                        <td>
                                            <?php
                                            $id=$_GET['invoice'];
                                            $sum= "SELECT sum(qty_out*price) FROM tbl_pos_stockout WHERE invoice = '$id'";
                                            $result2 = $connect->query($sum);
                                            for($i=0; $row2 = $result2->fetch_assoc(); $i++){
                                            $v_price=$row2['sum(qty_out*price)'];
                                            //echo $subtotal. ' $ ';
                                            }
                                            ?>
                                            <strong>
                                                <input type="text" class="" readonly style="text-align:center; width: 100%;" value="<?php echo number_format(round((float)$v_price,2),2) ?> $">
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td class="text-right"  style="font-family: 'khmer os content';"><label>បញ្ចុះតំលៃ/Discount ($) : </label></td>
                                        <td>
                                            <?php
                                            $id=$_GET['invoice'];
                                            $sum= "SELECT sum(discount) FROM tbl_pos_stockout WHERE invoice = '$id'";
                                            $result1 = $connect->query($sum);
                                            for($i=0; $row1 = $result1->fetch_assoc(); $i++){
                                            $disc=$row1['sum(discount)'];
                                            //echo $disc. ' $ ';
                                            }
                                            ?>
                                            <strong>
                                                <input type="text" class="" readonly style="text-align:center; width: 100%;" value="<?php echo number_format(round((float)$disc,2),2) ?> $">
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>   
                                        <td class="text-right"  style="font-family: 'khmer os content';"><label>សរុបជា/Total ($) : </label></td>
                                        <td>
                                            <?php
                                            $id=$_GET['invoice'];
                                            $sum= "SELECT sum(amount) FROM tbl_pos_stockout WHERE invoice = '$id'";
                                            $result1 = $connect->query($sum);
                                            for($i=0; $row1 = $result1->fetch_assoc(); $i++){
                                              $subtotal=$row1['sum(amount)'];
                                            }
                                            ?>
                                            <strong>
                                                <input type="text" class="" readonly style="text-align:center; width: 100%;" value="<?php echo number_format(round((float)$subtotal,2),2) ?> $">
                                            </strong>
                                        </td>    
                                    </tr>
                                    <tr>   
                                        <td class="text-right"  style="font-family: 'khmer os content';"><label>សរុបជា/Total (៛) : </label></td>
                                        <td>
                                            <?php
                                                $id=$_GET['invoice'];
                                                $sum= "SELECT sum(amount) FROM tbl_pos_stockout WHERE invoice = '$id'";
                                                $result1 = $connect->query($sum);
                                                for($i=0; $row1 = $result1->fetch_assoc(); $i++){
                                                  $subtotal=$row1['sum(amount)'];
                                                  $riel = $subtotal * $do_luy;
                                                }
                                            ?>
                                            <strong>
                                                <input type="text" class="" readonly style="text-align:center; width: 100%;" value="<?php echo number_format(round((int)$riel,2)) ?> ៛">
                                            </strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class = "panel-body">
                            <table style="font-family: 'khmer os content'; font-weight: bold;">
                                <tr>
                                    <td>សរុបដុល្លារ​ (USD) </td>
                                    <td>: <input id="txt_change_total_dollar" value="calculating"></td>
                                    <td width="20px"></td>
                                    <td>លុយអាប់ដុល្លារ (USD) </td>
                                    <td>: <input id="txt_change_before_dollar" value="calculating"></td>
                                </tr>
                                <tr>
                                    <td>សរុបរៀល (RIEL) </td>
                                    <td>: <input id="txt_change_total_riel" value="calculating"></td>
                                    <td></td>
                                    <td>លុយអាប់រៀល (RIEL) </td>
                                    <td>: <input id="txt_change_after_riel" value="calculating"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="../../assets/global/plugins/jquery.min.js"></script>
<!-- Page script -->
<script>
     $(function(){
       $("#date").datepicker({
           changeMonth : true,
           changeYear : true
       });
    });
     function calculate_money(){
    
      $v_price_dollar = $('input#txt_total_dollar').val();
      // $v_price_dollar = $('input#txt_total_riel').val();
      $v_pay_dollar = $('input[name=pay_dollar]').val();
      $v_pay_riel = $('input[name=pay_riel]').val();
      $("input#txt_pay_dollar").val($v_pay_dollar);
      $("input#txt_pay_riel").val($v_pay_riel);

      $v_exchange_rate = $('input#exchange_rate').val();
      $v_total_pay = parseFloat($v_pay_dollar)+(parseFloat($v_pay_riel)/parseFloat($v_exchange_rate));
      $v_change_dollar =  $v_total_pay - $v_price_dollar;
      $v_change_riel = $v_change_dollar*$v_exchange_rate;
      $('input#txt_change_total_dollar').val($v_change_dollar.toFixed(2));
      $('input#txt_change_total_riel').val(Math.floor($v_change_riel));
      
      $v_F_dollar = Math.floor($v_change_dollar);
      $v_A_dollar = $v_change_dollar - $v_F_dollar;
      $v_F_riel = $v_A_dollar*$v_exchange_rate;
      // alert($v_A_dollar);

      $("input#txt_change_before_dollar").val(Math.floor($v_F_dollar));
      $("input#txt_change_after_riel").val(Math.floor($v_F_riel));
    
   }
</script>
<?php include_once '../layout/footer.php' ?>

