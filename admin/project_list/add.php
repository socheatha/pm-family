<?php 
    $menu_active =49;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>

<?php 

    if(isset($_POST["btn_add"])){
        $v_title = $connect->real_escape_string(@$_POST["txt_title"]);
        $v_category = $connect->real_escape_string(@$_POST["txt_category"]);
        $v_features = $connect->real_escape_string();
        $v_type = $connect->real_escape_string(@$_POST["txt_type"]);
        $v_date = $connect->real_escape_string(@$_POST["txt_date"]);
        $v_email_saler = $connect->real_escape_string(@$_POST["txt_email_saler"]);
        $v_phone_saler = $connect->real_escape_string(@$_POST["txt_phone_saler"]);
        $v_description = $connect->real_escape_string(@$_POST["txt_description"]);
        $v_detail = $connect->real_escape_string(@$_POST["txt_detail"]);

        $v_current_user = @$_SESSION['user']->id;
        $v_current_time_stamp = date('Y-m-d H:i:s');
        
        if(!empty($_FILES['txt_profile']['size'])){
            $image = date('Y_m_d')."_".rand(1111,9999).".png";
            if(move_uploaded_file($_FILES['txt_profile']['tmp_name'],"../../img/project/$image")){
                $sql = "INSERT INTO tbl_projects (
                        date,
                        title_en,
                        title_kh,
                        `category_id`,
                        `type_id`,
                        profile,
                        short_description_en,
                        short_description_kh,
                        detail_en,
                        detail_kh,
                        email_saler,
                        phone_saler,
                        created_by,
                        created_at
                    ) 
                    VALUES (
                        '$v_date',
                        '$v_title',
                        '$v_title',
                        '$v_category',
                        '$v_type',
                        '$image',
                        '$v_description',
                        '$v_description',
                        '$v_detail',
                        '$v_detail',
                        '$v_email_saler',
                        '$v_phone_saler',
                        '$v_current_user',
                        '$v_current_time_stamp'
                    )
                ";
                $result = mysqli_query($connect, $sql);
                if ($result) { 
                    $last_id = $connect->insert_id;
                    foreach(@$_POST["txt_feature"] as $v_feature){
                        $connect->query("INSERT INTO tbl_proj_feat (project_id,feature_id) 
                        VALUES ('{$last_id}','{$v_feature}')");
                    }
                    echo '<script> window.location.replace("index.php");</script>'; 
                }else{ 
                    $sms = '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error!</strong> Query Error '.mysqli_error($connect).'...
                    </div>';  
                }
            }else{
                $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error!</strong> Process error when uploading profile image ...
                </div>';  
            }
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Please choose profile image to coninue ...
            </div>';  
        }
    }

 ?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-plus-circle fa-fw"></i><?= $lang_text['createRecord'][$lang] ?></h2>
        </div>
    </div>
    
    <br>
    <br>

    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="index.php" id="sample_editable_1_new" class="btn red"> 
                <i class="fa fa-arrow-left"></i>
                <?= $lang_text['back'][$lang] ?>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off" enctype="multipart/form-data" id="main_form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="" class="form-label">Title <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_title" type="text" placeholder="Title">     
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
                                                        echo '<option value="'.$row1['id'].'">'.$row1['name_en'].' - '.$row1['name_kh'].'</option>';
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
                                            <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" required name="txt_date" type="text" placeholder="Date" value="<?= date('Y-m-d') ?>">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Profile <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_profile" type="file" placeholder="Profile">          
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Email Saler <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_email_saler" type="text" placeholder="Enter email of saler">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Phone Saler <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_phone_saler" type="text" placeholder="Enter phone of saler">
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
                                                        echo '<option value="'.$row1['id'].'">'.$row1['name_en'].' - '.$row1['name_kh'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for ="" class="form-label">Short Description <span class="required" aria-required="true">*</span></label>                                          
                                    <textarea class="form-control" name="txt_description" rows="5" required placeholder="Short Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for ="" class="form-label"><strong>Features : </strong></label>  
                            <?php
                                $position = mysqli_query($connect,"SELECT * FROM tbl_project_feature ORDER BY name_en ASC");
                                while ($row1 = mysqli_fetch_assoc($position)) {
                                    echo '
                                        <input type="checkbox" form="main_form" id="feature_'.$row1['id'].'" value="'.$row1['id'].'" name="txt_feature[]">
                                        <label for ="feature_'.$row1['id'].'">'.$row1['name_en'].'-'.$row1['name_kh'].'</label>                                          
                                        &nbsp; &nbsp;
                                    ';
                                }
                            ?>  
                        </div>
                        <div class="form-group">
                            <label for ="">Detail <span class="required" aria-required="true">*</span>:</label>                                          
                            <textarea class="form-control" name="txt_detail" id="detail" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                                <a href="index.php" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></a>
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