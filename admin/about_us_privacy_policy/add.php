<?php 
    $menu_active =44;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>

<?php 
    if(isset($_POST["btn_add"])){
        $v_title = $connect->real_escape_string(@$_POST["txt_title"]);
        $v_date = $connect->real_escape_string(@$_POST["txt_date"]);
        $v_index = $connect->real_escape_string(@$_POST["txt_index"]);
        $v_description = $connect->real_escape_string(@$_POST["txt_description"]);
        $v_detail = $connect->real_escape_string(@$_POST["txt_detail"]);

        $v_current_user = @$_SESSION['user']->id;
        $v_current_time_stamp = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO tbl_about_us (
                `date`,
                `title_en`,
                `title_kh`,
                `index`,
                `type`,
                `short_description_en`,
                `short_description_kh`,
                `detail_en`,
                `detail_kh`,
                `created_by`,
                `created_at`
            ) 
            VALUES (
                '$v_date',
                '$v_title',
                '$v_title',
                '$v_index',
                '2',
                '$v_description',
                '$v_description',
                '$v_detail',
                '$v_detail',
                '$v_current_user',
                '$v_current_time_stamp'
            )
        ";
        $result = mysqli_query($connect, $sql);
        if ($result) { 
            echo '<script> window.location.replace("index.php");</script>'; 
        }else{ 
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> '.$sql.' ===> '.mysqli_error($connect).' ...
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
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for ="" class="form-label">Title <span class="required" aria-required="true">*</span></label>                                          
                                    <input class="form-control" required name="txt_title" type="text" placeholder="Title">     
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
                                            <label for ="">Index <span class="required" aria-required="true">*</span></label>                                          
                                            <input class="form-control" required name="txt_index" type="text" placeholder="Index">          
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