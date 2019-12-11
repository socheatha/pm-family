<?php 
    $menu_active =1887;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>  
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['modelAdministrator'][$lang] ?></h2>
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
                        <th><?= $lang_text['model'][$lang] ?></th> 
                        <th class="text-center"><?= $lang_text['problem'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT *,
                            (SELECT COUNT(*) FROM tbl_pos_product_model_problem WHERE pmp_model=tbl_pos_product_model.pro_id) as count_problem
                        FROM tbl_pos_product_model ORDER BY name_en ASC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<th class="text-center"><a class="btn btn-xs blue btn-block" href="../product_problem_list/index.php?link_model_id='.$row->pro_id.'" class="btn btn-xs"><strong>'.$row->count_problem.'</strong></a></th>';
                                echo '<td>'.$row->note.'</td>';
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