<?php 
    $menu_active =9998;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header_frame.php';
?>
 
<?php 
    if(isset($_POST['btn_update'])){
        $v_id = @$connect->real_escape_string($_POST['txt_id']);
        $date      = @$connect->real_escape_string($_POST["date"]);
        $v_product_name      = @$connect->real_escape_string($_POST["tbox_product"]);
        $qauntity  = @$connect->real_escape_string($_POST["qauntity"]);
    
        $query_update = "UPDATE tbl_pos_stockout SET date_out  ='$date'
                            , pro_id        = '$v_product_name' 
                            , qty_out        = '$qauntity'
                                WHERE 
                                transaction_id = '$v_id'" ;
        if($connect->query($query_update)){
            $sms = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Successfull!</strong> Data update ...
            </div>'; 
            header('location: index.php?parent_id='.@$_GET['parent_id']);
        }else{
            $sms = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Query error ...
            </div>';   
        }
    }


// get old data 
    $edit_id = @$_GET['edit_id'];
    $old_data = $connect->query("SELECT * FROM tbl_pos_stockout WHERE transaction_id='$edit_id'");
    $row_old = mysqli_fetch_object($old_data);


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
                    <input type="hidden" name="txt_id" value="<?= $row_old->transaction_id ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for =""><?= $lang_text['date'][$lang] ?>:</label>                                          
                                <input class="form-control" required name="date" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="date..." autocomplete="off" value="<?= $row_old->date_out ?>">          
                              </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for = ""><?= $lang_text['productName'][$lang] ?>:</label>
                                <select class = "form-control" id="id_product" readonly name = "tbox_product" required="">
                                        <?php
                                          $v_select = mysqli_query($connect,"SELECT * FROM tbl_pos_product ORDER BY code");
                                          while ($row = mysqli_fetch_assoc($v_select)) {
                                            if($row_old->pro_id == $row['pro_id']){
                                                echo '<option SELECTED value="'.$row['pro_id'].'">'.$row['code']." :: ".$row['name_en'].'</option>';
                                                
                                            }
                                          }
                                        ?>     
                                </select>        
                              </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label for =""><?= $lang_text['qty'][$lang] ?>:</label>                                          
                                <input class="form-control quantity"  value="<?= $row_old->qty_out ?>" required name="qauntity" type="number" placeholder="qauntity..." autocomplete="off">          
                              </div>                           
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_update" class="btn green"><i class="fa fa-save fa-fw"></i> <?= $lang_text['save'][$lang] ?></button>
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
