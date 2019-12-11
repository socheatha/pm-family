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
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['stockOutAdministrator'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th><?= $lang_text['date'][$lang] ?></th>
                        <th>Invoice</th>
                        <th><?= $lang_text['code'][$lang] ?></th>
                        <th><?= $lang_text['referenceName'][$lang] ?></th>
                        <th><?= $lang_text['productName'][$lang] ?></th>
                        <th><?= $lang_text['category'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['qty'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_stockout A 
                              LEFT JOIN tbl_pos_product B ON A.pro_id=B.pro_id
                              LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id ORDER BY A.date_out DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->date_out.'</td>';
                                echo '<td>'.sprintf('%08d',$row->invoice).'</td>';
                                echo '<td>'.$row->code.'</td>';
                                echo '<td>'.$row->ref.'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<td>'.$row->category_name.'</td>';
                                echo '<th class="text-center">'.$row->qty_out.'</th>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>
