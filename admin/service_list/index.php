<?php 
    $menu_active =188;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-image fa-fw"></i> Service List Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a>
            <a  data-toggle="modal" href='#edit_modal' id="btn_milti_edit" class="btn btn-warning btn_multi_delete" form="multi_copy_frm"> Edit
                <i class="fa fa-edit"></i>
            </a>
        </div>
        <div class="tools"></div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Name</th>
                        <th>Fix Duration</th>
                        <th class="text-center">Price</th>
                        <th>Note</th>
                        <th>User Audit</th>
                        <th>Date Audit</th>
                        <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;
                        $get_data = $connect->query("SELECT * FROM tbl_pos_service AS A 
                            LEFT JOIN tbl_pos_user AS U ON U.id=A.s_user_id
                        ORDER BY s_id DESC");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->s_name.'</td>';
                                echo '<td>'.$row->s_duration.'</td>';
                                echo '<th class="text-center">'.$row->s_price.'</th>';
                                echo '<td>'.$row->s_note.'</td>';
                                echo '<td><em>'.$row->username.'</em></td>';
                                echo '<td>'.$row->s_created_at.'</td>';
                                echo '<td class="text-center"><a href="edit.php?edit_id='.$row->s_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?del_id='.$row->s_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                    </td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../assets/global/plugins/jquery.min.js"></script>
<script type="text/javascript">
    $("#btn_check_all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#btn_milti_edit').hide();
    $('input[name="chk_multi_copy[]"],#btn_check_all').change(function(){
        $('#btn_milti_edit').hide();
        $('input[name="chk_multi_copy[]"]').each(function(e){
            if($('input[name="chk_multi_copy[]"]').eq(e).is(':checked')){
                $('#btn_milti_edit').show();
            }
        });
    });
</script>
<?php include_once '../layout/footer.php' ?>
<div class="modal fade" id="edit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal: Edit Multiple Cost And Price</h4>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="multi_copy_frm">
                    <div class="row">
                        <div class="col-xs-6">
                            <label for="">Product Price</label>
                            <input type="number" step="any" class="form-control" required="" name="txt_price" required="" value="0">
                        </div>
                        <div class="col-xs-6">
                            <label for="">Product Cost</label>
                            <input type="number" step="any" class="form-control" required="" name="txt_cost" required="" value="0">
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="btn_submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn red"><i class="fa fa-undo"></i> Close</a>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>