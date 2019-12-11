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
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['stockAdjustAdministrator'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> <?= $lang_text['addNew'][$lang] ?>
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th><?= $lang_text['date'][$lang] ?></th>
                        <th><?= $lang_text['code'][$lang] ?></th>
                        <th><?= $lang_text['referenceName'][$lang] ?></th>
                        <th><?= $lang_text['name'][$lang] ?></th>
                        <th><?= $lang_text['qtyAdd'][$lang] ?></th>
                        <th><?= $lang_text['qtyMinus'][$lang] ?></th>
                        <th><?= $lang_text['employee'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><?= $lang_text['action'][$lang] ?> <i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_stock_adjust AS A
                        LEFT JOIN tbl_pos_product AS B ON A.sa_product_code=B.pro_id
                        LEFT JOIN tbl_pos_employee AS C ON A.sa_employee=C.emp_id
                              ");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->sa_date_record.'</td>';
                                echo '<td>'.$row->code.'</td>';
                                echo '<td>'.$row->ref.'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<th class="text-center">'.$row->sa_qty_add.'</th>';
                                echo '<th class="text-center">'.$row->sa_qty_minus.'</th>';
                                echo '<td>'.$row->name_english.'</td>';
                                echo '<td>'.$row->sa_note.'</td>';
                                echo '<td class="text-center"><a href="edit.php?edit_id='.$row->sa_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->sa_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                    </td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php' ?>
