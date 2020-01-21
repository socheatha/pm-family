<?php
$menu_active = 0;
$layout_title = "Welcome to System";
include_once '../../config/database.php';
include_once '../../config/athonication.php';
include_once '../layout/header.php';
?>
<?php

if (isset($_POST["btn_change"])) {
    $v_old_banner_1 = $_POST['old_banner_1'];
    $v_old_banner_2 = $_POST['old_banner_2'];
    $v_old_banner_3 = $_POST['old_banner_3'];

    if (!empty($_FILES['txt_feature_1_image']['size'])) {
        $image1 = date('Y_m_d') . "_" . rand(1111, 9999) . ".png";
        move_uploaded_file($_FILES['txt_feature_1_image']['tmp_name'], "../../img/project/" . $image1);
        if (file_exists("../../img/project/" . $v_old_banner_1)) {
            unlink("../../img/project/" . $v_old_banner_1);
        }
    } else {
        $image1 = $v_old_banner_1;
    }

    if (!empty($_FILES['txt_feature_2_image']['size'])) {
        $image2 = date('Y_m_d') . "_" . rand(1111, 9999) . ".png";
        move_uploaded_file($_FILES['txt_feature_2_image']['tmp_name'], "../../img/project/" . $image2);
        if (file_exists("../../img/project/" . $v_old_banner_2)) {
            unlink("../../img/project/" . $v_old_banner_2);
        }
    } else {
        $image2 = $v_old_banner_2;
    }

    if (!empty($_FILES['txt_feature_3_image']['size'])) {
        $image3 = date('Y_m_d') . "_" . rand(1111, 9999) . ".png";
        move_uploaded_file($_FILES['txt_feature_3_image']['tmp_name'], "../../img/project/" . $image3);
        if (file_exists("../../img/project/" . $v_old_banner_3)) {
            unlink("../../img/project/" . $v_old_banner_3);
        }
    } else {
        $image3 = $v_old_banner_3;
    }

    $v_prefix_en = $_POST['txt_prefix_en'];
    $v_prefix_kh = $_POST['txt_prefix_kh'];
    $v_title_en = $_POST['txt_title_en'];
    $v_title_kh = $_POST['txt_title_kh'];

    $v_feature_1_title_en = $_POST['txt_feature_1_title_en'];
    $v_feature_1_title_kh = $_POST['txt_feature_1_title_kh'];
    $v_feature_1_url = $_POST['txt_feature_1_url'];

    $v_feature_2_title_en = $_POST['txt_feature_2_title_en'];
    $v_feature_2_title_kh = $_POST['txt_feature_2_title_kh'];
    $v_feature_2_url = $_POST['txt_feature_2_url'];

    $v_feature_3_title_en = $_POST['txt_feature_3_title_en'];
    $v_feature_3_title_kh = $_POST['txt_feature_3_title_kh'];
    $v_feature_3_url = $_POST['txt_feature_3_url'];

    $sql = "UPDATE tbl_website_config SET 
        feature_1_title_en = '$v_feature_1_title_en',
        feature_1_title_kh = '$v_feature_1_title_kh',
        feature_1_image = '$image1',
        feature_1_url = '$v_feature_1_url',

        feature_2_title_en = '$v_feature_2_title_en',
        feature_2_title_kh = '$v_feature_2_title_kh',
        feature_2_image = '$image2',
        feature_2_url = '$v_feature_2_url',

        feature_3_title_en = '$v_feature_3_title_en',
        feature_3_title_kh = '$v_feature_3_title_kh',
        feature_3_image = '$image3',
        feature_3_url = '$v_feature_3_url',

        feature_prefix_en = '$v_prefix_en',
        feature_prefix_kh = '$v_prefix_kh',
        feature_title_en = '$v_title_en',
        feature_title_kh = '$v_title_kh'
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
            <h2><i class="fa fa-cubes fa-fw"></i> Feature Config</h2>
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
                        <th class="text-center">#</th>
                        <th class="text-left">Title</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Url</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_data = $connect->query("SELECT * FROM tbl_website_config");
                    $row = mysqli_fetch_object($get_data);
                    echo '<tr>';
                    echo '<td class="text-center">1</td>';
                    echo '<td class="text-left">Main</td>';
                    echo '<td class="text-center">
                                <a href="../../img/project/' . $row->feature_1_image . '" target="_blank"><img src="../../img/project/' . $row->feature_1_image . '" height="50px"/></a>
                            </td>';
                    echo '<td class="text-left">
                                <img src="../../img/flag/en.png"/>:' . $row->feature_1_title_en . '<br>
                                <img src="../../img/flag/kh.png"/>:' . $row->feature_1_title_kh . '
                            </td>';
                    echo '<td class="text-left"> ' . $row->feature_1_url . ' </td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="text-center">2</td>';
                    echo '<td class="text-left">Right Top</td>';
                    echo '<td class="text-center">
                                <a href="../../img/project/' . $row->feature_2_image . '" target="_blank"><img src="../../img/project/' . $row->feature_2_image . '" height="50px"/></a>
                            </td>';
                    echo '<td class="text-left">
                                <img src="../../img/flag/en.png"/>:' . $row->feature_2_title_en . '<br>
                                <img src="../../img/flag/kh.png"/>:' . $row->feature_2_title_kh . '
                            </td>';
                    echo '<td class="text-left"> ' . $row->feature_2_url . ' </td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="text-center">3</td>';
                    echo '<td class="text-left">Right Bottom</td>';
                    echo '<td class="text-center">
                                <a href="../../img/project/' . $row->feature_3_image . '" target="_blank"><img src="../../img/project/' . $row->feature_3_image . '" height="50px"/></a>
                            </td>';
                    echo '<td class="text-left">
                                <img src="../../img/flag/en.png"/>:' . $row->feature_3_title_en . '<br>
                                <img src="../../img/flag/kh.png"/>:' . $row->feature_3_title_kh . '
                            </td>';
                    echo '<td class="text-left"> ' . $row->feature_3_url . ' </td>';
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
                    <input type="hidden" name="old_banner_1" value="<?= $row->feature_1_image ?>" class="form-control">
                    <input type="hidden" name="old_banner_2" value="<?= $row->feature_2_image ?>" class="form-control">
                    <input type="hidden" name="old_banner_3" value="<?= $row->feature_3_image ?>" class="form-control">

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Prefix En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_prefix_en" required="" autocomplete="off" value="<?= $row->feature_prefix_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Prefix Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_prefix_kh" required="" autocomplete="off" value="<?= $row->feature_prefix_kh ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_en" required="" autocomplete="off" value="<?= $row->feature_title_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_title_kh" required="" autocomplete="off" value="<?= $row->feature_title_kh ?>" />
                            </div>
                        </div>
                    </div>

                    <br>
                    <p><strong>Main Feature</strong></p>
                    <div class="form-group">
                        <label for="">Image:</label><br>
                        <img width="100%" src="../../img/project/<?= $row->feature_1_image ?>" />
                        <input type="file" name="txt_feature_1_image" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_1_title_en" required="" autocomplete="off" value="<?= $row->feature_1_title_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_1_title_kh" required="" autocomplete="off" value="<?= $row->feature_1_title_kh ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Url:</label>
                        <input type="text" class="form-control" placeholder="" name="txt_feature_1_url" required="" autocomplete="off" value="<?= $row->feature_1_url ?>" />
                    </div>

                    <br>
                    <p><strong>Right Top</strong></p>
                    <div class="form-group">
                        <label for="">Image:</label><br>
                        <img width="100%" src="../../img/project/<?= $row->feature_2_image ?>" />
                        <input type="file" name="txt_feature_2_image" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_2_title_en" required="" autocomplete="off" value="<?= $row->feature_2_title_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_2_title_kh" required="" autocomplete="off" value="<?= $row->feature_2_title_kh ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Url:</label>
                        <input type="text" class="form-control" placeholder="" name="txt_feature_2_url" required="" autocomplete="off" value="<?= $row->feature_2_url ?>" />
                    </div>

                    <br>
                    <p><strong>Right Bottom</strong></p>
                    <div class="form-group">
                        <label for="">Image:</label><br>
                        <img width="100%" src="../../img/project/<?= $row->feature_3_image ?>" />
                        <input type="file" name="txt_feature_3_image" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_3_title_en" required="" autocomplete="off" value="<?= $row->feature_3_title_en ?>" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Title Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_feature_3_title_kh" required="" autocomplete="off" value="<?= $row->feature_3_title_kh ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Url:</label>
                        <input type="text" class="form-control" placeholder="" name="txt_feature_3_url" required="" autocomplete="off" value="<?= $row->feature_3_url ?>" />
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