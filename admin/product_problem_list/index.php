<?php 
    $menu_active =1887;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>  
<?php 
    if(@$_GET['link_model_id']) $_SESSION['link_model_id']=@$_GET['link_model_id'];
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['problemAdministrator'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <?php if(@$_SESSION['link_model_id']){ echo '<a href="../product_model_list" class="btn red"><i class="fa fa-arrow-left"></i></a>'; } ?>
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
                        <th><?= $lang_text['problem'][$lang] ?></th> 
                        <th class="text-center"><?= $lang_text['cost'][$lang] ?></th> 
                        <th class="text-center"><?= $lang_text['price'][$lang] ?> | <?= $lang_text['newMachine'][$lang] ?></th> 
                        <th class="text-center"><?= $lang_text['price'][$lang] ?> | <?= $lang_text['oldMachine'][$lang] ?></th> 
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        if(@$_SESSION['link_model_id']){
                            $get_data = $connect->query("SELECT A.*,B.name_en FROM tbl_pos_product_model_problem AS A 
                                LEFT JOIN tbl_pos_product_model AS B ON B.pro_id=A.pmp_model
                                WHERE A.pmp_model='$_SESSION[link_model_id]'
                            ORDER BY A.pmp_name ASC");
                        }else{
                            $get_data = $connect->query("SELECT A.*,B.name_en FROM tbl_pos_product_model_problem AS A 
                                LEFT JOIN tbl_pos_product_model AS B ON B.pro_id=A.pmp_model
                            ORDER BY A.pmp_name ASC");
                        }
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->name_en.'</td>';
                                echo '<td>'.$row->pmp_name.'</td>';
                                echo '<th class="text-center">'.number_format($row->pmp_cost,2).'</th>';
                                echo '<th class="text-center">'.number_format($row->pmp_price,2).'</th>';
                                echo '<th class="text-center">'.number_format($row->pmp_price_extra,2).'</th>';
                                echo '<td>'.$row->pmp_note.'</td>';
                                echo '<td class="text-center"><a href="edit.php?edit_id='.$row->pmp_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->pmp_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
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