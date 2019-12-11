<?php 
    $menu_active =9998;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header_frame.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
      $v_user_id = @$_SESSION['user']->id;
      $v_invoice = @$_GET['parent_id'];
      $date      = @$connect->real_escape_string($_POST["date"]);
      $v_product = @$connect->real_escape_string($_POST["tbox_product"]);
      $qauntity  = @$connect->real_escape_string($_POST["qauntity"]);
      $v_date = date('Y-m-d');

      $get_product_code = $connect->query("SELECT code,price_dolla,price_riel FROM tbl_pos_product WHERE pro_id='$v_product'");
      $row_product = mysqli_fetch_object($get_product_code);
      $code = $row_product->code;
      $cost = $row_product->price_riel;
      $price = $row_product->price_dolla;
      
      $query_add = "INSERT INTO tbl_pos_stockout 
                (date_out,invoice,code_out,qty_out,pro_id,so_user_id,so_cost,price) 
            VALUES 
                ('$v_date','$v_invoice','$code','$qauntity', '$v_product', '$v_user_id', '$cost', '$price')";

      if($connect->query($query_add)){
          $sms = '<div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Successfull!</strong> Data inserted ...
          </div>'; 
          header('location: index.php?parent_id='.@$_GET['parent_id']);

      }else{
          $sms = '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Error!</strong> '.mysqli_error($connect).' ...
          </div>';   
      }
    }

 ?>

<br>
<!-- <div class="portlet light bordered"> -->
    <div class="row">
        <div class="col-xs-12">
            <?= @$sms ?>
        </div>
    </div>
    <div class="portlet-body">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $lang_text['inputBecarefull'][$lang] ?></h3>
            </div>
            <div class="panel-body">
                 <form action="" method="post" enctype="multipart/form-data" oninput="get_calculate()">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for =""><?= $lang_text['date'][$lang] ?>:</label>                                          
                                <input class="form-control" required name="date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="date..." autocomplete="off" value="<?= date('Y-m-d') ?>">          
                              </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for = ""><?= $lang_text['productName'][$lang] ?>:</label>
                                <select class = "form-control selectpicker" data-live-search="true" id="id_product" name = "tbox_product" required="">
                                    <option value="">====Select here====</option>
                                        <?php
                                          $v_select = mysqli_query($connect,"SELECT * FROM tbl_pos_product ORDER BY code");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                            echo '<option value="'.$row['pro_id'].'">'.$row['code']." :: ".$row['name_en'].'</option>';
                                          }
                                        ?>     
                                </select>        
                              </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for =""><?= $lang_text['qty'][$lang] ?>:</label>                                          
                                <input class="form-control quantity"   required name="qauntity" type="number" placeholder="qauntity..." autocomplete="off">          
                              </div>                           
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                                <a href="index.php?parent_id=<?= @$_GET['parent_id'] ?>" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></a>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </div>
    </div>
<!-- </div> -->
<?php include_once '../layout/footer_frame.php' ?>
