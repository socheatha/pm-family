<?php 
    $menu_active =8;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $v_id = @$connect->real_escape_string($_POST['txt_id']);
        $kname = @$connect->real_escape_string($_POST["name_khmer"]);
        $ename = @$connect->real_escape_string($_POST["name_english"]);
        $start = @$connect->real_escape_string($_POST["starton"]);
        $phone = @$connect->real_escape_string($_POST["phone"]);
        $position = @$connect->real_escape_string($_POST["position"]);
        $note = @$connect->real_escape_string($_POST["note"]);
    
        $query_update = "UPDATE tbl_pos_employee SET name_khmer ='$kname'
                            , name_english  = '$ename' 
                            , start_on      = '$start'
                            , position_id   = '$position'
                            , phone         = '$phone'
                            , emp_note      = '$note'
                                WHERE emp_id = '$v_id'" ;
        if($connect->query($query_update)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>'; 
            // echo '<script> window.location.replace("index.php");</script>';
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';   
        }
    }


// get old data 
    $edit_id = @$_GET['edit_id'];
    $old_data = $connect->query("SELECT * FROM tbl_pos_employee WHERE emp_id='$edit_id'");
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
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?= $_SERVER['PHP_SELF'] ?>?edit_id=<?= $edit_id ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txt_id" value="<?= $row_old->emp_id ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for =""><?= $lang_text['name'][$lang] ?>:</label>                                          
                                    <input class="form-control"  autocomplete="off" required name="name_english" type="text" placeholder="Name(en)" value="<?= $row_old->name_english ?>">                                                                  
                                </div>
                                <div class="form-group">
                                    <label for =""><?= $lang_text['startOn'][$lang] ?>:</label>                                          
                                    <input class="form-control" required name="starton" type="text" placeholder="starton" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $row_old->start_on ?>">
                                </div>
     <!--                            <div class = "form-group">
                                    <label for = "">Position:</label>
                                    <select class = "form-control"  autocomplete="off" name = "position">
                                        <option value="">Select here</option>
                                            <?php
                                                $position = mysqli_query($connect,"SELECT * FROM tbl_pos_position");
                                                while ($row = mysqli_fetch_assoc($position)) {
                                                    if($row['position_id'] == $row_old->position_id)
                                                        echo '<option SELECTED value="'.$row['position_id'].'">'.$row['position'].'</option>';
                                                    else
                                                        echo '<option value="'.$row['position_id'].'">'.$row['position'].'</option>';
                                                }
                                             ?>     
                                    </select>
                                </div> -->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for =""><?= $lang_text['phone'][$lang] ?>:</label>                                          
                                    <input class="form-control"  autocomplete="off" required name="phone" type="text" placeholder="Phone" value="<?= $row_old->phone ?>">                                   
                                </div>
                                <div class="form-group">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                     <textarea class="form-control"  autocomplete="off" style="height: 110px;" id="note" name = "note"><?= $row_old->emp_note ?></textarea>
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
<?php include_once '../layout/footer.php' ?>