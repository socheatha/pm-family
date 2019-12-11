<?php
    include_once '../../config/database.php';
    include_once '../../config/ssp.class.php'; 
    $table = 'view_transaction';
    $primaryKey = 't_id';
    $columns = array(
        array( 'db' => 't_id', 'dt' => 0 ),
        array( 'db' => 't_id', 'dt' => 1, 'formatter' => function( $d, $row ) { return sprintf('%08d',$d); }),
        array( 'db' => 't_date_cashed',  'dt' => 2, 'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.$d.'</strong></p>'; }),
        array( 'db' => 't_date_received',   'dt' => 3 ),
        array( 'db' => 't_customer_phone_number',     'dt' => 4 ),
        array( 'db' => 'name_en',     'dt' => 5 ),
        array( 'db' => 'mt_name',     'dt' => 6 ),
        array( 'db' => 't_product_board_number',     'dt' => 7 ),
        array( 'db' => 't_issue_description',     'dt' => 8 ),
        array( 'db' => 't_fix_price',     'dt' => 9,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'sum_discount',     'dt' => 10,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'total',     'dt' => 11,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'sum_cost',     'dt' => 12,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'profit',     'dt' => 13,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 't_alert_inform_date',     'dt' => 14 ),
        array( 'db' => 't_date_finished',     'dt' => 15 ),
        array( 'db' => 'name_english',     'dt' => 16 ),
        array( 'db' => 't_note',     'dt' => 17 ),
        array( 'db' => 'ft_name',     'dt' => 18 ),
    );
    $sql_details = array(
        'user' => $username,
        'pass' => $password,
        'db'   => $database,
        'host' => $servername
    );

    // custom search
    $where=' ';
    if(@$_SESSION['history_from'] && $_SESSION['history_to']){
        $where.=" AND t_date_cashed BETWEEN '".$_SESSION['history_from']."' AND '".$_SESSION['history_to']."' ";
    }
    if(@$_SESSION['history_employee']){
        $where.=" AND t_fix_by_employee = '".$_SESSION['history_employee']."' ";
    }
    if(@$_SESSION['history_status'] && @$_SESSION['history_status']!='0962195196'){
        $where.=" AND t_fix_status = ".$_SESSION['history_status']." ";
    }
    // end custom serach

    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
    );
?>
