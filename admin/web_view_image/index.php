<?php  
    include_once '../../config/database.php';
    $menu_active = 49;
    $layout_title = "Welcome to User Page";
    include_once '../../config/athonication.php';
    include_once 'permission.php';
?> 
<?php include_once '../layout/header_frame.php'; ?>
<style type="text/css" media="screen">
    .dt-buttons{ display: none; }    
</style>
<div class="row">
    <div class="col-xs-12">
        <h3>
            <a href="add.php?parent_id=<?= @$_GET['parent_id'] ?>" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a> 
            Galleries
        </h3>
    </div>
</div>
<?php 
    $web_view_id = @$_GET['parent_id'];
    $get_data = $connect->query("SELECT A.*,B.username FROM tbl_project_images AS A 
        LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
        WHERE A.parent_id='$web_view_id'
        ORDER BY A.index ASC");
    $count_row = mysqli_num_rows($get_data);
?>
<table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info" style="width: 100%;">
    <thead>
        <tr role="row" class="text-center">
            <?php 
                for ($i=1; $i <= $count_row; $i++) { 
                    echo '<th class="text-center">Image Slider '.$i.'</th>';
                }
            ?>
        </tr>
    </thead>
    <tbody>                                 
        <?php 
            echo '<tr>';
            while ($row = mysqli_fetch_object($get_data)) {
                    echo '<td>'.$row->vinfo_title.' ['.$row->name.']<br>
                    <img src="../../img/project/'.$row->image.'" class="img-responsive"/><br>';
                    echo '<a href="delete.php?del_id='.$row->id.'&del_img='.$row->image.'&parent_id='.$web_view_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a> ';
                    echo '</td>';
            }
            echo '</tr>';
        ?>
        
        
    </tbody>
</table>       
<?php include_once '../layout/footer_frame.php'; ?>
