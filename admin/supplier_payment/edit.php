<?php 
    $menu_active =4;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<?php 
    if(isset($_POST['btn_update'])){
        $v_id = @$connect->real_escape_string($_POST['txt_id']);
        $v_date_record = @$connect->real_escape_string($_POST["txt_date_record"]);
        $v_supplier_invoice_no = @$connect->real_escape_string($_POST["txt_supplier_invoice_no"]);
        $v_supplier_name = @$connect->real_escape_string($_POST["txt_supplier_name"]);
        $v_full_amount = @$connect->real_escape_string($_POST["txt_full_amount"]);
        $v_pay_amount = @$connect->real_escape_string($_POST["txt_pay_amount"]);
        $v_balance = @$connect->real_escape_string($_POST["txt_balance"]);
        $v_note = @$connect->real_escape_string($_POST["txt_note"]);
        
        $query_update = "UPDATE tbl_pos_supplier_invoice SET 
                                    supi_date_record = '$v_date_record' 
                                    , supi_supplier_invoice_no = '$v_supplier_invoice_no'
                                    , supi_supplier_name         = '$v_supplier_name'
                                    , supi_full_amount       = '$v_full_amount'
                                    , supi_pay_amount       = '$v_pay_amount'
                                    , supi_balance       = '$v_balance'
                                    , supi_note          = '$v_note'
                                    WHERE supi_id = '$v_id'" ;
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
    $edit_id = @$_GET['edit_id'];
    $old_data = $connect->query("SELECT * FROM tbl_pos_supplier_invoice WHERE supi_id='$edit_id'");
    $row_old = mysqli_fetch_object($old_data);


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
                <form action="<?= $_SERVER['PHP_SELF'] ?>?edit_id=<?= $edit_id ?>" method="post" enctype="multipart/form-data" oninput="cal_balance()">
                    <input type="hidden" name="txt_id" value="<?= $row_old->supi_id ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date Record
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="txt_date_record" placeholder="" required="required" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="<?= $row_old->supi_date_record ?>">
                                </div>
                                <div class="form-group">
                                    <label>Invoice Number
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="txt_supplier_invoice_no" placeholder="" required="required" autocomplete="off" value="<?= $row_old->supi_supplier_invoice_no ?>">
                                </div>
                                <div class="form-group">
                                    <label for = "">Supplier Name :</label>
                                    <select class = "form-control" name="txt_supplier_name" required>
                                      <option value="">==== Select and Choose ====</option>
                                          <?php
                                            $v_select = mysqli_query($connect,"SELECT * FROM tbl_pos_vender ORDER BY vendername_en ASC");
                                            while ($row_select = mysqli_fetch_assoc($v_select)) { 
                                                if($row_select['vender_id'] == $row_old->supi_supplier_name){
                                                    ?>
                                                        <option SELECTED value="<?php echo $row_select['vender_id']; ?>"><?php echo $row_select['vendername_en']; ?> :: <?php echo $row_select['vendername_en']; ?></option>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <option value="<?php echo $row_select['vender_id']; ?>"><?php echo $row_select['vendername_en']; ?> :: <?php echo $row_select['vendername_en']; ?></option>
                                                    <?php
                                                }
                                            }
                                           ?>   
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for ="">Full Amount :</label>                                          
                                    <input class="form-control" required id="id_full_amount" name="txt_full_amount" type="text" placeholder="full amount..." value="<?= $row_old->supi_full_amount ?>">          
                                </div>
                                <div class="form-group">
                                    <label for ="">Pay Amount :</label>                                          
                                    <input class="form-control" required id="id_pay_amount" name="txt_pay_amount" type="text" placeholder="pay amount..." value="<?= $row_old->supi_pay_amount ?>">    
                                </div>
                                <div class="form-group">
                                    <label for ="">Balance :</label>                                          
                                   <input class="form-control" readonly id="id_balance" name="txt_balance" type="text" placeholder="balance..." value="<?= $row_old->supi_balance ?>">  
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Note
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <textarea class="form-control" name="txt_note" placeholder="" required="required" autocomplete="off" style="height: 251px;"><?= $row_old->supi_note ?></textarea>
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
<script type="text/javascript">
    function cal_balance(){
        jsv_full_amount = document.getElementById('id_full_amount').value;
        jsv_pay_amount = document.getElementById('id_pay_amount').value;
        jsv_balance = (Number(jsv_full_amount)-Number(jsv_pay_amount)).toFixed(2);
        document.getElementById('id_balance').value = jsv_balance;

    }
</script>
<?php include_once '../layout/footer.php' ?>