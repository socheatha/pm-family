<?php 
    $menu_active =188;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
        $v_name = $connect->real_escape_string($_POST["txt_name"]);
        $v_duration = $connect->real_escape_string($_POST["txt_duration"]);
        $v_price = $connect->real_escape_string($_POST["txt_price"]);
        $v_note = $connect->real_escape_string($_POST["txt_note"]);
        $v_user_id = $_SESSION['user']->id;

        $query_add = "INSERT INTO tbl_pos_service 
                     (s_name,s_duration,s_price,s_note,s_user_id) 
                    VALUES 
                     ('$v_name', '$v_duration' ,'$v_price', '$v_note','$v_user_id')";

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
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for ="">Service Name:</label>                                          
                                    <input class="form-control"   required name="txt_name" type="text" placeholder="Service Name">     
                                </div>
                                <div class="form-group">
                                    <label for ="">Duration:</label>                                          
                                    <input class="form-control"   required name="txt_duration" type="text" placeholder="Duration">          
                                </div>
                                <div class="form-group">
                                    <label for ="">Price:</label>                                          
                                    <input class="form-control"   required name="txt_price" type="number" step="any" value="0" placeholder="English">          
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="note">Note:</label>
                                    <textarea type="text" style="height: 180px;" class="form-control" rows="4" id="note" name = "txt_note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i>Save</button>
                                <a href="index.php" class="btn red"><i class="fa fa-undo fa-fw"></i>Cancel</a>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>
