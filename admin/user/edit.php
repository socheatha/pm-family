<?php 
    $menu_active =5;
    $layout_title = "Edit Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php

    // btn update 
    if(isset($_POST['btn_update_user'])){
        $v_id = @$_POST['txt_id'];
        $v_name = @$_POST['txt_name'];
        $v_position = @$_POST['txt_position'];
   

        $query_update = "UPDATE tbl_pos_user SET    username='$v_name',
                                                position_id='$v_position' WHERE id='$v_id'";
        if($connect->query($query_update)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data was updated ...
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
    if(@$_GET['edit_id']!=""){
        $edit_id = @$_GET['edit_id'];
        $old_data = $connect->query("SELECT * FROM tbl_pos_user WHERE id='$edit_id'");
        $row_user = mysqli_fetch_object($old_data);
    }


 ?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-user fa-fw"></i> <?= $lang_text['editUser'][$lang] ?> </h2>
        </div>
    </div>
    
    <br>
    <br>

    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="index.php" id="sample_editable_1_new" class="btn red"> 
                <i class="fa fa-arrow-left"></i> <?= $lang_text['back'][$lang] ?> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                 <form action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txt_id" value="<?= $row_user->id ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label> <?= $lang_text['username'][$lang] ?></label>
                                    <input type="text" class="form-control" name="txt_name" placeholder="Enter your name" required="required" value="<?= $row_user->username ?>">
                                </div>
                                <div class="form-group">
                                    <label> <?= $lang_text['position'][$lang] ?></label>
                                    <select class="form-control" name="txt_position" required="required">
                                        <?php 
                                            $positon = $connect->query("SELECT * FROM tbl_pos_position");
                                            while ($row_position = mysqli_fetch_object($positon)) {
                                                if($row_position->position_id==$row_user->position_id){
                                                    echo '<option SELECTED="SELECTED" value="'.$row_position->position_id.'">'.$row_position->position.'</option>';
                                                }else{
                                                    echo '<option value="'.$row_position->position_id.'">'.$row_position->position.'</option>';
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_update_user" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                                <a href="index.php" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></a>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
