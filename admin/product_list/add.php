<?php 
    $menu_active =2;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
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

        if(!empty($_FILES['image']['size'])){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],"../../img/img_product/$image");

            $query_add = "INSERT INTO tbl_pos_product 
                     (code,ref,paket,name_en,name_kh,price_dolla,price_riel,photo,note_pro,cate_id) 
                    VALUES 
                     ('$code', '$ref' ,'$paket', '$en','$kh','$priced','$pricek','$image','$note','$category')";
        }else{
            $query_add = "INSERT INTO tbl_pos_product 
                     (code,ref,paket,name_en,name_kh,price_dolla,price_riel,photo,note_pro,cate_id) 
                    VALUES 
                     ('$code', '$ref' ,'$paket', '$en','$kh','$priced','$pricek','no_photo.png','$note','$category')";
        }
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
                                <div class="form-group col-xs-6">
                                    <label for =""><?= $lang_text['code'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="code" type="text" placeholder="Code">     
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for =""><?= $lang_text['referenceName'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="ref" type="text" placeholder="Ref">          
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for =""><?= $lang_text['productName'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="en" type="text" placeholder="English">          
                                </div>
 <!--                                <div class="form-group col-xs-6">
                                    <label for ="">Name in Khmer:</label>                                          
                                    <input class="form-control"   required name="kh" type="text" placeholder="Khmer">
                                </div> -->
<!--                                 <div class="form-group col-xs-6">
                                    <label for ="">Packet:</label>                                          
                                    <input class="form-control"   required name="paket" type="text" placeholder="Paket">          
                                </div> -->
                                <div class = "form-group col-xs-6">
                                    <label for = ""><?= $lang_text['category'][$lang] ?>:</label>
                                    <select class = "form-control selectpicker" data-live-search="true" name = "category" required>
                                      <option value="">Select Catetegory</option>
                                          <?php
                                            $position = mysqli_query($connect,"SELECT * FROM tbl_pos_category");
                                            while ($row1 = mysqli_fetch_assoc($position)) { ?>
                                            <option value="<?php echo $row1['cate_id']; ?>"><?php echo $row1['category_name']; ?></option>
                                          <?php 
                                          }
                                           ?>   
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group col-xs-6">
                                    <label for =""><?= $lang_text['price'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="priced" type="number" step="any" value="0" placeholder="លក់ចេញ">
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for =""><?= $lang_text['cost'][$lang] ?>:</label>                                          
                                    <input class="form-control"   required name="pricek" type="number" step="any" value="0" placeholder="ទិញចូល">          
                                </div>
                 <!--                <div class = "form-group col-xs-12">
                                    <label for = "">photo:</label>                                     
                                    <input type="file"  class="form-control"  id = "phot" name="image" onchange="loadFile(event)" />
                                </div> -->
                                <div class="form-group col-xs-12">
                                    <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                    <input type="text" class="form-control" rows="4" id="note" name = "note"/>
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
