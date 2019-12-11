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
            <h2><i class="fa fa-image fa-fw"></i> Report Stock Balance by Date</h2>
        </div>
    </div>
    <br>
    <br>
       <div class="portlet-title">
        <div class="caption font-dark">
            <form class="form-inline" method = "post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="start date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" name = "txt_date" value="<?= @$_POST['txt_date'] ?>">
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
                      <th>Qty In</th>
                      <th>Qty Out</th>
                      <th>Qty Adjust</th>
                      <th>Balance</th>
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
                      <td>
                      
                        <?php $v_total_sum_qty_in = ($row['total_qty_in'])?($row['total_qty_in']):("0") ?>
                        <?php echo $v_total_sum_qty_in ;?>

                      </td>
                      <td>

                        <?php 
                          $v_out_id = $row['pro_id'];
                          if(isset($_POST['search']) AND $_POST['txt_date'] !=""){
                            $v_s_date = @$_POST['txt_date'];
                            $get_qty_out = $connect->query("SELECT SUM(qty_out) AS total_sum_qty_out FROM  tbl_pos_stockout WHERE pro_id='$v_out_id' AND  date_out<='$v_s_date'");
                          }else{
                            $get_qty_out = $connect->query("SELECT SUM(qty_out) AS total_sum_qty_out FROM  tbl_pos_stockout WHERE pro_id='$v_out_id'");
                          }
                          
                          $row_out = mysqli_fetch_assoc($get_qty_out);
                          
                          $v_total_sum_qty_stockout =($row_out['total_sum_qty_out'])?($row_out['total_sum_qty_out']):("0") ; 
                          echo $v_total_sum_qty_stockout ;
                        ?>

                      </td>
                      <td>
                        
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
                          echo $v_qty_adjust;
                        ?>

                      </td>
                      <td>
                          <?php echo $v_total_sum_qty_in-$v_total_sum_qty_stockout+$v_qty_adjust ?>

                      </td>
                      <td>
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
