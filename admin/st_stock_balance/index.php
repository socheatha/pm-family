<?php 
    $menu_active =3;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['stockBalance'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th><?= $lang_text['code'][$lang] ?></th>
                        <th><?= $lang_text['referenceName'][$lang] ?></th>
                        <th><?= $lang_text['productName'][$lang] ?></th>
                        <th><?= $lang_text['category'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['in'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['out'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['adjust'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['balance'][$lang] ?></th>
                        <th><?= $lang_text['status'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_product AS B
                        LEFT JOIN tbl_pos_category E ON B.cate_id=E.cate_id
                         ORDER BY code ASC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->code.'</td>';
                                echo '<td>'.$row->ref.'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<td>'.$row->category_name.'</td>';
                                $v_get_qty_in = $connect->query("SELECT SUM(qty_in) AS s_qty_in FROM tbl_pos_stockin WHERE pro_id=".$row->pro_id);
                                $v_row_qty_in = mysqli_fetch_object($v_get_qty_in);
                                $v_qty_in = $v_row_qty_in->s_qty_in+0;
                                
                                $v_get_qty_out = $connect->query("SELECT SUM(qty_out) AS s_qty_out FROM tbl_pos_stockout WHERE pro_id=".$row->pro_id);
                                $v_row_qty_out = mysqli_fetch_object($v_get_qty_out);
                                $v_qty_out = $v_row_qty_out->s_qty_out+0;

                                $v_get_qty_adjust = $connect->query("SELECT SUM(sa_qty_add-sa_qty_minus) AS s_qty_adjust FROM tbl_pos_stock_adjust WHERE sa_product_code=".$row->pro_id);
                                $v_row_qty_adjust = mysqli_fetch_object($v_get_qty_adjust);
                                $v_qty_adjust = $v_row_qty_adjust->s_qty_adjust+0;

                                $v_qty_balance = $v_qty_in-$v_qty_out+$v_qty_adjust+0;
                                echo '<th class="text-center">'.$v_qty_in.'</th>';
                                echo '<th class="text-center">'.$v_qty_out.'</th>';
                                echo '<th class="text-center">'.$v_qty_adjust.'</th>';
                                echo '<th class="text-center">'.$v_qty_balance.'</th>';
                                echo '<td>';
                                if($v_qty_balance <= 2 & $v_qty_balance > 0){ echo '<em><span class="text text-warning">Low Stock</span></em>'; } elseif ($v_qty_balance <= 0 ){ echo '<em><span class="text text-danger">Out Of Stock</span></em>'; } else{ echo '<em><span class="text text-success">Available</span></em>'; }
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php' ?>
