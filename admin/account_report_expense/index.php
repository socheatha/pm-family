<?php 
    $menu_active =6;
    $left_menu =53;
    $layout_title = "";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
?>

<?php include_once '../layout/header.php'; ?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-fw fa-map-marker"></i> <?= $lang_text['reportExpenseDetail'][$lang] ?></h2>
        </div>
    </div>    
    <br>
    <br>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="col-sm-2">
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input autocomplete="off" name="txt_date_start" value="<?= @$_GET['txt_date_start'] ?>" REQUIRED type="text" class="form-control" placeholder="date from">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input autocomplete="off" name="txt_date_end" value="<?= @$_GET['txt_date_end'] ?>" REQUIRED type="text" class="form-control" placeholder="date to">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>        
            <div class="col-sm-6">
                <div class="caption font-dark" style="display: inline-block;">
                    <button type="submit" name="btn_search" id="sample_editable_1_new" class="btn blue"> <?= $lang_text['search'][$lang] ?>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <button type="submit" name="btn_search" formtarget="new" formrequired="0" formaction="print.php" id="btn_hidden_print" class="btn blue" style="display: none;">Print</button>
                <div class="caption font-dark" style="display: inline-block;">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" id="sample_editable_1_new" class="btn red"> <?= $lang_text['clear'][$lang] ?>
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>
    <br>
    <div class="portlet-body">
        <div id="sample_2_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline " id="sample_2" role="grid" aria-describedby="sample_2_info">
                <thead>
                    <tr role="row" class="text-center">
                        <th>N&deg;</th>
                        <th style="min-width: 70px;"><?= $lang_text['date'][$lang] ?></th>
                        <th><?= $lang_text['category'][$lang] ?></th>
                        <th><?= $lang_text['title'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['amountUsd'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['amountRiel'][$lang] ?></th>
                        <th><?= $lang_text['note'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['btn_search'])){
                            $v_date_s = @$_GET['txt_date_start'];
                            $v_date_e = @$_GET['txt_date_end'];
                            $get_data = $connect->query("SELECT 
                                   *
                                FROM  tbl_account_expense AS A 
                                LEFT JOIN tbl_account_category AS C ON C.ac_id=A.ae_category
                                WHERE DATE_FORMAT(A.ae_date,'%Y-%m-%d') BETWEEN '$v_date_s' AND '$v_date_e'
                                ORDER BY ae_date DESC");
                        }else{
                            $v_current_year_month = date('Y-m');
                            $get_data = $connect->query("SELECT 
                                   *
                                FROM  tbl_account_expense AS A 
                                LEFT JOIN tbl_account_category AS C ON C.ac_id=A.ae_category
                                WHERE DATE_FORMAT(A.ae_date,'%Y-%m') ='$v_current_year_month'
                                ORDER BY ae_date DESC");
                        }
                        $sum_amount_usd =0;
                        $sum_amount_khr =0;
                        $i = 0;
                        while ($row = mysqli_fetch_object($get_data)) {
                            $sum_amount_usd += $row->ae_amount_dollar;
                            $sum_amount_khr += $row->ae_amount_riel;
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->ae_date.'</td>';
                                echo '<td>'.$row->ac_name.'</td>';
                                echo '<td>'.$row->ae_title.'</td>';
                                echo '<th class="text-center bg-danger">$ '.number_format($row->ae_amount_dollar,2).'</th>';
                                echo '<th class="text-center bg-danger">'.number_format($row->ae_amount_riel,0).' ៛</th>';
                                echo '<td>'.$row->ae_note.'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">$ <?= number_format($sum_amount_usd,2) ?></td>
                        <td class="text-center"><?= number_format($sum_amount_khr,0) ?> ៛</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>
