<?php 
    $menu_active =10;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 

if(isset($_POST["btn_change"])){
    $name = $_POST['txt_name'];
    $note = $_POST['txt_note'];
    $old_image = $_POST['old_image'];

    if(!empty($_FILES['image']['size'])){
    $image = date('Y_m_d')."_".rand(1111,9999).".png";
    move_uploaded_file($_FILES['image']['tmp_name'],"../../img/img_invoice/$image");
        $sql = "UPDATE tbl_pos_con_invoice SET shop_name = '$name', shop_note = '$note', logo = '$image'";
        $result = mysqli_query($connect, $sql);
        if ($result) { 
            if(file_exists("../../img/img_invoice/".$old_image)){
                unlink("../../img/img_invoice/".$old_image);
            }
            echo '<script> window.location.replace("index.php");</script>'; 
        }else{ echo "Error"; }
    }else {
        $sql = "UPDATE tbl_pos_con_invoice SET shop_name = '$name' ,  shop_note = '$note'";
        $result = mysqli_query($connect, $sql);
        if ($result) { 
            echo '<script> window.location.replace("index.php");</script>'; 
        }
    }
}
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> <?= $lang_text['settingInvoice'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a  data-toggle="modal" href='#modal_change' class="btn green"> <?= $lang_text['change'][$lang] ?>
                <i class="fa fa-pencil"></i>
            </a>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr role="row">
                        <th class="text-center"><?= $lang_text['logo'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['title'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['note'][$lang] ?></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $get_data = $connect->query("SELECT * FROM tbl_pos_con_invoice");
                        $row = mysqli_fetch_object($get_data);
                        echo '<tr>';
                            echo '<td><img width="100px" src="../../img/img_invoice/'.$row->logo.'"/></td>';
                            echo '<td>'.$row->shop_name.'</td>';
                            echo '<td>'.$row->shop_note.'</td>';
                        echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php' ?>
<div class="modal fade" id="modal_change">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= $lang_text['settingInvoice'][$lang] ?></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="form_change" enctype="multipart/form-data">
                    <input type="hidden" name = "old_image" value="<?= $row->logo ?>" class="form-control">
                    <div class="form-group">
                        <label for=""><?= $lang_text['logo'][$lang] ?></label>
                        <input type="file" name = "image" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for=""><?= $lang_text['title'][$lang] ?></label>
                                <textarea class="form-control title" id="title" placeholder="" name="txt_name" required="" autocomplete="off"><?= $row->shop_name ?></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for=""><?= $lang_text['note'][$lang] ?></label>
                                <textarea class="form-control note" id="note" placeholder="" name="txt_note" required="" autocomplete="off"><?= $row->shop_note ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="btn_change" form="form_change"> <?= $lang_text['save'][$lang] ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?= $lang_text['close'][$lang] ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'note', {
        language: 'en',
        height: '150'
        // uiColor: '#9AB8F3'
    });    
    CKEDITOR.replace( 'title', {
        language: 'en',
        height: '150'
        // uiColor: '#9AB8F3'
    });
</script>