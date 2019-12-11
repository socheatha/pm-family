<?php 
    $menu_active =188;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $id = $_POST["id"];
        $v_name = $connect->real_escape_string($_POST["txt_name"]);
        $v_duration = $connect->real_escape_string($_POST["txt_duration"]);
        $v_price = $connect->real_escape_string($_POST["txt_price"]);
        $v_note = $connect->real_escape_string($_POST["txt_note"]);

            $query_update = "UPDATE tbl_pos_service SET
                     s_name         = '$v_name'
                    , s_duration       = '$v_duration' 
                    , s_price     = '$v_price'
                    , s_note     = '$v_note'
                                WHERE
                           s_id = '$id'";
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
    // $edit_id = @$_GET['edit_id'];
    if(isset($_GET["edit_id"])){
        $id = $_GET["edit_id"];
        $sql = "SELECT * from tbl_pos_service where s_id = $id";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_object($result); 
    }


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
                <form method="post" enctype="multipart/form-data" action=""> 
                    <input type = "hidden" name = "id" value = "<?= $row->s_id; ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for ="">Service Name:</label>                                          
                                    <input class="form-control"   required name="txt_name" type="text" placeholder="Service Name" value="<?= $row->s_name; ?>">     
                                </div>
                                <div class="form-group">
                                    <label for ="">Duration:</label>                                          
                                    <input class="form-control"   required name="txt_duration" type="text" placeholder="Duration" value="<?= $row->s_duration; ?>">          
                                </div>
                                <div class="form-group">
                                    <label for ="">Price:</label>                                          
                                    <input class="form-control"   required name="txt_price" type="number" step="any" value="<?= $row->s_price; ?>" placeholder="English">          
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="note">Note:</label>
                                    <textarea type="text" style="height: 180px;" class="form-control" rows="4" id="note" name = "txt_note"><?= $row->s_note; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_update" class="btn green"><i class="fa fa-save fa-fw"></i>Save Change</button>
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