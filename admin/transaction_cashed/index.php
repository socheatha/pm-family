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
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['cashedTransaction'][$lang] ?></h2>
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
                <div class="form-group">
                    <select class="form-control selectpicker" data-live-search="true" name = "txt_employee"> 
                      <option value="">==<?= $lang_text['employee'][$lang] ?>==</option>
                      <?php 
                        $vv_search = $connect->query("SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                        while ($row_vv_search = mysqli_fetch_object($vv_search)) {
                          if($row_vv_search->emp_id == @$_POST['txt_employee']){
                            echo '<option SELECTED value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.'</option>';
                          }else{
                            echo '<option value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.'</option>';
                          }
                        }
                       ?>
                    </select>
                </div>
                <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> <?= $lang_text['search'][$lang] ?></button>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> <?= $lang_text['clear'][$lang] ?></a>
          </form> 
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
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
                        <th><?= $lang_text['action'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_POST['search'])){
                            $dateStart = $_POST['from'];
                            $dateEnd = $_POST['to'];
                            if($_POST['txt_employee'] != ""){
                                $v_option = $_POST['txt_employee'];
                                $get_data = $connect->query("SELECT *,
                                (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost,
                                ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount
                                FROM tbl_transaction AS A 
                                    LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                                    LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                                    LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                                    LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
                                    LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
                                    LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
                                WHERE A.t_fix_status='3' AND A.t_date_cashed BETWEEN '$dateStart' AND '$dateEnd' AND A.t_fix_by_employee='$v_option'
                                ORDER BY A.t_date_cashed DESC");
                            }else{
                                $get_data = $connect->query("SELECT *,
                                (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost,
                                ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount
                                FROM tbl_transaction AS A 
                                    LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                                    LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                                    LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                                    LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
                                    LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
                                    LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
                                WHERE A.t_fix_status='3' AND A.t_date_cashed BETWEEN '$dateStart' AND '$dateEnd'
                                ORDER BY A.t_date_cashed DESC");
                            }            
                        }else{
                            $v_current_year = date('Y-m');
                            $get_data = $connect->query("SELECT *,
                                (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost,
                                ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount
                                FROM tbl_transaction AS A 
                                LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                                LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                                LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                                LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
                                LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
                                LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
                            WHERE A.t_fix_status='3' AND DATE_FORMAT(A.t_date_cashed,'%Y-%m')='$v_current_year'
                            ORDER BY A.t_date_cashed DESC");
                        }   
                        $i = 0; 
                        $v_total_price = 0;
                        $v_total_cost = 0;
                        while ($row = mysqli_fetch_object($get_data)) {
                            $v_total_price += $row->t_fix_price-$row->sum_discount;
                            $v_total_cost += $row->sum_cost;
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.sprintf('%08d',$row->t_id).'</td>';
                                echo '<th class="text-center">'.$row->t_date_cashed.'</th>';
                                echo '<td class="text-center">'.$row->t_date_received.'</td>';
                                echo '<td>'.$row->t_customer_phone_number.'</td>';
                                echo '<td><em>'.$row->name_en.'</em></td>';
                                echo '<td>'.$row->mt_name.'</td>';
                                echo '<td>'.$row->t_product_board_number.'</td>';
                                echo '<td><strong>'.$row->t_issue_description.'</storng></td>';
                                echo '<td class="text-center"><strong>'.number_format($row->t_fix_price,2).'</storng></td>';
                                echo '<td class="text-center"><strong>'.number_format($row->sum_discount,2).'</storng></td>';
                                echo '<th class="text-center"><strong>'.number_format($row->t_fix_price-$row->sum_discount,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format($row->sum_cost,2).'</storng></th>';
                                echo '<th class="text-center"><strong>'.number_format(($row->t_fix_price-$row->sum_discount-$row->sum_cost),2).'</storng></th>';
                                echo '<td class="text-center">'.$row->t_alert_inform_date.'</td>';
                                echo '<td class="text-center">'.$row->t_date_finished.'</td>';
                                echo '<td>'.$row->name_english.'</td>';
                                echo '<td>'.$row->t_note.'</td>';
                                echo '<td class="text-center">';
								if (@$_SESSION['user']->position_id == 1){
									echo '<a href="print_preview.php?id='.$row->t_id.'" class="btn btn-xs blue">Print <i class="fa fa-print"></i></a>';
									echo '<a href="delete.php?del_id='.$row->t_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>';
								}else if (@$_SESSION['user']->position_id == 2){
									echo '<a href="print_preview.php?id='.$row->t_id.'" class="btn btn-xs blue">Print <i class="fa fa-print"></i></a>';
								}else if (@$_SESSION['user']->position_id == 3){
									
								}
                                echo '</td>';
                            echo '</tr>';
							
                        }
                    ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">$<?= number_format($v_total_price,2) ?></td>
                        <td class="text-center">$<?= number_format($v_total_cost,2) ?></td>
                        <td class="text-center">$<?= number_format(($v_total_price-$v_total_cost),2) ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>