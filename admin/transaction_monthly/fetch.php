<?php
    include_once '../../config/database.php';
    include_once '../../config/ssp.class.php';
    include_once '../../language/index.php';
    $table = 'view_transaction';
    $primaryKey = 't_id';
    $columns = array(
        array( 'db' => 't_id', 'dt' => 0 ),
        array( 'db' => 't_id', 'dt' => 1, 'formatter' => function( $d, $row ) { return sprintf('%08d',$d); }),
        array( 'db' => 't_date_received',  'dt' => 2, 'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;">'.$d.'</p>'; }),
        array( 'db' => 't_customer_phone_number',   'dt' => 3 ),
        array( 'db' => 'name_en',     'dt' => 4, 'formatter' => function( $d, $row ) { return '<em">'.$d.'</em>'; }),
        array( 'db' => 'mt_name',     'dt' => 5 ),
        array( 'db' => 't_product_board_number',     'dt' => 6 ),
        array( 'db' => 't_issue_description',     'dt' => 7 ),
        array( 'db' => 't_fix_price',     'dt' => 8,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'sum_discount',     'dt' => 9,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'total',     'dt' => 10,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'sum_cost',     'dt' => 11,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 'profit',     'dt' => 12,'formatter' => function( $d, $row ) { return '<p class="text-center" style="margin: 0px!important;"><strong>'.number_format($d,2).'</strong></p>'; }),
        array( 'db' => 't_alert_inform_date',     'dt' => 13, 'formatter' => function($d,$row){ return '<p class="text-center" style="margin: 0px!important;">'.$d.'</p>'; } ),
        array( 'db' => 't_date_finished',     'dt' => 14, 'formatter' => function($d,$row){ return '<p class="text-center" style="margin: 0px!important;">'.$d.'</p>'; } ),
        array( 'db' => 't_date_finished',     'dt' => 15, 'formatter' => function( $d, $row ) { 
            $v_today = date('Y-m-d');
            $date1=date_create($v_today);
            $date2=date_create($d);
            $diff=date_diff($date1,$date2);
            $age_date = ' <span style="color:red;">'.$diff->format("%R%a days").'</span>';
            return '<p class="text-center" style="margin: 0px!important;">'.(($d!='0000-00-00')?@$age_date:'').'</p>';; 
        }),
        array( 'db' => 'name_english',     'dt' => 16 ),
        array( 'db' => 't_note',     'dt' => 17 ),
        array( 'db' => 'ft_name',     'dt' => 18 ),
        array( 'db' => 't_date_cashed',     'dt' => 19, 'formatter' => function($d,$row){ return '<p class="text-center" style="margin: 0px!important;">'.$d.'</p>'; } ),
        array( 'db' => 't_id',     'dt' => 20 , 'formatter' => function( $d, $row ) {
            return '<p class="text-center" style="margin: 0px!important;"><a class="btn btn-xs blue" onclick="set_iframe('.$d.')" data-toggle="modal" href="#todo"><i class="fa fa-cubes"></i></a></p>';
        }),
        array( 'db' => 't_fix_status', 'dt' => 21, 'formatter' => function( $d, $row ) {
            $button = '<a target="_blank" href="print_preview.php?id='.$row[0].'&action_back=close.php" class="btn btn-xs blue btn_print">Print</a>';
            $button .= select_dropdown_change_status($d,$row[0]);
            if($d==3){
                $button.= '<a class="btn btn-xs btn-warning disabled" title="edit"><i class="fa fa-edit"></i></a>';
            }else{
                $button.= '<a href="edit.php?edit_id='.$row[0].'" class="btn btn-xs btn-warning btn-edit" title="edit"><i class="fa fa-edit"></i></a>';
            }
            if(@$_SESSION['user']->position_id == 1){
                $button.= '<a href="delete.php?del_id='.$row[0].'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>';
            }
            return '<p class="text-center" style="margin: 0px!important;">'.$button.'</p>';
        }),
    );
    $sql_details = array(
        'user' => $username,
        'pass' => $password,
        'db'   => $database,
        'host' => $servername
    );

    function select_dropdown_change_status($s_id,$t_id){
        GLOBAL $lang_text; GLOBAL $lang;
        if($s_id==3)
            return '<select style="font-size: 9.5px; background: #ddd;" readonly="readonly" class="disabled">
                <option '.(($s_id==3)?('selected'):('')).' value="3">'.$lang_text['cashed'][$lang].'</option>
            </select> ';
        else
            return '<select style="font-size: 11px;" onchange="change_transaction_status(this.value,'.$t_id.',this)">
                <option '.(($s_id==0)?('selected="selected"'):('')).' value="0">'.$lang_text['pending'][$lang].'</option>
                <option '.(($s_id==1)?('selected="selected"'):('')).' value="1">'.$lang_text['doing'][$lang].'</option>
                <option '.(($s_id==2)?('selected="selected"'):('')).' value="2">'.$lang_text['finished'][$lang].'</option>
                <option '.(($s_id==3)?('selected="selected"'):('')).' value="3">'.$lang_text['cashed'][$lang].'</option>
                <option '.(($s_id==4)?('selected="selected"'):('')).' value="4">'.$lang_text['notDone'][$lang].'</option>
            </select> ';
    }

    // custom search
    $where=' ';
    $v_current_month=date('Y-m');
    if($_SESSION['fix_type_status']=="0962195196"){
        $where = " AND (DATE_FORMAT(t_date_cashed,'%Y-%m')='".$v_current_month."' OR t_fix_status<3 OR t_fix_status=4) ";
    }else if($_SESSION['fix_type_status']=="3"){
        $where = " AND (DATE_FORMAT(t_date_cashed,'%Y-%m')='".$v_current_month."') AND t_fix_status='".$_SESSION['fix_type_status']."' ";
    }else{
        $where = " AND t_fix_status='".$_SESSION['fix_type_status']."' ";
    }
    // end custom serach

    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
    );
?>
