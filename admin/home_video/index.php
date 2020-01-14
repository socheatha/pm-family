<?php
$menu_active = 0;
$layout_title = "Welcome to System";
include_once '../../config/database.php';
include_once '../../config/athonication.php';
include_once '../layout/header.php';
?>
<?php

if (isset($_POST["btn_change"])) {
    $v_url = $_POST['txt_url'];
    $v_prefix_en = $_POST['txt_prefix_en'];
    $v_prefix_kh = $_POST['txt_prefix_kh'];
    $v_title_en = $_POST['txt_title_en'];
    $v_title_kh = $_POST['txt_title_kh'];

    $sql = "UPDATE tbl_website_config SET 
        vdo_prefix_en = '$v_prefix_en',
        vdo_prefix_kh = '$v_prefix_kh',
        vdo_title_en = '$v_title_en',  
        vdo_title_kh = '$v_title_kh',
        vdo_url = '$v_url'
    ";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        echo '<script> window.location.replace("index.php");</script>';
    } else {
        echo mysqli_error($connect);
    }
}
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> Video Config</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a data-toggle="modal" href='#modal_change' class="btn green"> <?= $lang_text['change'][$lang] ?>
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
                        <th class="text-center">Video</th>
                        <th class="text-center">Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_data = $connect->query("SELECT * FROM tbl_website_config");
                    $row = mysqli_fetch_object($get_data);
                    echo '<tr>';
                    echo '<td class="text-left">
                                <iframe width="660" height="371" src="' . $row->vdo_url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </td>';
                    echo '<td>
                                <img src="../../img/flag/en.png"/>:' . $row->vdo_prefix_en . ' <strong>' . $row->vdo_title_en . '</strong><br>
                                <img src="../../img/flag/kh.png"/>:' . $row->vdo_prefix_kh . ' <strong>' . $row->vdo_title_kh . '</strong>
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
                    <input type="hidden" name="old_banner" value="<?= $row->hp_image ?>" class="form-control">
                    <div class="form-group">
                        <label for="">Video:</label><br>
                        <iframe width="100%" height="371" src="<?= $row->vdo_url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <input type="text" name="txt_url" class="form-control" value="<?= $row->vdo_url ?>">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Prefix En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_prefix_en" required="" autocomplete="off" value="<?= $row->vdo_prefix_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Prefix Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_prefix_kh" required="" autocomplete="off" value="<?= $row->vdo_prefix_kh ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_en" required="" autocomplete="off" value="<?= $row->vdo_title_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Prefix: Kh</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_kh" required="" autocomplete="off" value="<?= $row->vdo_title_kh ?>" />
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