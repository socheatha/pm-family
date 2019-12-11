<?php 
    $menu_active =2;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>  
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['productAdministrator'][$lang] ?></h2>
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
                        <th><?= $lang_text['code'][$lang] ?></th>
                        <th><?= $lang_text['referenceName'][$lang] ?></th>
                        <th><?= $lang_text['productName'][$lang] ?></th>
                        <th><?= $lang_text['category'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['price'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['cost'][$lang] ?></th>    
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><?= $lang_text['action'][$lang] ?> <i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_product LEFT JOIN tbl_pos_category ON tbl_pos_product.cate_id = tbl_pos_category.cate_id ORDER BY pro_id DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->code.'</td>';
                                echo '<td>'.$row->ref.'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<td>'.$row->category_name.'</td>';
                                echo '<th class="text-center">'.$row->price_dolla.'</th>';
                                echo '<th class="text-center">'.$row->price_riel.'</th>';
                                echo '<td>'.$row->note_pro.'</td>';
                                echo '<td class="text-center"><a href="edit.php?edit_id='.$row->pro_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->pro_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
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