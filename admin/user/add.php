<?php 
    $menu_active =5;
    $layout_title = "Add Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?> 


<?php 
    if(isset($_POST['btn_add_user'])){
        $v_name = @$_POST['txt_name'];
        $v_password = @$_POST['txt_password'];
        $v_confirm_password = @$_POST['txt_confirm_password'];
        $v_position = @$_POST['txt_position'];
        if($v_password == $v_confirm_password){
            $v_pass = md5($v_password);
            $v_password = sha1(md5($v_pass)).sha1("0962195196");
            $query_add = "INSERT INTO tbl_pos_user (username,password,position_id) 
                VALUES('$v_name','$v_password','$v_position')";
            if($connect->query($query_add)){
                $sms = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Successfull!</strong> Data inserted ...
                </div>';
                // header("Refresh:2; url=index.php");   
            }else{
                $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error!</strong> Query error ...
                </div>';
                // header("Refresh:0; url=add.php");    
            }
        }else{
            $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Password and Confirm not match ...
            </div>';
        }



    }

 ?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
            <h2><i class="fa fa-user fa-fw"></i><?= $lang_text['createNewUser'][$lang] ?></h2>
        </div>
    </div>
    
    <br>
    <br>

    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="index.php" id="sample_editable_1_new" class="btn red"> 
                <i class="fa fa-arrow-left"></i> <?= $lang_text['back'][$lang] ?></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                 <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label> <?= $lang_text['username'][$lang] ?></label>
                                    <input type="text" class="form-control" name="txt_name" placeholder="Enter your name" required="required" autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <label> <?= $lang_text['password'][$lang] ?></label>
                                    <input type="text" class="form-control" name="txt_password" placeholder="Repeat your password" required="required" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label> <?= $lang_text['confirmPassword'][$lang] ?></label>
                                    <input type="password" class="form-control" name="txt_confirm_password" placeholder="Enter your password" required="required" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label> <?= $lang_text['position'][$lang] ?></label>
                                    <select class="form-control" name="txt_position" required="required">
                                        <option value="">=== Please Choose Position ===</option>
                                        <?php 
                                            $positon = $connect->query("SELECT * FROM tbl_pos_position ORDER BY position_id ASC");
                                            while ($row_position = mysqli_fetch_object($positon)) {
                                                echo '<option value="'.$row_position->position_id.'">'.$row_position->position.'</option>';
                                            }
                                         ?>
                                    </select><span class="help-block help-block-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_add_user" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
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
