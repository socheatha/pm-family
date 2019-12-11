<?php 
    $menu_active =1887;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $id = $_POST["id"];
        $name = $connect->real_escape_string(@$_POST["name"]);
        $note = $connect->real_escape_string(@$_POST["note"]);
        
        $query_update = "UPDATE tbl_pos_product_model SET
            name_en         = '$name',
            note       = '$note' 
            WHERE pro_id = '$id'";
            
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
        $sql = "SELECT * from tbl_pos_product_model where pro_id = $id";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result); 
    }


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
                <form method="post" enctype="multipart/form-data" autocomplete="off" action=""> 
                    <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group col-xs-12">
                                    <label for =""><?= $lang_text['model'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="name" type="text" placeholder="Model Name" value="<?php echo $row['name_en']; ?>">          
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                    <input type="text" class="form-control" rows="4" id="note" name = "note" value="<?php echo $row['note']; ?>" />
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