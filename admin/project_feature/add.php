<?php 
    $menu_active =49;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
        $v_name_en = $connect->real_escape_string(@$_POST["txt_name_en"]);
        $v_name_kh = $connect->real_escape_string($_POST["txt_name_kh"]);
        $v_note = $connect->real_escape_string($_POST["txt_note"]);

        if(!empty($_FILES['txt_profile']['size'])){
            $image = date('Y_m_d')."_".rand(1111,9999).".png";
            if(move_uploaded_file($_FILES['txt_profile']['tmp_name'],"../../img/project/feature/$image")){
                $query_add = "INSERT INTO tbl_project_feature 
                            (name_en,name_kh,profile,note) 
                        VALUES 
                            ('$v_name_en', '$v_name_kh', '$image', '$v_note')";
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
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Name En <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required  name="txt_name_en" type="text" placeholder="name En">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Name Kh <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required  name="txt_name_kh" type="text" placeholder="name Kh">          
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for ="">Profile <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_profile" type="file" placeholder="Profile">          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                     <textarea class="form-control" rows="4" name = "txt_note" placeholder="enter note"></textarea>
                                </div>
                            </div>
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
<?php include_once '../layout/footer.php' ?>
