<?php 
    $menu_active =10;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 

    if(isset($_POST["btn_change"])){
        $v_welcome_en = @$connect->real_escape_string($_POST['txt_welcome_en']);
        $v_welcome_kh = @$connect->real_escape_string($_POST['txt_welcome_kh']);
        $v_contact_en = @$connect->real_escape_string($_POST['txt_contact_en']);
        $v_contact_kh = @$connect->real_escape_string($_POST['txt_contact_kh']);
        $v_email_address = @$connect->real_escape_string($_POST['txt_email_address']);
        $v_addr_1_en = @$connect->real_escape_string($_POST['txt_addr_1_en']);
        $v_addr_1_kh = @$connect->real_escape_string($_POST['txt_addr_1_kh']);
        $v_addr_2_en = @$connect->real_escape_string($_POST['txt_addr_2_en']);
        $v_addr_2_kh = @$connect->real_escape_string($_POST['txt_addr_2_kh']);
        $v_copy_r_1_en = @$connect->real_escape_string($_POST['txt_copy_r_1_en']);
        $v_copy_r_1_kh = @$connect->real_escape_string($_POST['txt_copy_r_1_kh']);
        $v_copy_r_2_en = @$connect->real_escape_string($_POST['txt_copy_r_2_en']);
        $v_copy_r_2_kh = @$connect->real_escape_string($_POST['txt_copy_r_2_kh']);

        $sql = "UPDATE tbl_website_config SET 
            top_header_text_en = '$v_welcome_en',  
            top_header_text_kh = '$v_welcome_kh',  
            phone_en = '$v_contact_en',  
            phone_kh = '$v_contact_kh',  
            email_address = '$v_email_address',  
            address_line_1_en = '$v_addr_1_en',  
            address_line_1_kh = '$v_addr_1_kh',  
            address_line_2_en = '$v_addr_2_en',  
            address_line_2_kh = '$v_addr_2_kh',  
            footer_top_en = '$v_copy_r_1_en',  
            footer_top_kh = '$v_copy_r_1_kh',  
            footer_bottom_en = '$v_copy_r_2_en',  
            footer_bottom_kh = '$v_copy_r_2_kh'
        ";
        $result = mysqli_query($connect, $sql);
        if ($result) { 
            echo '<script> window.location.replace("index.php");</script>'; 
        }else{
            die(mysqli_error($connect));
        }
    }
?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> Text and Label Administrator</h2>
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
                        <th class="text-center">N&deg;</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Tanslate in En</th>
                        <th class="text-center">Translate in Kh</th>
                        <th class="text-center">Position</th>
                        <th class="text-center">Description</th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $get_data = $connect->query("SELECT * FROM tbl_website_config");
                        $row = mysqli_fetch_object($get_data);
                        echo '<tr>';
                            echo '<td class="text-center">1</td>';
                            echo '<td>welcome text</td>';
                            echo '<td>'.$row->top_header_text_en.'</td>';
                            echo '<td>'.$row->top_header_text_kh.'</td>';
                            echo '<td>Top Header</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">2</td>';
                            echo '<td>contact number</td>';
                            echo '<td>'.$row->phone_en.'</td>';
                            echo '<td>'.$row->phone_kh.'</td>';
                            echo '<td>Middle Header+Footer</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">3</td>';
                            echo '<td>email address</td>';
                            echo '<td>'.$row->email_address.'</td>';
                            echo '<td>'.$row->email_address.'</td>';
                            echo '<td>Middle Header+Footer</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">4</td>';
                            echo '<td>address line 1</td>';
                            echo '<td>'.$row->address_line_1_en.'</td>';
                            echo '<td>'.$row->address_line_1_kh.'</td>';
                            echo '<td>Middle Header+Footer</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">5</td>';
                            echo '<td>address line 2</td>';
                            echo '<td>'.$row->address_line_2_en.'</td>';
                            echo '<td>'.$row->address_line_2_kh.'</td>';
                            echo '<td>Middle Header+Footer</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">6</td>';
                            echo '<td>copy right line 1</td>';
                            echo '<td>'.$row->footer_top_en.'</td>';
                            echo '<td>'.$row->footer_top_kh.'</td>';
                            echo '<td>Bottom Footer</td>';
                            echo '<td>---</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">7</td>';
                            echo '<td>copy right line 2</td>';
                            echo '<td>'.$row->footer_bottom_en.'</td>';
                            echo '<td>'.$row->footer_bottom_kh.'</td>';
                            echo '<td>Bottom Footer</td>';
                            echo '<td>---</td>';
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
                    <p><strong>Basic Info</strong></p>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Welcome text En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_welcome_en" required="" autocomplete="off" value="<?= $row->top_header_text_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Welcome text Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_welcome_kh" required="" autocomplete="off" value="<?= $row->top_header_text_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Contact number En:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_contact_en" required="" autocomplete="off" value="<?= $row->phone_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Contact number Kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_contact_kh" required="" autocomplete="off" value="<?= $row->phone_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Email Address:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_email_address" required="" autocomplete="off" value="<?= $row->email_address ?>"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Address</strong></p>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Address line 1 en:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_addr_1_en" required="" autocomplete="off" value="<?= $row->address_line_1_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Address line 1 kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_addr_1_kh" required="" autocomplete="off" value="<?= $row->address_line_1_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Address line 2 en:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_addr_2_en" required="" autocomplete="off" value="<?= $row->address_line_2_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Address line 2 kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_addr_2_kh" required="" autocomplete="off" value="<?= $row->address_line_2_kh ?>"/>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p><strong>Footer</strong></p>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Copy right line 1 en:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_copy_r_1_en" required="" autocomplete="off" value="<?= $row->footer_top_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Copy right line 1 kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_copy_r_1_kh" required="" autocomplete="off" value="<?= $row->footer_top_kh ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Copy right line 2 en:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_copy_r_2_en" required="" autocomplete="off" value="<?= $row->footer_bottom_en ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">Copy right line 2 kh:</label>
                                <input type="text" class="form-control" placeholder="" name="txt_copy_r_2_kh" required="" autocomplete="off" value="<?= $row->footer_bottom_kh ?>"/>
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