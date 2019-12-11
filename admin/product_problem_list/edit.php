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
        $v_problem = $connect->real_escape_string(@$_POST["txt_problem"]);
        $v_cost = $connect->real_escape_string(@$_POST["txt_cost"]);
        $v_price = $connect->real_escape_string(@$_POST["txt_price"]);
        $v_price_extra = $connect->real_escape_string(@$_POST["txt_price_extra"]);
        $v_note = $connect->real_escape_string(@$_POST["txt_note"]);
        $v_model = $connect->real_escape_string(@$_POST["txt_model"]);
        
        $query_update = "UPDATE tbl_pos_product_model_problem SET
            pmp_name         = '$v_problem',
            pmp_cost         = '$v_cost',
            pmp_price         = '$v_price',
            pmp_price_extra         = '$v_price_extra',
            pmp_note         = '$v_note',
            pmp_model         = '$v_model'
            WHERE pmp_id = '$id'";
            
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

    if(isset($_GET["edit_id"])){
        $id = $_GET["edit_id"];
        $sql = "SELECT * from tbl_pos_product_model_problem where pmp_id = $id";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_object($result); 
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
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group col-xs-12">
                                    <label for =""><?= $lang_text['productModel'][$lang] ?>:</label>                                          
                                    <select class = "form-control selectpicker" data-live-search="true" name = "txt_model" required>
                                      <option value="">Select Model</option>
                                          <?php
                                            $position = mysqli_query($connect,"SELECT * FROM tbl_pos_product_model");
                                            while ($row1 = mysqli_fetch_assoc($position)) { ?>
                                            <option <?= (($row->pmp_model==$row1['pro_id'])?('selected'):('')) ?> value="<?php echo $row1['pro_id']; ?>"><?php echo $row1['name_en']; ?></option>
                                          <?php 
                                          }
                                           ?>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for =""><?= $lang_text['problem'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_problem" type="text" placeholder="problem ..."  value="<?= $row->pmp_name ?>">          
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group col-xs-2">
                                    <label for =""><?= $lang_text['cost'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_cost" type="number" step="any" placeholder="cost" value="<?= $row->pmp_cost ?>">          
                                </div>
                                <div class="form-group col-xs-5">
                                    <label for =""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['newMachine'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_price" type="number" step="any" placeholder="price for new machine" value="<?= $row->pmp_price ?>">
                                </div>
                                <div class="form-group col-xs-5">
                                    <label for =""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['oldMachine'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_price_extra" type="number" step="any" placeholder="price for old machine" value="<?= $row->pmp_price_extra ?>">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                    <input type="text" class="form-control" rows="4" id="note" name = "txt_note" value="<?= $row->pmp_note ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="btn_update" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
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