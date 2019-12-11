<?php 
    $menu_active =6;
    $left_menu =49;
    $layout_title = "Add Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_submit'])){
        $v_date = $connect->real_escape_string(@$_POST['txt_date_record']);
        $v_cate = $connect->real_escape_string(@$_POST['txt_category']);
        $v_title = $connect->real_escape_string(@$_POST['txt_title']);
        $v_amn_usd = $connect->real_escape_string(@$_POST['txt_amount_usd']);
        $v_amn_khr = $connect->real_escape_string(@$_POST['txt_amount_khr']);
        $v_note = $connect->real_escape_string(@$_POST['txt_note']);
        $v_user_id = @$_SESSION['user']->id;
        

        $query_add = "INSERT INTO  tbl_account_income (
                ai_date,
                ai_category,
                ai_title,
                ai_amount_dollar,
                ai_amount_riel,
                ai_note,
                ai_created_by              
                ) 
            VALUES(
                '$v_date',
                '$v_cate',
                '$v_title',
                '$v_amn_usd',
                '$v_amn_khr',
                '$v_note',
                '$v_user_id'
                )";
        if($connect->query($query_add)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data inserted ...
            </div>'; 
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> '.mysqli_error($connect).'
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
                 <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?= $lang_text['date'][$lang] ?> : </label>
                                    <input type="text" class="form-control" name="txt_date_record" required=""  autocomplete="off" value="<?= date('Y-m-d') ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                </div>
                                <div class="form-group">
                                    <label><?= $lang_text['category'][$lang] ?> : </label>
                                    <select  class="form-control selectpicker" name="txt_category" required="" data-live-search="true">
                                        <option value="">Choose Category</option>
                                        <?php 
                                            $select_data = $connect->query("SELECT * FROM tbl_account_category ORDER BY ac_name ASC");
                                            while ($row_data = mysqli_fetch_object($select_data)) {
                                                echo '<option value="'.$row_data->ac_id.'">'.$row_data->ac_name.'</option>';
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?= $lang_text['title'][$lang] ?> : </label>
                                    <input type="text" class="form-control" name="txt_title" required=""  autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label><?= $lang_text['amountUsd'][$lang] ?> : </label>
                                            <input type="number" step="any" class="form-control" name="txt_amount_usd" required=""  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label><?= $lang_text['amountRiel'][$lang] ?> : </label>
                                            <input type="number" class="form-control" name="txt_amount_khr" required=""  autocomplete="off" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?= $lang_text['note'][$lang] ?> : </label>
                                    <textarea type="text" class="form-control" name="txt_note" style="height: 254px;" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_submit" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
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
