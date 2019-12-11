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
               $sql = "SELECT * FROM tbl_pos_revenue_list AS A
                            LEFT JOIN tbl_pos_revenue_category AS B ON A.rev_revenue_category=B.reca_id
                            LEFT JOIN tbl_pos_employee AS C ON A.rev_employee=C.emp_id
                            WHERE rev_date_record BETWEEN '$dateStart' AND '$dateEnd' AND A.rev_revenue_category='$v_option'
                            ";  
        $result = $connect->query($sql);
      }else{
           $sql = "SELECT * FROM tbl_pos_revenue_list AS A
                            LEFT JOIN tbl_pos_revenue_category AS B ON A.rev_revenue_category=B.reca_id
                            LEFT JOIN tbl_pos_employee AS C ON A.rev_employee=C.emp_id
                            WHERE rev_date_record BETWEEN '$dateStart' AND '$dateEnd'
                            ";  
      $result = $connect->query($sql);
      }            
    }else{
      $v_date = date('Y-m-d');
      $sql = "SELECT * FROM tbl_pos_revenue_list AS A
                            LEFT JOIN tbl_pos_revenue_category AS B ON A.rev_revenue_category=B.reca_id
                            LEFT JOIN tbl_pos_employee AS C ON A.rev_employee=C.emp_id
                            WHERE rev_date_record ='$v_date'
                            ";  
      $result = $connect->query($sql);
    }

    
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Report Revenue by Category</h2>
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
                      <option value="">==choose category==</option>
                      <?php
                            $v_select = mysqli_query($connect,"SELECT * FROM tbl_revenue_category");
                            while ($row1 = mysqli_fetch_assoc($v_select)) {
                                if($row1['reca_id'] == @$_POST['txt_option'])
                                    echo '<option SELECTED value="'.$row1['reca_id'].'">'.$row1['reca_name'].'</option>';
                                else
                                    echo '<option value="'.$row1['reca_id'].'">'.$row1['reca_name'].'</option>';
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
                        <th>Date Record</th>
                        <th>Description</th>
                        <th>Revenue Category</th>
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
                          $total+= $row["rev_amount"];
                             
                          $v1=$row["rev_id"];
                          $v2=$row["rev_date_record"];
                          $v3=$row["rev_description"];
                          $v4=$row["reca_name"];
                          $v5=$row["rev_amount"];
                          $v6=$row["name_english"];
                          $v7=$row["rev_note"];
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
