<?php 
    $menu_active =49;
    $layout_title = "Add Slider Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header_frame.php';
?>
<?php 
    if(@$_GET['parent_id']){
        $back_id = @$_GET['parent_id'];
    }
?>


<?php 
    if(isset($_POST['btn_add'])){
        $v_image = @$_FILES['txt_image'];
        if($v_image["name"] != ""){
            $new_name = date("Ymd")."_".rand(1111,9999).".png";
            move_uploaded_file($v_image["tmp_name"], "../../img/project/".$new_name);
            $v_index_order = @$connect->real_escape_string($_POST['txt_index']);
            $v_title = @$connect->real_escape_string($_POST['txt_title']);
            $v_user_id = @$_SESSION['user']->user_id;


            $query_add = "INSERT INTO tbl_project_images (
                    `parent_id`,
                    `name`,
                    `image`,
                    `index`,
                    `created_by`) 
                VALUES(
                    '$back_id',
                    '$v_title',
                    '$new_name',
                    '$v_index_order',
                    '$v_user_id')";
            if($connect->query($query_add)){
                $sms = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Successfull!</strong> Data inserted ...
                </div>'; 
            }else{
                $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error!</strong> Query error  ('.mysqli_error($connect).')...
                </div>';   
            }
        }else{
            $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Please Insert Image ...
                </div>';
        }
    }

?>
<div class="row">
    <div class="col-xs-12">
        <?= @$sms ?>
        <h3>
            <a href="index.php?parent_id=<?= $back_id ?>" id="sample_editable_1_new" class="btn red"> 
                <i class="fa fa-arrow-left"></i>
                Back
            </a>
            Create Record
        </h3>
    </div>
</div>
<div class="portlet-body">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Input Information</h3>
        </div>
        <div class="panel-body">
                <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            
                            <label>Image
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <input type="file" class="form-control" name="txt_image" required="required" autocomplete="off">
                            <br>

                            <label>Title
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <input type="text" class="form-control" name="txt_title" required="required" autocomplete="off">
                            <br>


                            <label>Index
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <input value="0" type="text" class="form-control" name="txt_index" required="required" autocomplete="off">
                            <br>

                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <button type="submit" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i>Save</button>
                            <button type="reset" class="btn yellow"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                            <a href="index.php?parent_id=<?= $back_id ?>" class="btn red"><i class="fa fa-undo fa-fw"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </form><br>
        </div>
    </div>
</div>
<?php include_once '../layout/footer_frame.php' ?>
