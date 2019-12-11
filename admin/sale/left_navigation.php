<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <div class = "panel-body row">
                <form class="form-horizontal" method = "POST" action="save_sale.php">
                    <input type="hidden" value="<?= $v_vat ?>" name="txt_vat">
                        <div class="col-sm-12" style="margin-bottom: 10px;">
                            <label for="" style="font-family: 'khmer os content';">លុយបង់/Pay Amount ($) :</label>
                            <input onkeyup="calculate_money()" class="form-control" name="pay_dollar" required type="text" placeholder="Input $" autocomplete="off">
                        </div>
                      <div class="col-sm-12" style="margin-bottom: 10px;">
                        <label for="" style="font-family: 'khmer os content';">លុយបង់/Pay Amount (រ):</label>
                        <input onkeyup="calculate_money()" class="form-control" value="0" name="pay_riel" type="text" placeholder="Input Riel" autocomplete="off">
                      </div>
                      <div class="col-sm-12">
                        <label for="" style="font-family: 'khmer os content';">អតិថិជន/Customer :</label>
                        <select name="cus_name" id="" required="" class="form-control selectpicker" data-live-search="true">
                          <?php 
                            $customer = "SELECT * FROM tbl_pos_customer where no>=1";
                            $re_cus = mysqli_query($connect, $customer);
                            while($row_cus = $re_cus ->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row_cus['no']?>"><?php echo $row_cus['cus_name']?></option>
                            <?php
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-12"><br>
                        <button type="submit" name="print" class="btn btn-primary form-control" style="font-family: 'khmer os content';"><i class="fa fa-print" aria-hidden="true"></i> គិតលុយ</button>
                      </div>
                      <div class="col-sm-10 col-sm-offset-1">
                        <div class="row">
                          <div class="col-sm-6">
                           <?php
                            $id=$_GET['invoice'];
                            $sum= "SELECT sum(amount) FROM tbl_pos_stockout WHERE invoice = '$id'";
                            $result1 = $connect->query($sum);
                            for($i=0; $row1 = $result1->fetch_assoc(); $i++){
                              $subtotal=$row1['sum(amount)'];
                              $riel=$subtotal*$do_luy;
                            }
                            ?>
                            <input type="hidden" autocomplete="off" required="" id="txt_total_dollar" value="<?php echo number_format(round((float)$subtotal,2),2) ?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="hidden" autocomplete="off" required="" id="txt_total_riel" value="<?php echo number_format(round((int)$riel,2)) ?>">
                          </div>
                        </div>
                        <input type="hidden" id="exchange_rate" value="<?= $do_luy ?>">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="hidden" value="calculating" id="txt_pay_dollar">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="hidden" value="calculating" id="txt_pay_riel">
                          </div>
                        </div>
                    </div>    
                    <div class="form-group">
                        <div class="col-sm-12">
                          <input type="hidden" class="form-control" name ="no" value = "<?php echo $row_cus['no']?>">
                          <input type="hidden" class="form-control" name ="cash" value = "<?php echo $_GET['cash']?>">
                          <input type="hidden" class="form-control" name ="invoice" value = "<?php echo $_GET['invoice'] ?>">
                          <input type="hidden" class="form-control" name ="total" value = "<?php echo $subtotal;?>">
                          <input type="hidden" class="form-control" name ="totalk" value = "<?php echo $riel;?>">
                          <input type="hidden" class="form-control" name ="cashier" value = "<?php echo $_SESSION['user']->username; ?>">
                          <input type="hidden" class="form-control" name ="date" value = "<?php echo $time;?>">
                          <input type="hidden" class="form-control" name ="vat" value = "">
                        </div>
                    </div>
                </form>
            </div> 
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>