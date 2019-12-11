<?php 
    $menu_active =9998;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>  
<?php 
    // set fix type
    if(@$_GET['ft_id']!=''){
        $_SESSION['fix_type_status'] = @$_GET['ft_id'];
    }
    if(@$_SESSION['fix_type_status']==""){
        $_SESSION['fix_type_status'] = "0962195196";
    }
?>
<?php 
    $v_current_month=date('Y-m');
    if($_SESSION['fix_type_status']=="0962195196"){
        $condition = " (DATE_FORMAT(A.t_date_cashed,'%Y-%m')='".$v_current_month."' OR A.t_fix_status<3) ";
    }else if($_SESSION['fix_type_status']=="3"){
        $condition = " (DATE_FORMAT(A.t_date_cashed,'%Y-%m')='".$v_current_month."') AND A.t_fix_status='".$_SESSION['fix_type_status']."' ";
    }else{
        $condition = " A.t_fix_status='".$_SESSION['fix_type_status']."' ";
    }
    $get_data = $connect->query("SELECT 
        A.*,
        H.name_english,
        G.mt_name,
        E.ft_name,
        I.name_en,
    (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost 
    FROM tbl_transaction AS A 
    LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
    LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
    LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
    LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
    LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
    LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
    WHERE $condition
    GROUP BY A.t_id
    ORDER BY A.t_date_received ASC"); 
?>
 <style>
     tr.alert > *:not(:last-child) { color: red; }
 </style>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> List of Transaction</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark" style="margin-right: 5px;">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <?php 
            $_get_count_tab = $connect->query("SELECT A.*, 
                (SELECT count(*) FROM tbl_transaction WHERE (DATE_FORMAT(t_date_cashed,'%Y-%m')='$v_current_month' OR t_fix_status<3) ) AS count_all,
                (SELECT count(*) FROM tbl_transaction WHERE t_fix_status=0) AS count_pending,
                (SELECT count(*) FROM tbl_transaction WHERE t_fix_status=1) AS count_doing,
                (SELECT count(*) FROM tbl_transaction WHERE t_fix_status=2) AS count_finish,
                (SELECT count(*) FROM tbl_transaction WHERE (DATE_FORMAT(t_date_cashed,'%Y-%m')='$v_current_month') AND t_fix_status=3) AS count_cashed
                FROM tbl_transaction AS A");
            $v_row_count_tab = mysqli_fetch_object($_get_count_tab);
        ?>
        <div class="caption font-dark" style="margin-right: 2px;">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?ft_id=0962195196" class="btn btn-default <?= (($_SESSION['fix_type_status']=="0962195196")?('active'):('')) ?>"> All
                <span style="color: red; font-weight: bold;">[<?= @$v_row_count_tab->count_all+0 ?>]</span>
            </a>
        </div>
        <div class="caption font-dark" style="margin-right: 2px;">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?ft_id=0" class="btn btn-default <?= (($_SESSION['fix_type_status']=="0")?('active'):('')) ?>"> Pending
                <span style="color: red; font-weight: bold;">[<?= @$v_row_count_tab->count_pending+0 ?>]</span>
            </a>
        </div>
        <div class="caption font-dark" style="margin-right: 2px;">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?ft_id=1" class="btn btn-default <?= (($_SESSION['fix_type_status']=="1")?('active'):('')) ?>"> Doing
                <span style="color: red; font-weight: bold;">[<?= @$v_row_count_tab->count_doing+0 ?>]</span>
            </a>
        </div>
        <div class="caption font-dark" style="margin-right: 2px;">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?ft_id=2" class="btn btn-default <?= (($_SESSION['fix_type_status']=="2")?('active'):('')) ?>"> Finished
                <span style="color: red; font-weight: bold;">[<?= @$v_row_count_tab->count_finish+0 ?>]</span>
            </a>
        </div>
        <div class="caption font-dark" style="margin-right: 2px;">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?ft_id=3" class="btn btn-default <?= (($_SESSION['fix_type_status']=="3")?('active'):('')) ?>"> Cashed
                <span style="color: red; font-weight: bold;">[<?= @$v_row_count_tab->count_cashed+0 ?>]</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Invoice No</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">Price & Cost</th>
                        <th class="text-center">Problem & Fix</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php
                        $i = 0;
                        while ($row = mysqli_fetch_object($get_data)) {
                            $v_today = date('Y-m-d');
                            $date1=date_create($v_today);
                            $date2=date_create($row->t_date_finished);
                            $diff=date_diff($date1,$date2);
                            $age_date = ' <span style="color:red;">'.$diff->format("%R%a days").'</span>';
                            if($diff->format("%R%a") <= 2 AND $row->t_date_finished!='0000-00-00'){
                                echo '<tr class="alert">';
                            }else{
                                echo '<tr>';
                            }
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.sprintf('%08d',$row->t_id).'</td>';
                                echo '<td class="text-left">';
                                    ?>
                                    <table width="100%" style="color: #000;" class="tbl_pd0 table-hover">
                                        <tr>
                                            <td>checkin:</td>
                                            <td class="text-right"><?php echo $row->t_date_received ?></td>
                                        </tr>
                                        <tr>
                                            <td>alert inform:</td>
                                            <td class="text-right"><?php echo $row->t_alert_inform_date ?></td>
                                        </tr>
                                        <tr>
                                            <td>set finish:</td>
                                            <td class="text-right"><?php echo $row->t_date_finished ?></td>
                                        </tr>
                                        <tr>
                                            <td>age date:</td>
                                            <td class="text-right"><?php echo (($row->t_date_finished!='0000-00-00')?(@$age_date):('')) ?></td>
                                        </tr>
                                        <tr>
                                            <td>cashed:</td>
                                            <td class="text-right"><?php echo $row->t_date_cashed ?></td>
                                        </tr>
                                        
                                    </table>
                                    <!-- echo 'checkin : '.$row->t_date_received.'<br>';
                                    echo 'alert inform : '.$row->t_alert_inform_date.'<br>';
                                    echo 'set finish : '.$row->t_date_finished.'<br>';
                                    echo 'age date : '.$row->t_date_received.'<br>';
                                    echo 'cashed : '.$row->t_date_cashed.'<br>'; -->
                                    <?php
                                echo '</td>';
                                echo '<td class="text-left">';
                                    ?>
                                    <table width="100%" style="color: #000;" class="tbl_pd0 table-hover">
                                        <tr>
                                            <td>customer:</td>
                                            <td class="text-right"><?php echo $row->t_customer_phone_number ?></td>
                                        </tr>
                                        <tr>
                                            <td>model:</td>
                                            <td class="text-right"><?php echo $row->name_en ?></td>
                                        </tr>
                                        <tr>
                                            <td>status:</td>
                                            <td class="text-right"><?php echo $row->mt_name ?></td>
                                        </tr>
                                        <tr>
                                            <td>status:</td>
                                            <td class="text-right"><?php echo $row->mt_name ?></td>
                                        </tr>
                                        <tr>
                                            <td>board number:</td>
                                            <td class="text-right"><?php echo $row->t_product_board_number ?></td>
                                        </tr>
                                        
                                    </table>
                                    <?php
                                echo '</td>';
                                echo '<td class="text-left">';
                                    ?>
                                    <table width="100%" style="color: #000;" class="tbl_pd0 table-hover">
                                        <tr>
                                            <td>price:</td>
                                            <th class="text-right"><?php echo number_format($row->t_fix_price,2) ?></th>
                                        </tr>
                                        <tr>
                                            <td>component:</td>
                                            <td class="text-right"><a class="btn btn-xs blue" onclick="set_iframe('<?php echo $row->t_id ?>')" data-toggle="modal" href="#todo"><small><i class="fa fa-cubes"></i></small></a></td>
                                        </tr>
                                        <tr>
                                            <td>cost:</td>
                                            <td class="text-right"><?php echo number_format($row->sum_cost,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>profit:</td>
                                            <td class="text-right"><?php echo number_format(($row->t_fix_price-$row->sum_cost),2) ?></td>
                                        </tr>                                        
                                    </table>
                                    <?php
                                echo '</td>';
                                echo '<td class="text-left">';
                                    ?>
                                    <table width="100%" style="color: #000;" class="tbl_pd0 table-hover">
                                        <tr>
                                            <td>problem:</td>
                                            <td class="text-right"><?php echo $row->t_issue_description ?></td>
                                        </tr>
                                        <tr>
                                            <td>employee:</td>
                                            <td class="text-right"><?php echo $row->name_english ?></td>
                                        </tr>
                                        <tr>
                                            <td>status:</td>
                                            <td class="text-right"><?php echo $row->ft_name ?></td>
                                        </tr>
                                        <tr>
                                            <td>note:</td>
                                            <td class="text-right"><?php echo $row->t_note ?></td>
                                        </tr>                                        
                                    </table>
                                    <?php
                                echo '</td>';
                                echo '<td class="text-right">';
                                    echo '<a target="_blank" href="print_preview.php?id='.$row->t_id.'&action_back=close.php" class="btn btn-xs blue btn_print">Print</a>';
                                    echo select_dropdown_change_status($row->t_fix_status,$row->t_id);
                                    if($row->t_fix_status==3){
                                        echo '<a class="btn btn-xs btn-warning disabled" title="edit"><i class="fa fa-edit"></i></a>';
                                    }else{
                                        echo '<a href="edit.php?edit_id='.$row->t_id.'" class="btn btn-xs btn-warning btn-edit" title="edit"><i class="fa fa-edit"></i></a>';
                                    }
                                    if(@$_SESSION['user']->position_id == 1){
                                        echo '<a href="delete.php?del_id='.$row->t_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>';
                                    }
                                echo'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<?php 
    function select_dropdown_change_status($s_id,$t_id){
        if($s_id==3)
            return '<select style="font-size: 9.5px; background: #ddd;" readonly="readonly" class="disabled">
                <option '.(($s_id==3)?('selected'):('')).' value="3">Cashed</option>
            </select> ';
        else
            return '<select style="font-size: 11px;" onchange="change_transaction_status(this.value,'.$t_id.',this)">
                <option '.(($s_id==0)?('selected="selected"'):('')).' value="0">Pending</option>
                <option '.(($s_id==1)?('selected="selected"'):('')).' value="1">Doing</option>
                <option '.(($s_id==2)?('selected="selected"'):('')).' value="2">Finished</option>
                <option '.(($s_id==3)?('selected="selected"'):('')).' value="3">Cashed</option>
            </select> ';
    }
 ?>
<script type="text/javascript">
    function change_transaction_status(status_id,tran_id,e_select){
        if(status_id==3){
            if(!confirm('Are you sure to cash?')){
                $('select option').prop('selected', function() {
                    return this.defaultSelected;
                });
                return false;
            }
        }
        $.post("ajx_change_status.php",
        { 
            txt_status_id: status_id,
            txt_tran_id: tran_id
        },
        function(data, status){
          if(data!="" && status=="success"){
            if(status_id==3){
                $(e_select).parents('td').find('.btn-edit').addClass('disabled');
                $(e_select).find('option').hide();
                go_to_print(tran_id);
            }else{
                alert('success');
            }
          }
        });
    }
    function go_to_print(id){
        window.open('print_preview.php?id='+id+'&action_back=close.php', '_blank');
    }
</script>
<?php include_once '../layout/footer.php' ?>
<div class="modal fade" id="todo">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-body">
                <iframe id="result" src="" width="100%" style="min-height: 600px; resize: vertical;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function set_iframe(e){
        document.getElementById('result').src = '../transaction_component/index.php?parent_id='+e;
    }
</script>