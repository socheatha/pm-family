<?php 
    $layout_title = "Welcome Dashboard";
    $menu_active =0;
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
    include_once('data_backup.php');
?>
<!-- code  back up db -->
<?php backup_mysqldump($servername,$username,$password,$database,$mysqldump,$isHosted) ?>

<!-- get income daily -->
<?php
    $v_get_exchange_rate = $connect->query("SELECT exchange FROM tbl_pos_exchange");
    $row_exchange = mysqli_fetch_object($v_get_exchange_rate);
    $v_exchange_rate = $row_exchange->exchange;

    $v_date_s = date('Y-m-').'01'; $count_day = date('d')-1;
    $newdate = strtotime ( '+'.$count_day.' day' , strtotime ( $v_date_s ) ) ;
    $newdate = date ( 'Y-m-d' , $newdate );
    $v_date_e = $newdate;
    $date = $v_date_s;
    $end_day_of_month = date('Y')."-".date('m')."-".cal_days_in_month(1, date('m'), date('Y'));

    $label_date = '';
    $amount = '';
    while ($date<=$end_day_of_month){
        $get_income = $connect->query("SELECT SUM(ai_amount_dollar) as sum_income_usd,SUM(ai_amount_riel) as sum_incime_khr FROM tbl_account_income WHERE ai_date='$date'");
        $row_income = mysqli_fetch_object($get_income);
        $get_expense = $connect->query("SELECT SUM(ae_amount_dollar) as sum_expense_usd,SUM(ae_amount_riel) as sum_expense_khr FROM tbl_account_expense WHERE ae_date='$date'");
        $row_expense = mysqli_fetch_object($get_expense);

        $label_date .= date("d", strtotime($date)).',';
        $amount .= (($row_income->sum_income_usd)+($row_income->sum_incime_khr/$v_exchange_rate)).',';
        $date = date ( 'Y-m-d' , strtotime ('+1 day', strtotime($date)));
    }
    $label_date = rtrim($label_date,',');
    $amount = rtrim($amount,',');
?>
<input type="hidden" id="date" value="<?= $label_date ?>">
<input type="hidden" id="income" value="<?= $amount ?>">
<div class="portlet light bordered">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <canvas id="myChart" width="350" height="150" style="overflow: auto;"></canvas>
    <script>
    var $date = document.getElementById('date').value;
    $date = $date.split(",");
    var $amount = document.getElementById('income').value;
    $amount = $amount.split(",");
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: $date,
            datasets: [{
                label: 'Daily Income Graphic Report',
                data: $amount,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
</div>
<?php include_once '../layout/footer.php' ?>
