<?php 
    $menu_active =6;
    $left_menu =50;
    $layout_title = "";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
?>

<?php include_once '../layout/header.php'; ?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-fw fa-map-marker"></i> <?= $lang_text['expenseAdministrator'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> <?= $lang_text['addNew'][$lang] ?>
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="tools"> </div>
    </div>
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
                        <th>User Audit</th>
                        <th>Date Audit</th>
                        <th style="min-width: 100px;" class="text-center"><?= $lang_text['action'][$lang] ?> <i class="fa fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $v_current_year_month = date('Y-m');
                        $i = 0;
                        $get_data = $connect->query("SELECT 
                               *
                            FROM  tbl_account_expense AS A 
                            LEFT JOIN tbl_account_category AS C ON C.ac_id=A.ae_category
                            LEFT JOIN tbl_pos_user AS U ON U.id=A.ae_created_by
                            WHERE DATE_FORMAT(A.ae_date,'%Y-%m') ='$v_current_year_month'
                            ORDER BY ae_date DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->ae_date.'</td>';
                                echo '<td>'.$row->ac_name.'</td>';
                                echo '<td>'.$row->ae_title.'</td>';
                                echo '<th class="text-center bg-danger">$ '.number_format($row->ae_amount_dollar,2).'</th>';
                                echo '<th class="text-center bg-danger">'.number_format($row->ae_amount_riel,0).' ៛</th>';
                                echo '<td>'.$row->ae_note.'</td>';
                                echo '<td>'.$row->username.'</td>';
                                echo '<td>'.$row->ae_created_at.'</td>';
                                echo '<td class="text-center">';
                                    echo '<a href="edit.php?edit_id='.$row->ae_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a> ';
                                    echo '<a href="delete.php?del_id='.$row->ae_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a> ';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once '../layout/footer.php' ?>
