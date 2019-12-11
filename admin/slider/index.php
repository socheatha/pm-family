<?php 
    $menu_active =2;
    $layout_title = "Welcome to Slider Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Slider Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info" style="width: 1180px;">
                <thead>
                    <tr role="row" class="text-center">
                        <th>N&deg;</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Index</th>
                        <th>Image</th>
                        <th style="min-width: 100px;" class="text-center">Action <i class="fa fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_slider ORDER BY sd_id DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->sd_title_en.'</td>';
                                echo '<td>'.$row->sd_description_en.'</td>';
                                echo '<td>'.$row->sd_created_at.'</td>';
                                echo '<td>'.$row->sd_updated_at.'</td>';
                                echo '<td>'.$row->sd_index.'</td>';
                                echo '<td><img src="../../img/img_slider/'.$row->sd_image.'"/></td>';
                                echo '<td class="text-center">';
                                    echo '<a href="edit.php?edit_id='.$row->sd_id.'&edit_img='.$row->sd_image.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a> ';
                                    echo '<a href="delete.php?del_id='.$row->sd_id.'&del_img='.$row->sd_image.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a> ';
                                    echo '<a href="../../slideshow_detail.php?slide_id='.$row->sd_id.'" target="_blank" class="btn btn-xs btn-info" title="copy"><i class="fa fa-info-circle fa-fw"></i></a> ';
                                    
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
