<?php 
    $menu_active =6;
    $left_menu =56;
    $layout_title = "";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
?>

<?php include_once '../layout/header.php'; ?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-fw fa-map-marker"></i> <?= $lang_text['reportProfitByYear'][$lang] ?></h2>
        </div>
    </div>    
    <br>
    <br>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="col-sm-2">
                <div class="input-group">
                    <input autocomplete="off" name="txt_date_start" value="<?= @$_GET['txt_date_start'] ?>" REQUIRED type="text" class="form-control" placeholder="year from">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <input autocomplete="off" name="txt_date_end" value="<?= @$_GET['txt_date_end'] ?>" REQUIRED type="text" class="form-control" placeholder="year to">
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
                        <th><?= $lang_text['year'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['incomeUsd'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['incomeRiel'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['expenseUsd'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['expenseRiel'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['btn_search'])){
                            $v_date_s = @$_GET['txt_date_start'];
                            $v_date_e = @$_GET['txt_date_end'];
                        }else{
                            $v_date_s = date('Y');
                            $v_date_e = date('Y');
                        }

                        $date = $v_date_s;
                        $i=0;
                        $sum_income_usd = 0;
                        $sum_income_khr = 0;
                        $sum_expense_usd = 0;
                        $sum_expense_khr = 0;
                        while ($date<=$v_date_e){
                            $get_income = $connect->query("SELECT SUM(ai_amount_dollar) as sum_income_usd,SUM(ai_amount_riel) as sum_incime_khr FROM tbl_account_income WHERE DATE_FORMAT(ai_date,'%Y')='$date'");
                            $row_income = mysqli_fetch_object($get_income);
                            $get_expense = $connect->query("SELECT SUM(ae_amount_dollar) as sum_expense_usd,SUM(ae_amount_riel) as sum_expense_khr FROM tbl_account_expense WHERE DATE_FORMAT(ae_date,'%Y')='$date'");
                            $row_expense = mysqli_fetch_object($get_expense);

                            $sum_income_usd += $row_income->sum_income_usd;
                            $sum_income_khr += $row_income->sum_incime_khr;
                            $sum_expense_usd += $row_expense->sum_expense_usd;
                            $sum_expense_khr += $row_expense->sum_expense_khr;

                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$date.'</td>';
                                echo '<th class="text-center bg-success">$ '.number_format(@$row_income->sum_income_usd,2).'</th>';
                                echo '<th class="text-center bg-success">'.number_format(@$row_income->sum_incime_khr,0).' ៛</th>';
                                echo '<th class="text-center bg-danger">$ '.number_format(@$row_expense->sum_expense_usd,2).'</th>';
                                echo '<th class="text-center bg-danger">'.number_format(@$row_expense->sum_expense_khr,0).' ៛</th>';
                            echo '</tr>';
                            $date++;
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">$ <?= number_format(@$sum_income_usd,2) ?></td>
                        <td class="text-center"><?= number_format(@$sum_income_khr,0) ?> ៛</td>
                        <td class="text-center">$ <?= number_format(@$sum_expense_usd,2) ?></td>
                        <td class="text-center"><?= number_format(@$sum_expense_khr,0) ?> ៛</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>
