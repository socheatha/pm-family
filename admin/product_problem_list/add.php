<?php 
    $menu_active =1887;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
        $v_model = $connect->real_escape_string(@$_POST["txt_model"]);
        $v_problem = $connect->real_escape_string(@$_POST["txt_problem"]);
        $v_cost = $connect->real_escape_string(@$_POST["txt_cost"]);
        $v_price = $connect->real_escape_string(@$_POST["txt_price"]);
        $v_price_extra = $connect->real_escape_string(@$_POST["txt_price_extra"]);
        $v_note = $connect->real_escape_string(@$_POST["txt_note"]);

        $query_add = "INSERT INTO tbl_pos_product_model_problem 
            (
                pmp_name,
                pmp_cost,
                pmp_price,
                pmp_price_extra,
                pmp_note,
                pmp_model
            ) 
                VALUES 
            (
                '$v_problem',
                '$v_cost',
                '$v_price',
                '$v_price_extra',
                '$v_note',
                '$v_model'
            )";
        if($connect->query($query_add)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data inserted ...
            </div>'; 
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> '.mysqli_error($connect).' ...
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
                                <div class="form-group col-xs-12">
                                    <label for =""><?= $lang_text['productModel'][$lang] ?>:</label>                                          
                                    <select class = "form-control selectpicker" data-live-search="true" name = "txt_model" required>
                                      <option value="">Select Model</option>
                                        <?php
                                            $position = mysqli_query($connect,"SELECT * FROM tbl_pos_product_model");
                                            while ($row1 = mysqli_fetch_assoc($position)) {
                                                echo '<option '.((@$_SESSION['link_model_id']==$row1['pro_id'])?'selected':'').' value="'.$row1['pro_id'].'">'.$row1['name_en'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for =""><?= $lang_text['problem'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_problem" type="text" placeholder="problem ...">          
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group col-xs-2">
                                    <label for =""><?= $lang_text['cost'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_cost" type="number" step="any" value="0" placeholder="cost">          
                                </div>
                                <div class="form-group col-xs-5">
                                    <label for =""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['newMachine'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_price" type="number" step="any" value="0" placeholder="price for new machine">
                                </div>
                                <div class="form-group col-xs-5">
                                    <label for =""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['oldMachine'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="txt_price_extra" type="number" step="any" value="0" placeholder="price for old machine">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                    <input type="text" class="form-control" rows="4" id="note" name = "txt_note"/>
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
