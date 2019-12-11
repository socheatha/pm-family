<?php 
    $menu_active =3;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?> 
<?php 
  if(isset($_POST['search'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $sql = "SELECT * FROM tbl_pos_stockin A  
    LEFT JOIN tbl_pos_product B ON A.pro_id = B.pro_id 
    LEFT JOIN tbl_pos_employee C ON A.emp_id = C.emp_id 
    LEFT JOIN tbl_pos_vender D ON A.vender_id = D.vender_id 
    LEFT JOIN tbl_pos_category E ON B.cate_id=E.cate_id
    WHERE date_in BETWEEN '$from' AND '$to'"; 
    $result = $connect->query($sql);
  }else{
    $v_date = date('Y-m-d');
    $sql = "SELECT * FROM tbl_pos_stockin A  
    LEFT JOIN tbl_pos_product B ON A.pro_id = B.pro_id 
    LEFT JOIN tbl_pos_employee C ON A.emp_id = C.emp_id 
    LEFT JOIN tbl_pos_vender D ON A.vender_id = D.vender_id 
    LEFT JOIN tbl_pos_category E ON B.cate_id=E.cate_id
    WHERE date_in = '$v_date'"; 
    $result = $connect->query($sql);
  }      
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> <?= $lang_text['stockInByDate'][$lang] ?></h2>
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
                <button type="submit" name="search" class="btn btn-success"><?= $lang_text['search'][$lang] ?></button>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> <?= $lang_text['clear'][$lang] ?></a>
          </form> 
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
              <thead>
                  <tr>
                    <th><?= $lang_text['date'][$lang] ?></th>
                    <th><?= $lang_text['code'][$lang] ?></th>
                    <th><?= $lang_text['referenceName'][$lang] ?></th>
                    <th><?= $lang_text['productName'][$lang] ?></th>
                    <th class="text-center"><?= $lang_text['qty'][$lang] ?></th>
                    <th class="text-center"><?= $lang_text['amount'][$lang] ?></th>
                    <th><?= $lang_text['supplier'][$lang] ?></th>
                    <th><?= $lang_text['employee'][$lang] ?></th>
                    <th><?= $lang_text['category'][$lang] ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $total=0;

                      while($row = $result->fetch_assoc()) 
                      {     
                        $total+= $row["qty_in"]; 
                        echo '<tr>';
                          echo '<td>'.$row["date_in"].'</td>';
                          echo '<td>'.$row["code"].'</td>';
                          echo '<td>'.$row["ref"].'</td>';
                          echo '<td>'.$row["name_en"].'</td>';
                          echo '<th class="text-center">'.$row["qty_in"].'</th>';
                          echo '<td class="text-center">'.$row["amount"].'</td>';
                          echo '<td>'.$row["vendername_en"].'</td>';
                          echo '<td>'.$row["name_english"].'</td>';
                          echo '<td>'.$row["category_name"].'</td>';
                        echo '</tr>';
                      }  
                    ?>
              </tbody>
              <tfoot>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="text-right">Total:</td>
                      <td class="text-center"> 
                          <?php
                              echo number_format($total,0);
                          ?>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
              </tfoot>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
