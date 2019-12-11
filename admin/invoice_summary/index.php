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
            <h2><i class="fa fa-image fa-fw"></i> Summary Invoice Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <form class="form-inline" method = "post" action="">
          <div class="form-group">
            <input type="text" value="<?= @$_POST['from'] ?>" placeholder="start date" required="" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control" name = "from" value="<?= @$_POST['from'] ?>">
          </div>
          <div class="form-group">
            <input type="text" value="<?= @$_POST['to'] ?>" placeholder="end date" required="" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
          </div>
          <button type="submit" name="search" class="btn btn-success">Search</button>
          <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
      </form> 
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Net Profit</th>
                        <th class="text-center">Cost of Goods Sole</th>
                        <th class="text-center">Net Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total=0;
                        $i=1;
                        $total_amount = 0;
                        $total_vat = 0;
                        $total_grandtotal = 0;
                        $total_cost = 0;
                        $total_revenue = 0;

                        if(isset($_POST['search'])){
                            $from = $_POST['from'];
                            $to = $_POST['to'];
                            $sql = "SELECT *,SUM(A.amount) as sum_amount FROM tbl_pos_invoice AS A 
                                    -- LEFT JOIN tbl_pos_stockout AS S ON S.invoice=A.inv_no
                                    LEFT JOIN tbl_pos_customer AS B ON A.cus=B.no 
                                    WHERE A.date_sell between '$from' AND '$to' 
                                    GROUP BY A.date_sell ORDER BY A.date_sell DESC";
                            $result = $connect->query($sql);
                        }
                        while(@$row = mysqli_fetch_assoc(@$result)) 
                        {           
                            $v1=$row["transaction_id"];
                            $v2=$row["inv_no"];
                            $v7=$row['date_sell'];
                            $v3=$row["cashier_name"];
                            $v4=$row["cus_name"];
                            $v5=$row['sum_amount'];
                            $v6=$row["vat"]*$v5/100;
                            $total_amount += $v5;
                            $total_vat += $v6;
                            $total_grandtotal += $v5+$v6;
                                    
                            
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td class="text-center"><?= $v7 ?></td>
                        <td class="text-center">$<?= number_format($row['sum_amount'],2) ?></td>
                        <td class="text-center">$
                            <?php 
                                $get_cost = $connect->query("SELECT * from tbl_pos_stockout AS A 
                                    INNER JOIN tbl_pos_product AS P ON P.pro_id=A.pro_id 
                                    LEFT JOIN tbl_pos_invoice AS I ON I.inv_no=A.invoice 
                                    WHERE I.date_sell ='$v7'
                                    ");
                                $v_cost = 0;
                                while($row_get_cost = mysqli_fetch_object($get_cost)){
                                    $v_cost += $row_get_cost->price_riel*$row_get_cost->qty_out;
                                }
                                echo number_format($v_cost,2);
                                $total_cost += $v_cost;
                            ?>
                        </td>
                        <td class="text-center">$
                             <?php
                                $v_revenue = $v5-$v_cost;
                                echo number_format($v_revenue,2);
                                $total_revenue += $v_revenue;
                             ?>
                        </td>
                    </tr> 
                    <?php
                         $i++; 
                        }    
                    ?>  
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">Total :</th> 
                        <th class="text-center">$ <?= number_format($total_amount,2) ?></th>
                        <th class="text-center">$ <?= number_format($total_cost,2) ?></th>
                        <th class="text-center">$ <?= number_format($total_revenue,2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php' ?>
