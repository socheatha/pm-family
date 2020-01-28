<?php 
    $menu_active =0;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 

if(isset($_POST["btn_change"])){
    $old_banner = $_POST['old_banner'];
    $v_title_en = $_POST['txt_title_en'];
    $v_title_kh = $_POST['txt_title_kh'];
    $v_description_en = $_POST['txt_description_en'];
    $v_description_kh = $_POST['txt_description_kh'];
    $v_popup_status = isset($_POST['txt_popup_status'])?'1':'0';

    if(!empty($_FILES['banner']['size'])){
        $banner = date('Y_m_d')."_".rand(1111,9999).".png";
        move_uploaded_file($_FILES['banner']['tmp_name'],"../../img/home_page/$banner");
        if(file_exists("../../img/home_page/".$old_banner)){
            unlink("../../img/home_page/".$old_banner);
        }
    }else { $banner = $old_banner; }

    $sql = "UPDATE tbl_website_config SET 
        hp_title_en = '$v_title_en',  
        hp_title_kh = '$v_title_kh',
        hp_description_en = '$v_description_en',
        hp_description_kh = '$v_description_kh',
        hp_image = '$banner',
        hp_popup_status = '$v_popup_status'
    ";
    $result = mysqli_query($connect, $sql);
    if ($result) { 
        echo '<script> window.location.replace("index.php");</script>'; 
    }else{
        echo mysqli_error($connect);
    }
}
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> Welcome Message</h2>
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
                        <th class="text-center">Image</th>
                        <th class="text-center">Popup<br>Status</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Description</th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $get_data = $connect->query("SELECT * FROM tbl_website_config");
                        $row = mysqli_fetch_object($get_data);
                        echo '<tr>';
                            echo '<td class="text-center"><img width="100px" src="../../img/home_page/'.$row->hp_image.'"/></td>';
                            echo '<td class="text-center">
                                <input type="checkbox" readonly '.($row->hp_popup_status?'checked':'').' />
                            </td>';
                            echo '<td>
                            <img src="../../img/flag/en.png"/>:'.$row->hp_title_en. '<br>
                            <img src="../../img/flag/kh.png"/>:'. $row->hp_title_kh.'
                            </td>';
                            echo '<td>
                                <img src="../../img/flag/en.png"/>:'.$row->hp_description_en. '<br>
                                <img src="../../img/flag/kh.png"/>:'.$row->hp_description_kh.'
                            </td>';
                        echo '</tr>';
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php' ?>
<div class="modal fade" id="modal_change">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please input data becarefully</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="form_change" enctype="multipart/form-data">
                    <input type="hidden" name = "old_banner" value="<?= $row->hp_image ?>" class="form-control">
                    <div class="form-group">
                        <label for="">Image:</label><br>
                        <img width="100%" class="img-thumbnail" src="../../img/home_page/<?= $row->hp_image ?>"/>
                        <input type="file" name = "banner" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_popup_status">Popup Status:</label>
                        <input id="txt_popup_status" name="txt_popup_status" type="checkbox" <?= $row->hp_popup_status?'checked':'' ?> />
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_en" required="" autocomplete="off" value="<?= $row->hp_title_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title: Kh</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_kh" required="" autocomplete="off" value="<?= $row->hp_title_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Description En:</label>
                                <textarea class="form-control" placeholder="" name="txt_description_en" required="" autocomplete="off" rows="4"><?= $row->hp_description_en ?></textarea>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Description Kh:</label>
                                <textarea class="form-control" placeholder="" name="txt_description_kh" required="" autocomplete="off" rows="4"><?= $row->hp_description_kh ?></textarea>
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