<?php 
    $menu_active =9998;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>   
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-trash fa-fw"></i><?= $lang_text['reportTransactionDelete'][$lang] ?></h2>
        </div>
    </div>
    <br> 
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th><?= $lang_text['action'][$lang] ?></th>
                        <th><?= $lang_text['invoice'][$lang] ?></th>
                        <th><?= $lang_text['cashedDate'][$lang] ?></th>
                        <th><?= $lang_text['checkinDate'][$lang] ?></th>
                        <th><?= $lang_text['customer'][$lang] ?></th>
                        <th><?= $lang_text['productModel'][$lang] ?></th>
                        <th><?= $lang_text['productStatus'][$lang] ?></th>
                        <th><?= $lang_text['boardNumber'][$lang] ?></th>
                        <th><?= $lang_text['problem'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['price'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['discount'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['subTotal'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['cost'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['profit'][$lang] ?></th>
                        <th><?= $lang_text['alertDate'][$lang] ?></th>
                        <th><?= $lang_text['finishedDate'][$lang] ?></th>
                        <th><?= $lang_text['fixByEmployee'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><em><?= $lang_text['status'][$lang] ?></em></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            $v_current_year = date('Y-m');
                            $get_data = $connect->query("SELECT *,
                                (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost,
                                ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount
                                FROM tbl_transaction_audit AS A 
                                LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                                LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                                LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                                LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
                                LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
                                LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
                            GROUP BY A.t_id
                            ORDER BY A.t_action_at DESC"); 
                        $i = 0;
                        $v_total_price = 0;
                        $v_total_cost = 0;
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<th>'.$row->t_action_at.' / '.$row->t_action_by.' / '.$row->t_action.'</th>';
                                echo '<td>'.sprintf('%08d',$row->t_id).'</td>';
                                echo '<th class="text-center">'.$row->t_date_cashed.'</th>';
                                echo '<td class="text-center">'.$row->t_date_received.'</td>';
                                echo '<td>'.$row->t_customer_phone_number.'</td>';
                                echo '<td><em>'.$row->name_en.'</em></td>';
                                echo '<td>'.$row->mt_name.'</td>';
                                echo '<td>'.$row->t_product_board_number.'</td>';
                                echo '<td><strong>'.$row->t_issue_description.'</storng></td>';
                                echo '<th class="text-center"><strong>'.number_format($row->t_fix_price,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format($row->sum_discount,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format($row->t_fix_price-$row->sum_discount,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format($row->sum_cost,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format(($row->t_fix_price-$row->sum_discount-$row->sum_cost),2).'</storng></th>';
                                echo '<td class="text-center">'.$row->t_alert_inform_date.'</td>';
                                echo '<td class="text-center">'.$row->t_date_finished.'</td>';
                                echo '<td>'.$row->name_english.'</td>';
                                echo '<td>'.$row->t_note.'</td>';
                                echo '<td><em>'.$row->ft_name.'</em></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>