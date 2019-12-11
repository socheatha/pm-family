<?php 
    $menu_active =2;
    $layout_title = "Add Slider Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_add'])){
        $v_image = @$_FILES['txt_image'];
        if($v_image["name"] != ""){
            $new_name = date("Ymd")."_".rand(1111,9999)."_".$v_image["name"];
            move_uploaded_file($v_image["tmp_name"], "../../img/img_slider/".$new_name);
            $v_title = @$connect->real_escape_string($_POST['txt_title']);
            $v_description = @$connect->real_escape_string($_POST['txt_description']);
            $v_detail = @$connect->real_escape_string($_POST['txt_detail']);

            $query_add = "INSERT INTO tbl_slider (
                    sd_title_en,
                    sd_title_kh,
                    sd_title_cn,
                    sd_image,
                    sd_description_en,
                    sd_description_kh,
                    sd_description_cn,
                    sd_detail_en,
                    sd_detail_kh,
                    sd_detail_cn) 
                VALUES(
                    '$v_title',
                    '$v_title',
                    '$v_title',
                    '$new_name',
                    '$v_description',
                    '$v_description',
                    '$v_description',
                    '$v_detail',
                    '$v_detail',
                    '$v_detail')";
            if($connect->query($query_add)){
                $sms = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Successfull!</strong> Data inserted ...
                </div>'; 
            }else{
                $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error!</strong> Query error ...
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


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-plus-circle fa-fw"></i>Create Record</h2>
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
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Title <span class="required" aria-required="true">*</span> </label>
                                    <input type="text" class="form-control" name="txt_title" placeholder="Enter your name" required="required" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Image <span class="required" aria-required="true">*</span> </label>
                                    <input type="file" class="form-control" name="txt_image" placeholder="Enter your email" required="required" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Description <span class="required" aria-required="true">*</span> </label>
                                    <textarea style="height: 109px;" class="form-control" name="txt_description" placeholder="Repeat your password" required="required" autocomplete="off"></textarea>
                                </div>
                            </div>
                            <hr><hr><hr><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Detail <span class="required" aria-required="true">*</span>  </label>
                                    <textarea style="height: 290px;" class="form-control detail" id="detail" name="txt_detail" placeholder="Repeat your password" required="required" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i>Save</button>
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
        height: '300'
        // uiColor: '#9AB8F3'
    });
</script>


<?php include_once '../layout/footer.php' ?>
