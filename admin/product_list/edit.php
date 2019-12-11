<?php 
    $menu_active =2;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $id = $_POST["id"];
            $code = $connect->real_escape_string(@$_POST["code"]);
            $ref = $connect->real_escape_string(@$_POST["ref"]);
            $paket = $connect->real_escape_string(@$_POST["paket"]);
            $category = $connect->real_escape_string(@$_POST["category"]);
            $en = $connect->real_escape_string(@$_POST["en"]);
            $kh = $connect->real_escape_string(@$_POST["kh"]);
            $priced = $connect->real_escape_string(@$_POST["priced"]);
            $pricek = $connect->real_escape_string(@$_POST["pricek"]);
            $image = "no_photo.png";
            $note = $connect->real_escape_string(@$_POST["note"]);

            if(!empty($_FILES['image']['size']) ){
            $image = $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'],"../../img/img_product/$image");
        
            $query_update = "UPDATE tbl_pos_product SET code ='$code'
                                    , ref         = '$ref'
                                    , paket       = '$paket' 
                                    , name_en     = '$en'
                                    , name_kh     = '$kh'
                                    , price_dolla = '$priced'
                                    , price_riel  = '$pricek'
                                    , photo       = '$image'
                                    , note_pro    = '$note'
                                    , cate_id     = '$category'
                                                WHERE
                                           pro_id = '$id'";
        }else{
                $query_update = "UPDATE tbl_pos_product SET code ='$code'
                                    , ref         = '$ref'
                                    , paket       = '$paket' 
                                    , name_en     = '$en'
                                    , name_kh     = '$kh'
                                    , price_dolla = '$priced'
                                    , price_riel  = '$pricek'
                                    , note_pro    = '$note'
                                    , cate_id     = '$category'
                                                WHERE
                                           pro_id = '$id'";
        }
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
        $sql = "SELECT * from tbl_pos_product where pro_id = $id";
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
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" autocomplete="off" action=""> 
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">                 
                        <div class="form-group col-xs-6">
                            <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                            <label for =""><?= $lang_text['code'][$lang] ?>:</label>                                          
                            <input class="form-control" required name="code" type="text" placeholder="Name(kh)" value = "<?php echo $row["code"]?>">    
                        </div>
                        <div class="form-group col-xs-6">
                            <label for =""><?= $lang_text['referenceName'][$lang] ?>:</label>                                          
                            <input class="form-control"   required name="ref" type="text" placeholder="ref" value = "<?php echo $row["ref"]?>">          
                        </div>
                        <div class="form-group col-xs-6">
                            <label for =""><?= $lang_text['productName'][$lang] ?>:</label>                                          
                            <input class="form-control"   required name="en" type="text" placeholder="English" value = "<?php echo $row["name_en"]?>">          
                        </div>
                        <div class = "form-group col-xs-6">
                            <label for = ""><?= $lang_text['category'][$lang] ?>:</label>
                            <select class = "form-control selectpicker" data-live-search="true" name = "category">
                                    <?php
                                    $select1 = "select * from tbl_pos_category";
                                    $query1  = mysqli_query($connect,$select1);
                                    while($row1 = $query1->fetch_assoc()):
                                        $selected=($row['cate_id']==$row1['cate_id']?"selected":"");
                                        ?>
                                        <option <?= $selected; ?> value="<?= $row1['cate_id']; ?>"><?= $row1['category_name']; ?></option>
                                    <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group col-xs-6">
                            <label for =""><?= $lang_text['price'][$lang] ?>:</label>                                          
                            <input class="form-control"   required name="priced" type="number" step="any" placeholder="$" value = "<?php echo $row["price_dolla"]?>">          
                        </div>
                        <div class="form-group col-xs-6">
                            <label for =""><?= $lang_text['cost'][$lang] ?>:</label>                                          
                            <input class="form-control"   required name="pricek" type="number" step="any" placeholder="៛" value = "<?php echo $row["price_riel"]?>" >          
                        </div>
                            <!-- <img src = "../../img/img_product/<?php echo $row["photo"]?>" width = "200px" id="preview"> -->
                        <div class="form-group col-xs-12">
                            <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                             <input type="text" class="form-control" rows="4" id="note" name = "note" value="<?php echo $row["note_pro"]?>">
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