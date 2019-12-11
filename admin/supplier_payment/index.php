<?php 
    $menu_active =4;
    $layout_title = "Welcome Page";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Supplier Payment Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Record</th>
                        <th>Supplier Invoice No</th>
                        <th>Supplier Name</th>
                        <th>Full Amount</th>
                        <th>Pay Amount</th>
                        <th>Balance</th>
                        <th>Note</th>
                        <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_supplier_invoice AS A 
                            LEFT JOIN tbl_pos_vender AS B ON A.supi_supplier_name=B.vender_id
                            ");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->supi_date_record.'</td>';
                                echo '<td>'.$row->supi_supplier_invoice_no.'</td>';
                                echo '<td>'.$row->vendername_en.'::'.$row->vendername_kh.'</td>';
                                echo '<td class="text-center">'.number_format($row->supi_full_amount,2).'</td>';
                                echo '<td class="text-center">'.number_format($row->supi_pay_amount,2).'</td>';
                                echo '<td class="text-center">'.number_format($row->supi_balance,2).'</td>';
                                echo '<td>'.$row->supi_note.'</td>';
                                echo '<td class="text-center"><a href="edit.php?edit_id='.$row->supi_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->supi_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                    </td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






<?php include_once '../layout/footer.php' ?>
