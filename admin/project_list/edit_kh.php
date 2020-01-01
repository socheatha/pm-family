<?php 
    $menu_active =49;
    $layout_title = "Edit News Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_add'])){
        $v_image = @$_FILES['txt_profile'];
        $v_id = @$_POST['txt_id'];
        $v_title = @$connect->real_escape_string($_POST['txt_title']); 
        $v_category = $connect->real_escape_string(@$_POST["txt_category"]);
        $v_type = $connect->real_escape_string(@$_POST["txt_type"]);
        $v_email_saler = $connect->real_escape_string(@$_POST["txt_email_saler"]);
        $v_phone_saler = $connect->real_escape_string(@$_POST["txt_phone_saler"]);
        $v_description = @$connect->real_escape_string($_POST['txt_description']); 
        $v_detail = @$connect->real_escape_string($_POST['txt_detail']); 
        if($v_image["name"] != ""){
            $old_image = @$_POST['txt_old_img'];
            if(file_exists("../../img/project/".$old_image)){
                unlink("../../img/project/".$old_image);
            }

            $new_name = date("Ymd")."_".rand(1111,9999)."_".$v_image["name"];
            move_uploaded_file($v_image["tmp_name"], "../../img/project/".$new_name);

            $query_update = "UPDATE tbl_projects SET
                    title_kh='$v_title',
                    category_id='$v_category',
                    `type_id`='$v_type',
                    profile='$new_name',
                    email_saler='$v_email_saler',
                    phone_saler='$v_phone_saler',
                    short_description_kh='$v_description',
                    detail_kh='$v_detail' WHERE id='$v_id'";
            
        }else{
            $query_update = "UPDATE tbl_projects SET
                    title_kh='$v_title',
                    category_id='$v_category',
                    `type_id`='$v_type',
                    email_saler='$v_email_saler',
                    phone_saler='$v_phone_saler',
                    short_description_kh='$v_description',
                    detail_kh='$v_detail' WHERE id='$v_id'";
        }
        if($connect->query($query_update)){
            $last_id = $v_id;
            $connect->query("DELETE FROM tbl_proj_feat WHERE project_id='{$last_id}'");
            foreach(@$_POST["txt_feature"] as $v_feature){
                $connect->query("INSERT INTO tbl_proj_feat (project_id,feature_id) 
                VALUES ('{$last_id}','{$v_feature}')");
            }
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
    $old_slider = $connect->query("SELECT 
        A.*,
        GROUP_CONCAT(B.feature_id) as old_features
    FROM tbl_projects AS A 
    LEFT JOIN tbl_proj_feat AS B ON B.project_id=A.id
    WHERE id='$edit_id'
    GROUP BY A.id
    ");
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
                 <form action="#" method="post" enctype="multipart/form-data" id="main_form">
                    <input type="hidden" name="txt_id" value="<?= @$row_old_slider->id ?>">
                    <input type="hidden" name="txt_old_img" value="<?= @$row_old_slider->profile ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                <img width="100%" src="../../img/project/<?= @$row_old_slider->profile ?>" class="img-responsive img-responsive img-thumbnail" alt="Image">
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Title Kh<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control" name="txt_title" placeholder="Enter title" required="required" autocomplete="off" value="<?= @$row_old_slider->title_kh ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Project Category <span class="required" aria-required="true">*</span></label>                                          
                                            <select class = "form-control selectpicker" data-live-search="true" name="txt_category" required>
                                                <option value="">Select Project Category</option>
                                                <?php
                                                    $position = mysqli_query($connect,"SELECT * FROM tbl_project_category ORDER BY name_en ASC");
                                                    while ($row1 = mysqli_fetch_assoc($position)) {
                                                        echo '<option value="'.$row1['id'].'" '.(@$row_old_slider->category_id==$row1['id']?'selected':'').'>'.$row1['name_en'].' - '.$row1['name_kh'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Date <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" required name="txt_date" type="text" placeholder="Date" value="<?= @$row_old_slider->date ?>">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Profile <span class="required" aria-required="true">*</span> </label>
                                            <input type="file" class="form-control" name="txt_profile" placeholder="Choose profile image" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Email Saler <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_email_saler" type="text" value="<?= @$row_old_slider->email_saler ?>">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Phone Saler <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_phone_saler" type="text" value="<?= @$row_old_slider->phone_saler ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Project Type <span class="required" aria-required="true">*</span></label>                                          
                                            <select class = "form-control" name="txt_type" required>
                                                <option value="">Select Project Type</option>
                                                <?php
                                                    $position = mysqli_query($connect,"SELECT * FROM tbl_project_type ORDER BY name_en ASC");
                                                    while ($row1 = mysqli_fetch_assoc($position)) {
                                                        echo '<option value="'.$row1['id'].'" '.(@$row_old_slider->type_id==$row1['id']?'selected':'').'>'.$row1['name_en'].' - '.$row1['name_kh'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label>Short Description Kh<span class="required" aria-required="true">*</span></label>
                                    <textarea rows="5" class="form-control" name="txt_description" placeholder="Enter short description" required="required" autocomplete="off"><?= @$row_old_slider->short_description_kh ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <br>
                                <div class="form-group">
                                    <label for ="" class="form-label"><strong>Features : </strong></label>  
                                    <?php
                                        $position = mysqli_query($connect,"SELECT * FROM tbl_project_feature ORDER BY name_en ASC");
                                        $old_features = explode(",",@$row_old_slider->old_features);
                                        while ($row1 = mysqli_fetch_assoc($position)) {
                                            echo '
                                                <input type="checkbox" '.(in_array($row1['id'],$old_features,TRUE) ?'checked':'').' form="main_form" id="feature_'.$row1['id'].'" value="'.$row1['id'].'" name="txt_feature[]">
                                                <label for ="feature_'.$row1['id'].'">'.$row1['name_en'].'-'.$row1['name_kh'].'</label>                                          
                                                &nbsp; &nbsp;
                                            ';
                                        }
                                    ?>  
                                </div>
                                <div class="form-group">
                                    <label>Detail Kh<span class="required" aria-required="true">*</span></label>
                                    <textarea class="form-control detail" id="detail" name="txt_detail" placeholder="Repeat your password" required="required" autocomplete="off"><?= @$row_old_slider->detail_kh ?></textarea>
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
