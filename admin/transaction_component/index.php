<?php 
    $menu_active =9998;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header_frame.php';
?> 
<style type="text/css" media="screen">
    .dt-buttons{ display: none; }    
</style>
<div class="row">
    <div class="col-xs-12">
        <h3><a href="add.php?parent_id=<?= @$_GET['parent_id'] ?>" id="sample_editable_1_new" class="btn green"> <?= $lang_text['addNew'][$lang] ?>
                <i class="fa fa-plus"></i>
            </a> <strong><?= $lang_text['component'][$lang] ?></strong></h3>
    </div>
</div>
<table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
    <thead>
        <tr>
            <th>N&deg;</th>
            <th><?= $lang_text['date'][$lang] ?></th>
            <th><?= $lang_text['code'][$lang] ?></th>
            <th><?= $lang_text['referenceName'][$lang] ?></th>
            <th><?= $lang_text['productName'][$lang] ?></th>
            <th><?= $lang_text['category'][$lang] ?></th>
            <th class="text-center"><?= $lang_text['qty'][$lang] ?></th>
            <th class="text-center"><?= $lang_text['cost'][$lang] ?></th>
            <th class="text-center"><?= $lang_text['amount'][$lang] ?></th>
            <th class="text-center"><?= $lang_text['action'][$lang] ?></th>
        </tr>
    </thead>
    <tbody>                                 
        <?php 
            $i = 0;
            $get_data = $connect->query("SELECT * FROM tbl_pos_stockout A 
                  LEFT JOIN tbl_pos_product B ON A.pro_id=B.pro_id
                  LEFT JOIN tbl_pos_category C ON B.cate_id=C.cate_id
                    WHERE A.invoice='".@$_GET['parent_id']."'
                    ORDER BY A.date_out DESC");
            $v_amount = 0;
            while ($row = mysqli_fetch_object($get_data)) {
                $v_amount += $row->qty_out*$row->so_cost;
                echo '<tr>';
                    echo '<td>'.(++$i).'</td>';
                    echo '<td>'.$row->date_out.'</td>';
                    echo '<td>'.$row->code.'</td>';
                    echo '<td>'.$row->ref.'</td>';
                    echo '<td>'.$row->name_en.'</td>';
                    echo '<td>'.$row->category_name.'</td>';
                    echo '<th class="text-center">'.$row->qty_out.'</th>';
                    echo '<th class="text-center">'.$row->so_cost.'</th>';
                    echo '<th class="text-center">'.$row->qty_out*$row->so_cost.'</th>';
                    echo '<td class="text-center"><a href="edit.php?edit_id='.$row->transaction_id.'&parent_id='.@$_GET['parent_id'].'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                        <a href="delete.php?del_id='.$row->transaction_id.'&parent_id='.@$_GET['parent_id'].'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                        </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center"><?= $v_amount ?></td>
        <td></td>
    </tfoot>
</table>
<?php include_once '../layout/footer_frame.php' ?>