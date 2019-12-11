<?php 
    $menu_active =3;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 

    if(isset($_POST["btn_add"])){
      $v_user_id = @$_SESSION['user']->id;
      $date      = @$connect->real_escape_string($_POST["date"]);
      $v_product = @$connect->real_escape_string($_POST["tbox_product"]);
      $qauntity  = @$connect->real_escape_string($_POST["qauntity"]);
      $amount    = @$connect->real_escape_string($_POST["amount"]);
      $vender    = @$connect->real_escape_string($_POST["vender"]);
      $employee  = @$connect->real_escape_string($_POST["employee"]);
      $note      = @$connect->real_escape_string($_POST["note"]);

      $get_product_code = $connect->query("SELECT code FROM tbl_pos_product WHERE pro_id='$v_product'");
      $code = mysqli_fetch_object($get_product_code)->code;
      
      $query_add = "INSERT INTO tbl_pos_stockin 
                (user_id,date_in,code_in,pro_id,qty_in,amount,note_in,vender_id,emp_id) 
            VALUES 
                ('$v_user_id','$date', '$code', '$v_product', '$qauntity', '$amount',  '$note', '$vender', '$employee')";

      if($connect->query($query_add)){
          $sms = '<div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Successfull!</strong> Data inserted ...
          </div>'; 

          // set to expense
          $connect->query("INSERT tbl_account_expense (ae_date,ae_title,ae_amount_dollar,ae_note,ae_created_by) VALUES(
              '$date',
              '"."stockin :: ".$code."',
              '$amount',
              '$note',
              '$v_user_id'
          )");

          header('location: index.php');

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
                 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" oninput="get_calculate()">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for =""><?= $lang_text['date'][$lang] ?>:</label>                                          
                                <input class="form-control" required name="date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="date..." autocomplete="off" value="<?= date('Y-m-d') ?>">          
                              </div>
                              <div class="form-group">
                                <label for = ""><?= $lang_text['productName'][$lang] ?>:</label>
                                <select class = "form-control selectpicker" data-live-search="true" id="id_product" name = "tbox_product">
                                    <option value="">====Select here====</option>
                                        <?php
                                          $v_select = mysqli_query($connect,"SELECT * FROM tbl_pos_product ORDER BY code");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                            echo '<option value="'.$row['pro_id'].'">'.$row['code']." :: ".$row['name_en'].'</option>';
                                          }
                                        ?>     
                                </select>        
                              </div>
                              <div class="form-group">
                                <label for =""><?= $lang_text['addNew'][$lang] ?>:</label>                                          
                                <input class="form-control quantity"   required name="qauntity" type="number" placeholder="qauntity..." autocomplete="off">          
                              </div>
                              <div class="form-group">
                                <label for =""><?= $lang_text['amount'][$lang] ?>:</label>                                          
                                <input class="form-control amount" required name="amount" type="number" placeholder="amount..." autocomplete="off">          
                              </div>                             
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class = "form-group">
                                  <label for = ""><?= $lang_text['supplier'][$lang] ?>:</label>
                                  <select class = "form-control selectpicker" data-live-search="true" name = "vender" required>
                                    <option value="">Select Product</option>
                                        <?php
                                          $vender = mysqli_query($connect,"SELECT * FROM tbl_pos_vender ORDER BY vendername_en ASC");
                                          while ($row2 = mysqli_fetch_assoc($vender)) {
                                            echo '<option value="'.$row2['vender_id'].'">'.$row2['vendername_en'].' :: '.$row2['vendername_kh'].'</option>';
                                          }
                                        ?>   
                                  </select>
                              </div>
                              <div class = "form-group">
                                  <label for = ""><?= $lang_text['employee'][$lang] ?>:</label>
                                    <select class = "form-control selectpicker" data-live-search="true" id="id_product" name = "employee" required>
                                       <option value="">Select Employee</option>
                                        <?php
                                           $employee = mysqli_query($connect,"SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                                            while ($row3 = mysqli_fetch_assoc($employee)) {
                                              echo '<option value="'.$row3['emp_id'].'">'.$row3['name_english'].'</option>';
                                           
                                            }
                                         ?>   
                                   </select>
                              </div>
                              <div class="form-group">
                                <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                                 <textarea class="form-control" style="height: 110px;" id="note" name = "note"  autocomplete="off"></textarea>
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
