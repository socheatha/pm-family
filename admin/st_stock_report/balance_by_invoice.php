<?php 
    $menu_active =3;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 
  $sql = "SELECT * , SUM(qty_in) AS total_qty_in FROM tbl_pos_stockin A  
                    LEFT JOIN tbl_pos_product B ON A.pro_id = B.pro_id 
                    LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id
                    GROUP BY A.pro_id
                     ";
  $result = $connect->query($sql); 
    
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Report Stock Balance by Invoice</h2>
        </div>
    </div>
    <br>
    <br>
       <div class="portlet-title">
        <div class="caption font-dark">
            <form class="form-inline" method = "post" action="">
              <div class="form-group">
                <select name="txt_s_number" class="form-control">
                  <option value="">==choose invoice==</option>
                <?php 
                  $s_number = $connect->query("SELECT * FROM tbl_pos_stockout GROUP BY invoice ORDER BY invoice ASC");
                  while ($row_s_number = mysqli_fetch_object($s_number)) {
                    if($row_s_number->invoice == @$_POST['txt_s_number']){
                      echo '<option value="'.$row_s_number->invoice.'" SELECTED>'.$row_s_number->invoice.'</option>';
                    }else{
                      echo '<option value="'.$row_s_number->invoice.'">'.$row_s_number->invoice.'</option>';
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
                      <th>Photo</th>
                      <th>Code</th>
                      <th>Name(En)</th>
                      <th>Name(Kh)</th>
                      <th>Category</th>
                      <th class="text-center">Qty In</th>
                      <th class="text-center">Qty Out</th>
                      <th class="text-center">Qty Adjust</th>
                      <th class="text-center">Balance</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      while($row = $result->fetch_assoc()) 
                      {     
                        $photo = $row['photo'];
                        $v2=$row["code"];
                        $v3=$row["name_en"];
                        $v4=$row["name_kh"];
                        $v5=$row["qty_in"];
                        $v6=$row["qty_left"];
                        $v7 = $v5 - $v6;
                        
                        
                       
                    ?>
                    <tr>
                        <td><?php echo '<img src="../../img/img_product/' . $photo . '" style="width: 50px;" alt="Logo">';?></td>
                      <td><?php echo $v2;?></td>
                      <td><?php echo $v3;?></td>
                      <td><?php echo $v4;?></td>
                      <td><?php echo $row['category_name'] ?></td>
                      <td class="text-center">
                      
                        <?php $v_total_sum_qty_in = ($row['total_qty_in'])?($row['total_qty_in']):("0") ?>
                        <?php echo number_format($v_total_sum_qty_in,0) ;?>

                      </td>
                      <td class="text-center">

                        <?php 
                          $v_out_id = $row['pro_id']; 
                          if(isset($_POST['search']) AND $_POST['txt_s_number'] !=""){
                            $v_s_number = @$_POST['txt_s_number'];
                            $get_qty_out = $connect->query("SELECT SUM(qty_out) AS total_sum_qty_out FROM  tbl_pos_stockout WHERE pro_id='$v_out_id' AND invoice<='$v_s_number'");

                          }else{
                            $get_qty_out = $connect->query("SELECT SUM(qty_out) AS total_sum_qty_out FROM  tbl_pos_stockout WHERE pro_id='$v_out_id'");
                            
                          }


                         
                          $row_out = mysqli_fetch_assoc($get_qty_out);
                          
                          $v_total_sum_qty_stockout =($row_out['total_sum_qty_out'])?($row_out['total_sum_qty_out']):("0") ; 
                          echo number_format($v_total_sum_qty_stockout,0) ;
                        ?>

                      </td>
                      <td class="text-center">
                        
                        <?php 
                          $v_add_id = $row['pro_id']; ;
                          $get_qty_add = $connect->query("SELECT SUM(sa_qty_add) AS total_qty_add FROM  tbl_pos_stock_adjust WHERE sa_product_code='$v_add_id'");
                          $row_add = mysqli_fetch_assoc($get_qty_add);
                          $v_total_sum_qty_add =($row_add['total_qty_add'])?($row_add['total_qty_add']):("0") ; 

                          $v_minus_id = $row['pro_id']; ;
                          $get_qty_minus = $connect->query("SELECT SUM(sa_qty_minus) AS total_qty_minus FROM  tbl_pos_stock_adjust WHERE sa_product_code='$v_minus_id'");
                          $row_minus = mysqli_fetch_assoc($get_qty_minus);
                          $v_total_sum_qty_minus =($row_minus['total_qty_minus'])?($row_minus['total_qty_minus']):("0") ; 

                          $v_qty_adjust=$v_total_sum_qty_add-$v_total_sum_qty_minus;
                          echo number_format($v_qty_adjust,0);
                        ?>

                      </td>
                      <td class="text-center">
                          <?php echo number_format($v_total_sum_qty_in-$v_total_sum_qty_stockout+$v_qty_adjust,0) ?>

                      </td>
                      <td class="text-center">
                      <?php
                          if($v7 < 2 & $v7 > 0){
                           echo '<span class="label label-warning">Low Stock</span>';
                          }
                          elseif ($v7 <= 0 ){
                             echo '<span class="label label-danger">Out Of Stock</span>';
                          }
                          else{
                             echo '<span class="label label-success">Available</span>';
                          }
                      ?>  
                      </td>
                    </tr> 
                    <?php
                      }  
                    ?>
              </tbody>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
