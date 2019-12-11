<?php 
    $menu_active =1;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php  
  if(isset($_POST['search'])){
    $dateStart = $_POST['from'];
    $dateEnd = $_POST['to'];
    if($_POST['txt_option'] != ""){
      $pro_id_s = $_POST['txt_option'];
      $sql = "SELECT * FROM tbl_pos_stockout A 
                  LEFT JOIN tbl_pos_product B ON A.pro_id=B.pro_id
                  LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id
                  LEFT JOIN tbl_pos_user AS U ON U.id=A.so_user_id
                  WHERE date_out >= '$dateStart' AND date_out <= '$dateEnd' AND A.pro_id='$pro_id_s'";
      $result = $connect->query($sql);
    }else{
      $sql = "SELECT * FROM tbl_pos_stockout A 
                  LEFT JOIN tbl_pos_product B ON A.pro_id=B.pro_id
                  LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id
                  LEFT JOIN tbl_pos_user AS U ON U.id=A.so_user_id
                  WHERE date_out >= '$dateStart' AND date_out <= '$dateEnd'";
      $result = $connect->query($sql);
    }            
  }else{
    $v_date = date('Y-m-d');
      $sql = "SELECT * FROM tbl_pos_stockout A 
                  LEFT JOIN tbl_pos_product B ON A.pro_id=B.pro_id
                  LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id
                  LEFT JOIN tbl_pos_user AS U ON U.id=A.so_user_id
                  WHERE date_out = '$v_date'";
    $result = $connect->query($sql);
  }
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Report Sell by Product</h2>
        </div>
    </div>
    <br>
    <br>
       <div class="portlet-title">
        <div class="caption font-dark">
            <form class="form-inline" method = "post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="start date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" name = "from" value="<?= @$_POST['from'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="end date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" name = "to" value="<?= @$_POST['to'] ?>"> 
                </div>
                <div class="form-group">
                    <select class="form-control selectpicker" data-live-search="true" name = "txt_option"> 
                      <option value="">==choose product==</option>
                      <?php 
                        $vv_search = $connect->query("SELECT * FROM tbl_pos_product GROUP BY ref ORDER BY ref ASC");
                        while ($row_vv_search = mysqli_fetch_object($vv_search)) {
                          if($row_vv_search->pro_id == @$_POST['txt_option']){
                            echo '<option SELECTED value="'.$row_vv_search->pro_id.'">'.$row_vv_search->ref.'</option>';
                          }else{
                            echo '<option value="'.$row_vv_search->pro_id.'">'.$row_vv_search->ref.'</option>';
                          }
                        }
                       ?>
                    </select>
                </div>
                <button type="submit" name="search" class="btn btn-success">Search</button>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
          </form> 
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
              <thead>
                  <tr>
                      <!-- <th>ID</th> -->
                      <th>Date</th>
                      <th>Invoice</th>
                      <th>Code</th>
                      <th>Reference</th>
                      <th>Name</th>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Discount</th>
                      <th class="text-center">Amount</th>
                      <th>Employee</th>
                      <th>Category</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $total_qty=0;
                      $total_discount=0;
                      $total_amount=0;
                      
                      while($row = @$result->fetch_assoc()) 
                      {     
                        $total_qty+= $row["qty_out"]; 
                        $total_discount+= $row["discount"];   
                        $total_amount+= $row["amount"];   
                        echo '<tr>';
                          echo '<td>'.$row["date_out"].'</td>';
                          echo '<td>'.sprintf('%08d',$row["invoice"]).'</td>';
                          echo '<td>'.$row["code"].'</td>';
                          echo '<td>'.$row["ref"].'</td>';
                          echo '<td>'.$row["name_en"].' :: '.$row["name_kh"].'</td>';
                          echo '<th class="text-center">'.$row["qty_out"].'</th>';
                          echo '<td class="text-center">'.$row["price"].'</td>';
                          echo '<td class="text-center">'.$row["discount"].'</td>';
                          echo '<th class="text-center">'.$row["amount"].'</th>';
                          echo '<td>'.$row["username"].'</td>';
                          echo '<td>'.$row["category_name"].'</td>';
                        echo '</tr>';   
                      }  
                    ?>
              </tbody>
              <tfoot>
                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th class="text-right">Total:</th>
                      <th class="text-center"><?= number_format($total_qty,2) ?> </th>
                      <th></th>
                      <th class="text-center"><?= number_format($total_discount,2) ?> </th>
                      <th class="text-center"><?= number_format($total_amount,2) ?> </th>
                      <th></th>
                      <th></th>
                  </tr>
              </tfoot>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
