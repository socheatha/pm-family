<?php 
    $menu_active =9998;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>

 
<?php 
    if(isset($_POST["btn_add"]) and $_SESSION['prevent_default']){
      $v_user_id = @$_SESSION['user']->id;
      $v_date      = @$connect->real_escape_string($_POST["txt_date"]);
      $v_customer_name      = @$connect->real_escape_string($_POST["txt_customer_name"]);
      $v_contact_number      = @$connect->real_escape_string($_POST["txt_contact_number"]);
      $v_product_model      = @$connect->real_escape_string($_POST["txt_product_model"]);
      $v_product_status      = @$connect->real_escape_string($_POST["txt_product_status"]);
      $v_product_board      = @$connect->real_escape_string($_POST["txt_product_board"]);
      $v_product_description      = @$connect->real_escape_string($_POST["txt_product_description"]);
      $v_problem      = implode($_POST["txt_problem"],',');
      $v_problem_description      = @$connect->real_escape_string($_POST["txt_problem_description"]);
      $v_alert_inform_date      = @$connect->real_escape_string($_POST["txt_alert_inform_date"]);
      $v_employee      = @$connect->real_escape_string($_POST["txt_employee"]);
      $v_note      = @$connect->real_escape_string($_POST["txt_note"]);

      $v_price      = @$connect->real_escape_string($_POST["txt_price"]);
      $v_discount_condition      = @$connect->real_escape_string($_POST["discount_condition"]);
      $v_discount_dollar     = @$connect->real_escape_string((($_POST["discount_condition"]==1)?$_POST["txt_discount"]:0));
      $v_discount_percentage     = @$connect->real_escape_string((($_POST["discount_condition"]==2)?$_POST["txt_discount"]:0));
      
      $v_price_detail     = @$connect->real_escape_string($_POST["txt_price_detail"]);
      $v_discount_detail     = @$connect->real_escape_string($_POST["txt_discount_detail"]);

      $v_set_finish_date      = @$connect->real_escape_string($_POST["txt_set_finish_date"]);

      $v_user_id = @$_SESSION['user']->id;
      $v_current_time_stamp=date('Y-m-d H:i:s');
      $query_add = "INSERT INTO tbl_transaction 
                (
                t_date_received,
                t_customer,
                t_customer_phone_number,
                t_product_model,
                t_product_machine_type,
                t_product_board_number,
                t_product_description,
                t_issue,
                t_issue_description,
                t_alert_inform_date,
                t_fix_by_employee,
                t_note,
                t_fix_price,
                t_discount_status,
                t_discount_dollar,
                t_discount_percentage,
                t_date_finished,

                t_price_detail,
                t_discount_detail,

                t_user_id,
                t_created_at
                ) 
            VALUES 
                (
                '$v_date',
                '$v_customer_name', 
                '$v_contact_number', 
                '$v_product_model', 
                '$v_product_status', 
                '$v_product_board',  
                '$v_product_description',  
                '$v_problem',
                '$v_problem_description',
                '$v_alert_inform_date',
                '$v_employee',
                '$v_note',
                '$v_price',
                '$v_discount_condition',
                '$v_discount_dollar',
                '$v_discount_percentage',
                '$v_set_finish_date',

                '$v_price_detail',
                '$v_discount_detail',
                
                '$v_user_id',
                '$v_current_time_stamp'
              )";

      if($connect->query($query_add)){
          $_SESSION['prevent_default']=false;
          $sms = '<div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Successfull!</strong> Data inserted ...
          </div>'; 
          header('location: print_preview.php?id='.$connect->insert_id.'&action_back=index.php');
      }else{
          $sms = '<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Error!</strong> Query error ...
          </div>';   
      }
    }
    $_SESSION['prevent_default']=true;

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
                        <label for =""><?= $lang_text['checkinDate'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                                          
                        <input class="form-control" required name="txt_date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="date..." autocomplete="off" value="<?= ((@$_POST['txt_date'])?(@$_POST['txt_date']):(date('Y-m-d'))) ?>">          
                      </div>
                      <div class="form-group">
                        <label for =""><?= $lang_text['customer'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                                          
                        <input class="form-control"   required name="txt_contact_number" value="<?= @$_POST['txt_contact_number'] ?>" type="text" placeholder="0962195196" autocomplete="off">          
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <div class="form-group">
                        <label for =""><?= $lang_text['alertDate'][$lang] ?>:</label>                                          
                        <input class="form-control" required name="txt_alert_inform_date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Alert Inform Date" autocomplete="off" value="<?= ((@$_POST['txt_alert_inform_date'])?(@$_POST['txt_alert_inform_date']):(date('Y-m-d'))) ?>">          
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group">
                            <label for =""><?= $lang_text['fixByEmployee'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                                          
                            <select class = "form-control" data-live-search="true" name = "txt_employee" required="">
                              <option value=""><?= $lang_text['employee'][$lang] ?></option>
                                <?php
                                  $vender = mysqli_query($connect,"SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                                  while ($row2 = mysqli_fetch_assoc($vender)) {
                                    echo '<option '.(($row2['emp_id']==@$_POST['txt_employee'])?('selected'):('')).' value="'.$row2['emp_id'].'">'.$row2['name_english'].'</option>';
                                  }
                                ?>   
                            </select>        
                          </div> 
                        </div>
                        <div class="col-xs-6" style="padding-left: 0px;">
                          <div class="form-group">
                            <label for =""><?= $lang_text['finishedDate'][$lang] ?>:</label>                                          
                            <input class="form-control" name="txt_set_finish_date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Set Finish Date" autocomplete="off" value="<?= @$_POST['txt_set_finish_date'] ?>">          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      <div class="row">
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label for =""><?= $lang_text['productModel'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>            
                              <select class = "form-control select2" name = "txt_product_model" required="" style="width: 100%">
                                  <option value="">====Select here====</option>
                                  <?php
                                    $v_select = mysqli_query($connect,"SELECT * FROM tbl_pos_product_model ORDER BY pro_id ASC");
                                    while ($row = mysqli_fetch_assoc($v_select)) {
                                      echo '<option '.(($row['pro_id']==@$_POST['txt_product_model'])?('selected'):('')).' value="'.$row['pro_id'].'">'.$row['name_en'].'</option>';
                                    }
                                  ?>     
                              </select>          
                            </div> 
                            <div class="form-group">
                              <label for =""><?= $lang_text['productStatus'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                                            
                              <select class = "form-control" name = "txt_product_status" required="">
                                  <option value="">====Select here====</option>
                                      <?php
                                        $v_select = mysqli_query($connect,"SELECT * FROM tbl_machine_type");
                                        while ($row = mysqli_fetch_assoc($v_select)) {
                                          echo '<option '.(($row['mt_id']==@$_POST['txt_product_status'])?('selected'):('')).' value="'.$row['mt_id'].'">'.$row['mt_name'].'</option>';
                                        }
                                      ?>     
                              </select>        
                            </div> 
                            <div class="form-group">
                              <label for =""><?= $lang_text['boardNumber'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                                          
                              <input class="form-control" required name="txt_product_board" type="text" placeholder="Product Board No" autocomplete="off" value="<?= @$_POST['txt_product_board'] ?>">          
                            </div>
                          </div>
                          <div class="col-xs-8" style=" background-color: #e5e5e5; border-radius: 5px!important;">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <div class="pull-right">
                                    <a class="btn btn-xs btn-primary btn-block" id="buttonProblem" data-toggle="modal" href='#modal-add-problem'><small><?= $lang_text['addProblemBtn'][$lang] ?> </small><i class="fa fa-plus"></i></a>
                                  </div>
                                  <label for =""><?= $lang_text['problem'][$lang] ?>: <span class="text-danger"><strong>*</strong></span></label>                 
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6">
                                      <label for =""><?= $lang_text['price'][$lang] ?> : </label>                 
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <label for =""><?= $lang_text['discount'][$lang] ?> <strong>($)</strong>: </label>                 
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <input type="hidden" name="txt_problem">
                              <input type="hidden" name="txt_problem_description" value="<?= @$_POST['txt_problem_description'] ?>"> 
                              <input type="hidden" name="txt_price_detail" value="<?= @$_POST['txt_problem_description'] ?>"> 
                              <input type="hidden" name="txt_discount_detail" value="<?= @$_POST['txt_problem_description'] ?>"> 
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <select name="txt_problem[]" class="form-control select2" required id="" style="width: 100%">
                                    <?php 
                                      $get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model=".@$_POST['txt_product_model']);
                                      if(@mysqli_num_rows($get_data)){
                                        echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
                                        while($row_data = mysqli_fetch_object($get_data)){
                                          echo '<option '.(($row_data->pmp_id==@$_POST['txt_problem'][0])?('selected'):('')).' value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
                                        }
                                      }else{
                                        echo '<option value="" data-price="0">Choose Problem</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6" style="padding-right: 0px;">
                                      <input readonly name="txt_problem_price[]" type="number" min="0" value="0" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <input name="txt_problem_discount[]" type="number" min="0" value="<?= @$_POST['txt_problem_discount'][0]??0 ?>" class="form-control"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <select name="txt_problem[]" class="form-control select2" style="width: 100%">
                                    <?php 
                                      $get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model=".@$_POST['txt_product_model']);
                                      if(@mysqli_num_rows($get_data)){
                                        echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
                                        while($row_data = mysqli_fetch_object($get_data)){
                                          echo '<option '.(($row_data->pmp_id==@$_POST['txt_problem'][1])?('selected'):('')).' value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
                                        }
                                      }else{
                                        echo '<option value="" data-price="0">Choose Problem</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6" style="padding-right: 0px;">
                                      <input readonly name="txt_problem_price[]" type="number" min="0" value="0" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <input name="txt_problem_discount[]" type="number" min="0" value="<?= @$_POST['txt_problem_discount'][1]??0 ?>" class="form-control"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <select name="txt_problem[]" class="form-control select2" style="width: 100%">
                                    <?php 
                                      $get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model=".@$_POST['txt_product_model']);
                                      if(@mysqli_num_rows($get_data)){
                                        echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
                                        while($row_data = mysqli_fetch_object($get_data)){
                                          echo '<option '.(($row_data->pmp_id==@$_POST['txt_problem'][2])?('selected'):('')).' value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
                                        }
                                      }else{
                                        echo '<option value="" data-price="0">Choose Problem</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6" style="padding-right: 0px;">
                                      <input readonly name="txt_problem_price[]" type="number" min="0" value="0" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <input name="txt_problem_discount[]" type="number" min="0" value="<?= @$_POST['txt_problem_discount'][2]??0 ?>" class="form-control"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <select name="txt_problem[]" class="form-control select2" style="width: 100%">
                                    <?php 
                                      $get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model=".@$_POST['txt_product_model']);
                                      if(@mysqli_num_rows($get_data)){
                                        echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
                                        while($row_data = mysqli_fetch_object($get_data)){
                                          echo '<option '.(($row_data->pmp_id==@$_POST['txt_problem'][3])?('selected'):('')).' value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
                                        }
                                      }else{
                                        echo '<option value="" data-price="0">Choose Problem</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6" style="padding-right: 0px;">
                                      <input readonly name="txt_problem_price[]" type="number" min="0" value="0" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <input name="txt_problem_discount[]" type="number" min="0" value="<?= @$_POST['txt_problem_discount'][3]??0 ?>" class="form-control"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-7" style="padding-right: 0px;">
                                  <select name="txt_problem[]" class="form-control select2" style="width: 100%">
                                    <?php 
                                      $get_data = $connect->query("SELECT pmp_id,pmp_name,pmp_price,pmp_price_extra FROM tbl_pos_product_model_problem WHERE pmp_model=".@$_POST['txt_product_model']);
                                      if(@mysqli_num_rows($get_data)){
                                        echo '<option value="" data-price="0" data-price-extra="0">Choose Problem</option>';
                                        while($row_data = mysqli_fetch_object($get_data)){
                                          echo '<option '.(($row_data->pmp_id==@$_POST['txt_problem'][4])?('selected'):('')).' value="'.$row_data->pmp_id.'" data-price="'.$row_data->pmp_price.'" data-price-extra="'.$row_data->pmp_price_extra.'" data-name="'.$row_data->pmp_name.'">'.$row_data->pmp_name.'</option>';
                                        }
                                      }else{
                                        echo '<option value="" data-price="0">Choose Problem</option>';
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-xs-5">
                                  <div class="row">
                                    <div class="col-xs-6" style="padding-right: 0px;">
                                      <input readonly name="txt_problem_price[]" type="number" min="0" value="0" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px;">
                                      <input name="txt_problem_discount[]" type="number" min="0" value="<?= @$_POST['txt_problem_discount'][4]??0 ?>" class="form-control"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>                                  
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group" style="display:none;">
                            <label for =""><?= $lang_text['price'][$lang] ?>:</label>                                          
                            <input required="" class="form-control" name="txt_price" readonly="" type="number" step="any" placeholder="Price" autocomplete="off" value="<?= @$_POST['txt_price']?$_POST['txt_price']:'0' ?>">          
                          </div>
                        </div>
                        <div class="col-xs-6" style="display:none;">
                          <div class="form-group">
                            <label for ="" style="display: block;"><?= $lang_text['discount'][$lang] ?>: 
                              <span class="pull-right">
                                <label  for="dollar"><strong>$</strong></label>
                                <input type="radio" checked="" id="dollar" name="discount_condition" value="1">
                                &nbsp;|&nbsp;
                                <label  for="percentage"><strong>%</strong></label>
                                <input type="radio" id="percentage" name="discount_condition" value="2">
                              </span>
                            </label>                                          
                            <input class="form-control" name="txt_discount" type="number" step="any" min="0" placeholder="Price" autocomplete="off" value="<?= (@$_POST['txt_discount']?$_POST['txt_discount']:'0') ?>">          
                          </div> 
                        </div>
                        <div class="col-xs-12">
                          <div class="form-group">
                            <label for =""><?= $lang_text['subTotal'][$lang] ?>:</label>                                          
                            <input required="" class="form-control" name="txt_sub_total" readonly="" type="number" step="any" placeholder="sub total" autocomplete="off" value="<?= @$_POST['txt_sub_total'] ?>">          
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="note"><?= $lang_text['note'][$lang] ?>:</label>
                          <textarea class="form-control" style="height: 110px;" name = "txt_note"  autocomplete="off"><?= @$_POST['txt_note'] ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <button onclick="document.getElementById('btn_hidden_submit').click; this.style.display='none'; var _this=this; setTimeout(function(){ _this.style.display='inline'; },1500 )" name="btn_add" class="btn blue"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                            <button name="btn_add" id="btn_hidden_submit" class="btn blue hidden"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
                            <a href="index.php" id="back" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></a>
                        </div>
                    </div>
                </div>
              </form><br>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../assets/global/plugins/jquery.min.js"></script>
<script type="text/javascript">
  //$('select[name="txt_customer_name"]').change(function(){
    //$v_cus_id = $(this).val();
    //$.ajax({url: "ajx_get_cus_tel.php?cus_id="+$v_cus_id, success: function(result){
     // $('input[name="txt_contact_number"]').val(result);
    //}});
  //});
  $(document).ready(function(){
    $('#buttonProblem').hide();
    $('select[name="txt_product_model"]').change(function(){
      $v_model_id = $(this).val();
      $v_model_name = $(this).find(":selected").text();
      if($v_model_id){
        $('#txt_model_id').val($v_model_id);
        $('#model_name').html($v_model_name);
        $('#buttonProblem').show();
      }else{
        $('#buttonProblem').hide();
      }
      $.ajax({url: "ajx_get_problem.php?model_id="+$v_model_id, success: function(result){
        $('select[name="txt_problem[]"]').html(result);
        if($('select[name="txt_problem[]"]').eq(0).find('option').length<=1){
          $('#modal-add-problem').modal('show');
        }
      }});
    });
    $('select[name="txt_problem[]"]').change(function(e){
      calculateDiscount();
    });
    $('select[name="txt_product_status"]').change(function(){
      calculateDiscount();
    });
    $('form').submit(function(){
      $('input[type=submit]', this).attr('disabled', 'disabled');
    });
    $('input[name="txt_discount"]').keyup(function(){ 
      if($(this).val()<0){ $(this).val(0) }
      calculateDiscount() 
    });
    $('input[name="txt_problem_discount[]"]').keyup(function(){ 
      if($(this).val()<0){ $(this).val(0) }
      calculateDiscount() 
    });
    $('input[name="discount_condition"]').click(function(){ calculateDiscount() });

    // add product problem
    $('#btn_add_problem').click(function(){
      $model_id= $('#txt_model_id').val();
      $problem= $('#txt_problem').val();
      $price= $('#txt_price').val();
      $price_extra= $('#txt_price_extra').val();
      if(!$model_id){ alert('please input model'); return false; } 
      if(!$problem){ alert('please input problem'); return false; } 
      if(!$price){ alert('please input price for new Machine'); return false; } 
      if(!$price_extra){ alert('please input price for old Machine'); return false; } 
      $.post("ajx_set_problem.php",
      {
        model_id: $model_id,
        problem: $problem,
        price: $price,
        price_extra: $price_extra
      },
      function(data, status){
        if(data.trim()=='exist'){
          alert('problem already exist please choose');
          return false;
        }
        if(status=='success'){
          if(data.trim()){
            $option_id = data.trim();
            $('#txt_problem').val('');
            $('#txt_price').val('');
            $('#txt_price_extra').val('');
            $('#modal-add-problem').modal('hide');

            $('select[name="txt_problem[]"]').prepend("<option value='"+$option_id+"' data-price='"+$price+"' data-price-extra='"+$price_extra+"' data-name='"+$problem+"'>"+$problem+"</option>");
            alert('success');
            $('input[name="txt_price"]').val($price);
            $('input[name="txt_problem_description"]').val($problem);
            calculateDiscount();
          }else{
            alert('process fails');
          }
        }
      });
    });
  });
  calculateDiscount();
  function calculateDiscount(){
    $problem_id = '';
    $problem_text = '';
    $problem_price = '';
    $problem_discount = '';
    $price = 0;
    $('select[name="txt_problem[]"]').each(function(e){
      $v_price = 0;
      $problem_id += $('option:selected', this).val()+', ';
      if($('option:selected', this).data('name')) $problem_text += $('option:selected', this).data('name')+', ';
      if($('select[name="txt_product_status"]').val()==2){
        $v_price = $('option:selected', this).data('price-extra')?$('option:selected', this).data('price-extra'):0;
      }else{
        $v_price = $('option:selected', this).data('price')?$('option:selected', this).data('price'):0;
      }
      $price += $v_price;
      $('input[name="txt_problem_price[]"]').eq(e).val($v_price);
      $problem_price += ($('input[name="txt_problem_price[]"]').eq(e).val()?$('input[name="txt_problem_price[]"]').eq(e).val():0)+', ';
      $problem_discount += ($('input[name="txt_problem_discount[]"]').eq(e).val()?$('input[name="txt_problem_discount[]"]').eq(e).val():0)+', ';
    });
    $problem_id = $problem_id.substring(0, $problem_id.length - 2);
    $problem_text = $problem_text.substring(0, $problem_text.length - 2);
    $problem_price = $problem_price.substring(0, $problem_price.length - 2);
    $problem_discount = $problem_discount.substring(0, $problem_discount.length - 2);
    $('input[name="txt_problem"]').val($problem_id.toString());
    $('input[name="txt_problem_description"]').val($problem_text);
    $('input[name="txt_price_detail"]').val($problem_price);
    $('input[name="txt_discount_detail"]').val($problem_discount);

    $('input[name="txt_price"]').val($price);
    $discount = $problem_discount.split(',').reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
    if($('#dollar').is(':checked')){
      $subTotal = $price-$discount;
    }else if($('#percentage').is(':checked')){
      $subTotal = $price-(($price*$discount)/100);
    }else{
      $subTotal = $price;
    }
    $('input[name="txt_discount"]').val($discount);
    $('input[name="txt_sub_total"]').val($subTotal);
  }
</script>
<?php include_once '../layout/footer.php' ?>
<div class="modal fade" id="modal-add-problem">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?= $lang_text['addProblemTo'][$lang] ?> <strong id="model_name">Product Model</strong></h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">        
          <div class="form-group">
            <div class="row">
              <div class="col-xs-5" style="padding-right: 0px;">
                <div class="col-xs-12">
                  <label for=""><?= $lang_text['problem'][$lang] ?></label>
                  <input type="hidden" id="txt_model_id">
                  <input type="text" class="form-control" id="txt_problem" placeholder="ex: change screen">
                </div>
              </div>
              <div class="col-xs-7" style="padding-left: 0px;">
                <div class="col-xs-6" style="padding-left: 0px;">
                  <label for=""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['newMachine'][$lang] ?></label>
                  <input type="number" class="form-control" id="txt_price" step="any" placeholder="ex: 25">
                </div>
                <div class="col-xs-6" style="padding-left: 0px;">
                  <label for=""><?= $lang_text['price'][$lang] ?> | <?= $lang_text['oldMachine'][$lang] ?></label>
                  <input type="number" class="form-control" id="txt_price_extra" step="any" placeholder="ex: 35">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_add_problem"><i class="fa fa-save fa-fw"></i><?= $lang_text['save'][$lang] ?></button>
        <button type="button" data-dismiss="modal" class="btn red"><i class="fa fa-undo fa-fw"></i> <?= $lang_text['back'][$lang] ?></button>
      </div>
    </div>
  </div>
</div>
