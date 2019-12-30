<?php 
    $menu_active =10;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 

if(isset($_POST["btn_change"])){
    $old_image = $_POST['old_image'];
    $old_banner = $_POST['old_banner'];
    $v_title_en = $_POST['txt_title_en'];
    $v_title_kh = $_POST['txt_title_kh'];
    $v_keywords = $_POST['txt_keywords'];
    $v_description_en = $_POST['txt_description_en'];
    $v_description_kh = $_POST['txt_description_kh'];

    if(!empty($_FILES['image']['size'])){
        $image = date('Y_m_d')."_".rand(1111,9999).".png";
        move_uploaded_file($_FILES['image']['tmp_name'],"../../img/logo/$image");
        if(file_exists("../../img/logo/".$old_image)){
            unlink("../../img/logo/".$old_image);
        }
    }else { $image = $old_image; }
    if(!empty($_FILES['banner']['size'])){
        $banner = date('Y_m_d')."_".rand(1111,9999).".png";
        move_uploaded_file($_FILES['banner']['tmp_name'],"../../img/logo/$banner");
        if(file_exists("../../img/logo/".$old_banner)){
            unlink("../../img/logo/".$old_banner);
        }
    }else { $banner = $old_banner; }

    $sql = "UPDATE tbl_website_config SET 
        title_en = '$v_title_en',  
        title_kh = '$v_title_kh',
        keywords = '$v_keywords',
        description_en = '$v_description_en',
        description_kh = '$v_description_kh',
        logo = '$image',
        `banner` = '$banner'
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
            <h2><i class="fa fa-cubes fa-fw"></i> Logo and Title Administrator</h2>
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
                        <th class="text-center">Banner</th>
                        <th class="text-center">Title En</th>
                        <th class="text-center">Title Kh</th>
                        <th class="text-center">Keywords</th>
                        <th class="text-center">Description En</th>
                        <th class="text-center">Description Kh</th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $get_data = $connect->query("SELECT * FROM tbl_website_config");
                        $row = mysqli_fetch_object($get_data);
                        echo '<tr>';
                            echo '<td class="text-center"><img width="100px" src="../../img/logo/'.$row->logo.'"/></td>';
                            echo '<td class="text-center"><img width="100px" src="../../img/logo/'.$row->banner.'"/></td>';
                            echo '<td>'.$row->title_en.'</td>';
                            echo '<td>'.$row->title_kh.'</td>';
                            echo '<td>'.$row->keywords.'</td>';
                            echo '<td>'.$row->description_en.'</td>';
                            echo '<td>'.$row->description_kh.'</td>';
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
                    <input type="hidden" name = "old_image" value="<?= $row->logo ?>" class="form-control">
                    <input type="hidden" name = "old_banner" value="<?= $row->banner ?>" class="form-control">
                    <div class="form-group">
                        <label for="">Logo:</label><br>
                        <img width="100%" class="img-thumbnail" src="../../img/logo/<?= $row->logo ?>"/>
                        <input type="file" name = "image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Banner:</label><br>
                        <img width="100%" class="img-thumbnail" src="../../img/logo/<?= $row->banner ?>"/>
                        <input type="file" name = "banner" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_en" required="" autocomplete="off" value="<?= $row->title_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title: Kh</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_kh" required="" autocomplete="off" value="<?= $row->title_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Keywords:</label>
                        <textarea class="form-control" placeholder="" name="txt_keywords" required="" autocomplete="off" rows="4"><?= $row->keywords ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Description En:</label>
                                <textarea class="form-control" placeholder="" name="txt_description_en" required="" autocomplete="off" rows="4"><?= $row->description_en ?></textarea>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Description Kh:</label>
                                <textarea class="form-control" placeholder="" name="txt_description_kh" required="" autocomplete="off" rows="4"><?= $row->description_kh ?></textarea>
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