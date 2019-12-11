<?php 
    $menu_active =1;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 
    if(isset($_POST['search'])){
      $from = $_POST['from'];
      $to = $_POST['to'];
      $sql = "SELECT * FROM tbl_pos_expense_list AS A
                            LEFT JOIN tbl_pos_expense_category AS B ON A.exp_expense_category=B.exca_id
                            LEFT JOIN tbl_pos_employee AS C ON A.exp_employee=C.emp_id
                            WHERE exp_date_record BETWEEN '$from' AND '$to'
                            ";  
      $result = $connect->query($sql);
    }else{
      $v_date = date('Y-m-d');
      $sql = "SELECT * FROM tbl_pos_expense_list AS A
                            LEFT JOIN tbl_pos_expense_category AS B ON A.exp_expense_category=B.exca_id
                            LEFT JOIN tbl_pos_employee AS C ON A.exp_employee=C.emp_id
                            WHERE exp_date_record = '$v_date'
                            ";  
      $result = $connect->query($sql);
    }  
 
    
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Report Expense by Date</h2>
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
                        <th>Date Record</th>
                        <th>Description</th>
                        <th>Expense Category</th>
                        <th>Amount</th>
                        <th>Employee</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $i=1; 
                        $total=0;

                        while($row = $result->fetch_assoc()) 
                        { 
                          $total+= $row["exp_amount"];
                             
                          $v1=$row["exp_id"];
                          $v2=$row["exp_date_record"];
                          $v3=$row["exp_description"];
                          $v4=$row["exca_name"];
                          $v5=$row["exp_amount"];
                          $v6=$row["name_english"];
                          $v7=$row["exp_note"];
                      ?>
                      <tr>
                        <td><?php echo ($i++) ;?></td> 
                        <td><?php echo $v2;?></td>
                        <td><?php echo $v3;?></td>
                        <td><?php echo $v4;?></td>
                        <td><?php echo number_format($v5,2);?></td>
                        <td><?php echo $v6;?></td>
                        <td><?php echo $v7;?></td>
                      </tr> 
                      <?php
                        }  
                      ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total:</th>
                        <th> $
                            <?php
                                echo number_format($total,2);
                            ?>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
