<?php 
    $menu_active =9998; 
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>   
<?php 
    if(@$_GET['history_status']){ 
        $_SESSION['history_status']=$_GET['history_status']; 
        header('location: index.php');
    }
    if(!@$_SESSION['history_status']){
        $_SESSION['history_status']='0962195196'; 
    }

    if(@$_POST['from'] && @$_POST['to']){
        $_SESSION['history_from'] = $_POST['from'];
        $_SESSION['history_to'] = $_POST['to']; 
    }else{
        $_SESSION['history_from'] = '';
        $_SESSION['history_to'] = '';
    }

    if(@$_POST['txt_employee']){
        $_SESSION['history_employee'] = $_POST['txt_employee'];
    }else{
        $_SESSION['history_employee'] = '';
    }
    
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-tasks fa-fw"></i> <?= $lang_text['reportTransaction'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <form class="form-inline" method = "post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="start date" data-provide="datepicker" data-date-format="yyyy-mm-dd" name = "from" value="<?= @$_SESSION['history_from'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="end date" data-provide="datepicker" data-date-format="yyyy-mm-dd" name = "to" value="<?= @$_SESSION['history_to'] ?>"> 
                </div>
                <div class="form-group">
                    <select class="form-control selectpicker" data-live-search="true" name = "txt_employee"> 
                      <option value="">==please Choose==</option>
                      <?php 
                        $vv_search = $connect->query("SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                        while ($row_vv_search = mysqli_fetch_object($vv_search)) {
                          if($row_vv_search->emp_id == @$_SESSION['history_employee']){
                            echo '<option SELECTED value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.'</option>';
                          }else{
                            echo '<option value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.'</option>';
                          }
                        }
                       ?>
                    </select>
                </div>
                <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> <?= $lang_text['search'][$lang] ?></button>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> <?= $lang_text['clear'][$lang] ?></a>
          </form> 
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2_server_side" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th><?= $lang_text['invoice'][$lang] ?></th>
                        <th><?= $lang_text['cashedDate'][$lang] ?></th>
                        <th><?= $lang_text['checkinDate'][$lang] ?></th>
                        <th><?= $lang_text['customer'][$lang] ?></th>
                        <th><?= $lang_text['productModel'][$lang] ?></th>
                        <th><?= $lang_text['productStatus'][$lang] ?></th>
                        <th><?= $lang_text['boardNumber'][$lang] ?></th>
                        <th><?= $lang_text['problem'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['price'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['discount'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['subTotal'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['cost'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['profit'][$lang] ?></th>
                        <th><?= $lang_text['alertDate'][$lang] ?></th>
                        <th><?= $lang_text['finishedDate'][$lang] ?></th>
                        <th><?= $lang_text['fixByEmployee'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><em><?= $lang_text['status'][$lang] ?></em></th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <th><?= $lang_text['invoice'][$lang] ?></th>
                        <th><?= $lang_text['cashedDate'][$lang] ?></th>
                        <th><?= $lang_text['checkinDate'][$lang] ?></th>
                        <th><?= $lang_text['customer'][$lang] ?></th>
                        <th><?= $lang_text['productModel'][$lang] ?></th>
                        <th><?= $lang_text['productStatus'][$lang] ?></th>
                        <th><?= $lang_text['boardNumber'][$lang] ?></th>
                        <th><?= $lang_text['problem'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['price'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['discount'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['subTotal'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['cost'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['profit'][$lang] ?></th>
                        <th><?= $lang_text['alertDate'][$lang] ?></th>
                        <th><?= $lang_text['finishedDate'][$lang] ?></th>
                        <th><?= $lang_text['fixByEmployee'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                        <th><em><?= $lang_text['status'][$lang] ?></em></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>