<?php 
    $menu_active =49;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $v_id = @$connect->real_escape_string($_POST['txt_id']);
        $old_image = $_POST['txt_old_img'];
        $v_name_en = $connect->real_escape_string(@$_POST["txt_name_en"]);
        $v_name_kh = $connect->real_escape_string($_POST["txt_name_kh"]);
        $v_note = $connect->real_escape_string($_POST["txt_note"]);

        if(!empty($_FILES['txt_profile']['size'])){
            $image = date('Y_m_d')."_".rand(1111,9999).".png";
            move_uploaded_file($_FILES['txt_profile']['tmp_name'],"../../img/project/feature/$image");
            if(file_exists("../../img/project/feature/".$old_image)){
                unlink("../../img/project/feature/".$old_image);
            }
        }else { $image = $old_image; }

        $query_update = "UPDATE tbl_project_feature SET 
                                    name_en = '$v_name_en' , 
                                    name_kh = '$v_name_kh' , 
                                    profile='$image',
                                    note = '$v_note'
                                    WHERE id = '$v_id'" ;
        if($connect->query($query_update)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>'; 
            echo '<script> window.location.replace("index.php");</script>';
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';   
        }
    }


// get old data 
    $edit_id = @$_GET['edit_id'];
    $old_data = $connect->query("SELECT * FROM tbl_project_feature WHERE id='$edit_id'");
    $row_old = mysqli_fetch_object($old_data);


 ?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-plus-circle fa-fw"></i><?= $lang_text['editRecord'][$lang] ?></h2>
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
                <h3 class="panel-title">Input Information</h3>
            </div>
            <div class="panel-body">
                <form action="<?= $_SERVER['PHP_SELF'] ?>?edit_id=<?= $edit_id ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txt_id" value="<?= $row_old->id ?>">
                    <input type="hidden" name="txt_old_img" value="<?= @$row_old->profile ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                <img width="100%" src="../../img/project/feature/<?= @$row_old->profile ?>" class="img-responsive img-responsive img-thumbnail" alt="Image">
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Name En:</label>                                          
                                            <input class="form-control" required  name="txt_name_en" type="text" placeholder="enter name en" value="<?= $row_old->name_en ?>">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Name Kh:</label>                                          
                                            <input class="form-control" required  name="txt_name_kh" type="text" placeholder="enter name kh" value="<?= $row_old->name_kh ?>">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Profile <span class="required" aria-required="true">*</span> </label>
                                            <input type="file" class="form-control" name="txt_profile" placeholder="Choose profile image" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                     <textarea class="form-control" rows="4" id="note" name = "txt_note"><?= $row_old->note ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_update" class="btn green"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                                <a href="index.php" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></a>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </div>
</div>