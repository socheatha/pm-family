<?php 
    $menu_active =3;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
      $v_date_record = @$connect->real_escape_string($_POST["txt_date_record"]);
      $v_product_code = @$connect->real_escape_string($_POST["txt_product_code"]);
      $v_product = @$connect->real_escape_string($_POST["txt_product"]);
      $v_qty_add = @$connect->real_escape_string($_POST["txt_qty_add"]);
      $v_qty_minus = @$connect->real_escape_string($_POST["txt_qty_minus"]);
      $v_employee = @$connect->real_escape_string($_POST["txt_employee"]);
      $v_note = @$connect->real_escape_string($_POST["txt_note"]);

       $query_add = "INSERT INTO tbl_pos_stock_adjust 
                            (sa_date_record
                              ,sa_product_code
                              ,sa_product
                              ,sa_qty_add
                              ,sa_qty_minus
                              ,sa_employee
                              ,sa_note
                              ) 
                VALUES 
                  ('$v_date_record'
                    , '$v_product_code'
                    , '$v_product'
                    , '$v_qty_add'
                    , '$v_qty_minus'
                    , '$v_employee'
                    , '$v_note')";
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
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                      <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                              <label for =""><?= $lang_text['date'][$lang] ?>:</label>                                          
                              <input class="form-control" required  name="txt_date_record" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="date.." value="<?= date('Y-m-d') ?>">          
                            </div>
                            <div class="form-group">
                              <label for =""><?= $lang_text['productName'][$lang] ?>:</label>                                          
                                <select class = "form-control selectpicker" data-live-search="true" style = "width:100%" name = "txt_product_code" id = "code">
                                  <option value="">Select Product</option>
                                      <?php
                                        $product = mysqli_query($connect,"SELECT * FROM tbl_pos_product ORDER BY code ASC");
                                        while ($row1 = mysqli_fetch_assoc($product)) { 
                                          echo '<option value="'.$row1['pro_id'].'">'.$row1['code']." :: ".$row1['name_en'].'</option>';
                                        }
                                       ?>   
                                </select>           
                            </div>
                            <div class="row">
                              <div class="col-xs-6">
                                <div class="form-group">
                                  <label for =""><?= $lang_text['qtyAdd'][$lang] ?>:</label>                                          
                                  <input class="form-control" required autocomplete="off" value="0" name="txt_qty_add" type="text" placeholder="qty add..">          
                                </div>
                              </div>
                              <div class="col-xs-6">
                                <div class="form-group">
                                  <label for =""><?= $lang_text['qtyMinus'][$lang] ?>:</label>                                          
                                  <input class="form-control" required autocomplete="off" value="0" name="txt_qty_minus" type="text" placeholder="qty minus..">          
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for =""><?= $lang_text['employee'][$lang] ?>:</label>                                          
                                <select class = "form-control selectpicker" data-live-search="true" name = "txt_employee" required>
                                     <option value="">Select Employee</option>
                                      <?php
                                         $employee = mysqli_query($connect,"SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                                          while ($row3 = mysqli_fetch_assoc($employee)) {
                                            echo '<option value="'.$row3['emp_id'].'">'.$row3['name_english'].'</option>';
                                      }
                                       ?>   
                                 </select>
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                 <textarea class="form-control" autocomplete="off" rows="4" id="note" name = "txt_note"></textarea>
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
