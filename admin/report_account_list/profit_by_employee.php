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
        $v_option = $_POST['txt_option'];
        $sql = "SELECT *,SUM(rev_amount) AS total_revenue FROM tbl_pos_revenue_list AS A 
          LEFT JOIN tbl_pos_revenue_category AS RL ON RL.reca_id=A.rev_revenue_category
          LEFT JOIN tbl_pos_employee AS EMP ON EMP.emp_id=A.rev_employee
                                WHERE A.rev_date_record BETWEEN '$dateStart' AND '$dateEnd' AND A.rev_employee='$v_option'
                                GROUP BY A.rev_date_record
                                  ";  
        $result = $connect->query($sql);
      }else{
        $sql = "SELECT *,SUM(rev_amount) AS total_revenue FROM tbl_pos_revenue_list AS A 
          LEFT JOIN tbl_pos_revenue_category AS RL ON RL.reca_id=A.rev_revenue_category
          LEFT JOIN tbl_pos_employee AS EMP ON EMP.emp_id=A.rev_employee
                                WHERE A.rev_date_record BETWEEN '$dateStart' AND '$dateEnd'
                                GROUP BY A.rev_date_record
                                  ";  
        $result = $connect->query($sql);
      }            
    }else{
      $v_date = date('Y-m-d');
      $sql = "SELECT *,SUM(rev_amount) AS total_revenue FROM tbl_pos_revenue_list AS A 
        LEFT JOIN tbl_pos_revenue_category AS RL ON RL.reca_id=A.rev_revenue_category
        LEFT JOIN tbl_pos_employee AS EMP ON EMP.emp_id=A.rev_employee
                              WHERE A.rev_date_record='$v_date'
                              GROUP BY A.rev_date_record
                                ";  
      $result = $connect->query($sql);
    }
    
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Report Profit by Employee</h2>
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
                    <select class="form-control" name = "txt_option"> 
                      <option value="">==choose employee==</option>
                      <?php 
                        $vv_search = $connect->query("SELECT * FROM tbl_pos_employee ORDER BY name_english ASC");
                        while ($row_vv_search = mysqli_fetch_object($vv_search)) {
                          if($row_vv_search->emp_id == @$_POST['txt_option']){
                            echo '<option SELECTED value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.' :: '.$row_vv_search->name_khmer.'</option>';
                          }else{
                            echo '<option value="'.$row_vv_search->emp_id.'">'.$row_vv_search->name_english.' :: '.$row_vv_search->name_khmer.'</option>';
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
                        <th>N&deg;</th>
                        <th>Date</th>
                        <th>Revenue</th>
                        <th>Expense</th>
                        <th>Balance</th>
                        <th>Employee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        $v_sum_rev=0;
                        $v_sum_exp=0;
                        $v_sum_bal=0;

                        
                        while($row = $result->fetch_assoc()) 
                        {     
                          $v2=($row["rev_date_record"]);
                      ?>
                      <tr>
                        <td><?php echo ($i++) ;?></td> 
                        <td><?php echo $v2 ;?></td>
                        <td>

                          <?php $v_total_sum_revenue =($row['total_revenue'])?($row['total_revenue']):("0")  ?>
                          <?php echo number_format($v_total_sum_revenue,2); ?>
                          <?php $v_sum_rev+=$v_total_sum_revenue ; ?>

                        </td>
                        <td>

                          <?php 
                            $v_out_date = $row['rev_date_record']; ;
                            $get_expense = $connect->query("SELECT SUM(exp_amount) AS total_expense FROM  tbl_pos_expense_list WHERE exp_date_record='$v_out_date'");
                            $row_out = mysqli_fetch_assoc($get_expense);
                            
                            $v_total_sum_qty_stockout =($row_out['total_expense'])?($row_out['total_expense']):("0") ; 
                            echo number_format($v_total_sum_qty_stockout,2);
                            $v_sum_exp+=$v_total_sum_qty_stockout ;
                          ?>

                        </td>
                        <td>

                            <?php 
                                $v_total_balance=$v_total_sum_revenue-$v_total_sum_qty_stockout;
                            echo number_format($v_total_balance,2);
                            $v_sum_bal+=$v_total_balance ;
                          ?>

                        </td>
                        <td><?= $row['name_english'] ?></td>
                      </tr> 
                      <?php
                        }  
                      ?>
                </tbody>

                <tfoot>
                  <th></th>
                  <th></th>
                  <th>$
                    <?php
                      echo number_format($v_sum_rev,2);
                    ?>
                  </th>
                  <th>$
                    <?php
                      echo number_format($v_sum_exp,2);
                    ?>
                  </th>
                  <th>$
                    <?php
                      echo number_format($v_sum_bal,2);
                    ?>
                  </th>
                  <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
