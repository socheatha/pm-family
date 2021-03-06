<?php 
    $menu_active =44;
    $layout_title = "Edit News Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_add'])){
        $v_id = @$_POST['txt_id'];
        $v_title = @$connect->real_escape_string($_POST['txt_title']); 
        $v_index = @$connect->real_escape_string($_POST['txt_index']); 
        $v_description = @$connect->real_escape_string($_POST['txt_description']); 
        $v_detail = @$connect->real_escape_string($_POST['txt_detail']); 

        $query_update = "UPDATE tbl_about_us SET
            `title_en`='$v_title',
            `index`='$v_index',
            `short_description_en`='$v_description',
            `detail_en`='$v_detail' WHERE id='$v_id'";
        
        if($connect->query($query_update)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>'; 
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';   
        }
    }


// get old data 
    $edit_id = @$_GET['edit_id'];
    $edit_img = @$_GET['edit_img'];
    $old_slider = $connect->query("SELECT * FROM tbl_about_us WHERE id='$edit_id'");
    $row_old_slider = mysqli_fetch_object($old_slider);


 ?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-plus-circle fa-fw"></i>Edit Record</h2>
        </div>
    </div>
    
    <br>
    <br>

    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="index.php" id="sample_editable_1_new" class="btn red"> 
                <i class="fa fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Input Information</h3>
            </div>
            <div class="panel-body">
                 <form action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txt_id" value="<?= @$row_old_slider->id ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Title En<span class="required" aria-required="true">*</span></label>
                                    <input type="text" class="form-control" name="txt_title" placeholder="Enter title" required="required" autocomplete="off" value="<?= @$row_old_slider->title_en ?>">
                                </div>
                                <div class="form-group">
                                    <label>Index <span class="required" aria-required="true">*</span> </label>
                                    <input type="text" class="form-control" name="txt_index" placeholder="Index" autocomplete="off" value="<?= @$row_old_slider->index ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Short Description En<span class="required" aria-required="true">*</span></label>
                                    <textarea rows="5" class="form-control" name="txt_description" placeholder="Enter short description" required="required" autocomplete="off"><?= @$row_old_slider->short_description_en ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <br>
                                <div class="form-group">
                                    <label>Detail En<span class="required" aria-required="true">*</span></label>
                                    <textarea class="form-control detail" id="detail" name="txt_detail" placeholder="Repeat your password" required="required" autocomplete="off"><?= @$row_old_slider->detail_en ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_add" class="btn green"><i class="fa fa-check fa-fw"></i>Update</button>
                                <button type="reset" class="btn yellow"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                                <a href="index.php" class="btn red"><i class="fa fa-undo fa-fw"></i>Cancel</a>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="../../plugin/ckeditor_4.7.0_full/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'detail', {
        language: 'en',
        height: '700'
        // uiColor: '#9AB8F3'
    });
</script>


<?php include_once '../layout/footer.php' ?>
