<?php 
    $menu_active =49;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> Project List Administrator</h2>
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
                        <th>Info</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th class="text-center">Profile</th>
                        <th>Title</th>
                        <th>Contact</th>
                        <th class="text-center">Gallery</th>
                        <!-- <th>Short Description</th> -->
                        <th class="text-center"><?= $lang_text['action'][$lang] ?> <i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT 
                            A.*,B.username as name,
                            C.name_en,C.name_kh,
                            D.name_en AS type_name_en,
                            D.name_kh AS type_name_kh
                        FROM tbl_projects as A
                        LEFT JOIN tbl_pos_user AS B ON B.id=A.created_by
                        LEFT JOIN tbl_project_category AS C ON C.id=A.category_id
                        LEFT JOIN tbl_project_type AS D ON D.id=A.type_id
                        ORDER BY A.date DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>
                                    <i class="fa fa-calendar fa-fw"></i> '.$row->date.'<br>
                                    <i class="fa fa-user fa-fw"></i> '.$row->name.'
                                </td>';
                                echo '<td>'.$row->name_en.'<br>'.$row->name_kh.'</td>';
                                echo '<td>'.$row->type_name_en.'<br>'.$row->type_name_kh.'</td>';
                                echo '<td class="text-center">
                                    <a href="../../img/project/'.$row->profile.'" target="_blank"><img src="../../img/project/'.$row->profile.'" height="50px"/></a>
                                </td>';
                                echo '<td>
                                    <img src="../../img/flag/en.png"/>:'.$row->title_en.'<br>
                                    <img src="../../img/flag/kh.png"/>:'.$row->title_kh.'
                                </td>';
                                echo '<td>
                                    <i class="fa fa-envelope fa-fw"></i> '.$row->email_saler.'<br>
                                    <i class="fa fa-phone fa-fw"></i> '.$row->phone_saler.'
                                </td>';
                                echo '<td class="text-center">
                                    <a onclick="set_iframe('.$row->id.')" data-toggle="modal" href="#modal_detail" class="btn btn-xs btn-primary" title="gallery"><i class="fa fa-image"></i> Images </a>
                                </td>';
                                // echo '<td>
                                //     <img src="../../img/flag/en.png"/>:'.$row->short_description_en.'<br>
                                //     <img src="../../img/flag/kh.png"/>:'.$row->short_description_kh.'
                                // </td>';
                                echo '<td class="text-center">
                                    <a href="edit.php?edit_id='.$row->id.'" class="btn btn-xs btn-warning" title="edit"><img src="../../img/flag/en.png"/> <i class="fa fa-edit"></i></a>
                                    <a href="edit_kh.php?edit_id='.$row->id.'" class="btn btn-xs btn-warning" title="edit"><img src="../../img/flag/kh.png"/> <i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->id.'&del_img='.$row->profile.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="modal_detail">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-body">
                <iframe id="result" src="" width="100%" style="min-height: 600px; resize: vertical;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function set_iframe(e){
        document.getElementById('result').src = '../web_view_image/index.php?parent_id='+e;
    }
</script>
