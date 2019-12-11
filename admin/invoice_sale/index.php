<?php 
    $menu_active =1;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
 

<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Sale Invoice Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <form class="form-inline" method = "post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="start date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" name = "from" value="<?= @$_POST['from'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="end date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" name = "to" value="<?= @$_POST['to'] ?>"> 
                </div>
                <button type="submit" name="search" class="btn btn-success">Search</button>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
          </form> 
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th class="text-center">Invoice #</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Sub Total</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Vat</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Employee Name</th>
                        <th class="text-center">Detail</th>                    
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        if(isset($_POST['search'])){
                            $dateStart = $_POST['from'];
                            $dateEnd = $_POST['to'];
                            $get_data = $connect->query("SELECT A.*,U.*,B.*,SUM(S.discount) as sum_discount,SUM(S.qty_out*S.price) as sum_amount FROM tbl_pos_invoice A 
                                LEFT JOIN tbl_pos_customer B ON A.cus=B.no 
                                LEFT JOIN tbl_pos_user AS U ON U.id=A.user_id
                                LEFT JOIN tbl_pos_stockout AS S ON S.invoice=A.inv_no
                                WHERE A.date_sell BETWEEN '$dateStart' AND '$dateEnd' 
                                GROUP BY transaction_id
                                ");       
                        }else{
                            $v_date = date('Y-m-d');
                            $get_data = $connect->query("SELECT A.*,U.*,B.*,SUM(S.discount) as sum_discount,SUM(S.qty_out*S.price) as sum_amount FROM tbl_pos_invoice A 
                                LEFT JOIN tbl_pos_customer B ON A.cus=B.no 
                                LEFT JOIN tbl_pos_user AS U ON U.id=A.user_id
                                LEFT JOIN tbl_pos_stockout AS S ON S.invoice=A.inv_no
                                WHERE A.date_sell = '$v_date' 
                                GROUP BY transaction_id
                            ");
                        }                        
                        $i = 0;
                        $grandtotal = 0;
                        while ($row = mysqli_fetch_object($get_data)) {
                            $v_amount = $row->sum_amount;
                            $v_discout = $row->sum_discount;
                            $v_total = $v_amount-$v_discout;

                            $grandtotal += $v_total;
                            echo '<tr>';
                                echo '<td>'.sprintf('%08d',$row->inv_no).'</td>';
                                echo '<td>'.$row->date_sell.'</td>';
                                echo '<td>'.$row->cus_name.'</td>';
                                echo '<td class="text-center">$ '.number_format($v_amount,2).'</td>';
                                echo '<td class="text-center">$ '.number_format($v_discout,2).'</td>';
                                echo '<td class="text-center">'.number_format($row->vat).'%</td>';
                                echo '<td class="text-center">$ '.number_format($v_total,2).'</td>';
                                echo '<td>'.$row->username.'</td>';
                                echo '<td class="text-center"><a target="new" href="index_detail.php?id='.$row->inv_no.'" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th> 
                        <th class="text-center"></th>
                        <th></th> 
                        <th></th>
                        <th class="text-right">Total : </th>
                        <th class="text-center">$ <?= number_format($grandtotal,2) ?></th> 
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php' ?>
