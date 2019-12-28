<?php 
    $menu_active =10;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 

    if(isset($_POST["btn_change"])){
        $v_top_header_bg = $_POST['txt_top_header_bg'];
        $v_top_header_color = $_POST['txt_top_header_color'];
        // $v_middle_header_bg = $_POST['txt_middle_header_bg'];
        $v_middle_header_color = $_POST['txt_middle_header_color'];
        $v_menu_bg = $_POST['txt_menu_bg'];
        $v_menu_color = $_POST['txt_menu_color'];
        $v_menu_hover = $_POST['txt_menu_hover'];
        $v_footer_top_bg = $_POST['txt_footer_top_bg'];
        $v_footer_top_color = $_POST['txt_footer_top_color'];
        $v_footer_top_hover = $_POST['txt_footer_top_hover'];
        $v_footer_bottom_bg = $_POST['txt_footer_bottom_bg'];
        $v_footer_bottom_color = $_POST['txt_footer_bottom_color'];
        $v_btt_bg = $_POST['txt_btt_bg'];
        $v_btt_color = $_POST['txt_btt_color'];
        $v_highlight_color = $_POST['txt_highlight_color'];
        $sql = "UPDATE tbl_website_config SET 
            top_header_bg = '$v_top_header_bg',  
            top_header_color = '$v_top_header_color',
            -- middle_header_bg = '$v_middle_header_bg',
            middle_header_color = '$v_middle_header_color',
            menu_bg = '$v_menu_bg',
            menu_color = '$v_menu_color',
            menu_hover = '$v_menu_hover',
            footer_top_bg = '$v_footer_top_bg',
            footer_top_color = '$v_footer_top_color',
            footer_top_hover = '$v_footer_top_hover',
            footer_bottom_bg = '$v_footer_bottom_bg',
            footer_bottom_color = '$v_footer_bottom_color',
            btt_bg = '$v_btt_bg',
            btt_color = '$v_btt_color',
            highlight_color = '$v_highlight_color'
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
            <h2><i class="fa fa-cubes fa-fw"></i> Color and Background Administrator</h2>
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
                        <th class="text-center">Type</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Description</th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $get_data = $connect->query("SELECT * FROM tbl_website_config");
                        $row = mysqli_fetch_object($get_data);
                        echo '<tr>';
                            echo '<td class="text-center">1</td>';
                            echo '<td>Header</td>';
                            echo '<td>top header bg</td>';
                            echo '<td class="text-center" style="background-color: '.$row->top_header_bg.'; color: #aaa;">'.$row->top_header_bg.'</td>';
                            echo '<td>background color of top header</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">2</td>';
                            echo '<td>Header</td>';
                            echo '<td>top header color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->top_header_color.'; color: #aaa;">'.$row->top_header_color.'</td>';
                            echo '<td>text color of top header</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">3</td>';
                            echo '<td>Header</td>';
                            echo '<td>middle header color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->middle_header_color.'; color: #aaa;">'.$row->middle_header_color.'</td>';
                            echo '<td>text color of contact nubmer and address on middle header</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">4</td>';
                            echo '<td>Header</td>';
                            echo '<td>bottom header bg</td>';
                            echo '<td class="text-center" style="background-color: '.$row->menu_bg.'; color: #aaa;">'.$row->menu_bg.'</td>';
                            echo '<td>background color of menu</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">5</td>';
                            echo '<td>Header</td>';
                            echo '<td>bototm header color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->menu_color.'; color: #aaa;">'.$row->menu_color.'</td>';
                            echo '<td>text color of menu</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">6</td>';
                            echo '<td>Header</td>';
                            echo '<td>bottom header hover</td>';
                            echo '<td class="text-center" style="background-color: '.$row->menu_hover.'; color: #aaa;">'.$row->menu_hover.'</td>';
                            echo '<td>text color of menu when mouse hover</td>';
                        echo '</tr>';echo '<tr>';
                            echo '<td class="text-center">7</td>';
                            echo '<td>Footer</td>';
                            echo '<td>top footer bg</td>';
                            echo '<td class="text-center" style="background-color: '.$row->footer_top_bg.'; color: #aaa;">'.$row->footer_top_bg.'</td>';
                            echo '<td>background color of footer top</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">8</td>';
                            echo '<td>Footer</td>';
                            echo '<td>top footer color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->footer_top_color.'; color: #aaa;">'.$row->footer_top_color.'</td>';
                            echo '<td>text color of footer top</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">9</td>';
                            echo '<td>Footer</td>';
                            echo '<td>top footer hover</td>';
                            echo '<td class="text-center" style="background-color: '.$row->footer_top_hover.'; color: #aaa;">'.$row->footer_top_hover.'</td>';
                            echo '<td>text color of footer top when hover</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">10</td>';
                            echo '<td>Footer</td>';
                            echo '<td>bottom footer bg</td>';
                            echo '<td class="text-center" style="background-color: '.$row->footer_bottom_bg.'; color: #aaa;">'.$row->footer_bottom_bg.'</td>';
                            echo '<td>background color of footer bottom</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">11</td>';
                            echo '<td>Footer</td>';
                            echo '<td>bototm footer color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->footer_bottom_color.'; color: #aaa;">'.$row->footer_bottom_color.'</td>';
                            echo '<td>text color of footer bottom</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">12</td>';
                            echo '<td>BTT</td>';
                            echo '<td>back to top bg</td>';
                            echo '<td class="text-center" style="background-color: '.$row->btt_bg.'; color: #aaa;">'.$row->btt_bg.'</td>';
                            echo '<td>background color of back to top button at footer right</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">13</td>';
                            echo '<td>BTT</td>';
                            echo '<td>back to top color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->btt_color.'; color: #aaa;">'.$row->btt_color.'</td>';
                            echo '<td>color of back to top button at footer right</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td class="text-center">14</td>';
                            echo '<td>ALL</td>';
                            echo '<td>highlight color</td>';
                            echo '<td class="text-center" style="background-color: '.$row->highlight_color.'; color: #aaa;">'.$row->highlight_color.'</td>';
                            echo '<td>color of title text , button, ....</td>';
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
                    <p><strong>Header</strong></p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Top Header Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_top_header_bg" required="" autocomplete="off" value="<?= $row->top_header_bg ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Top Header Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_top_header_color" required="" autocomplete="off" value="<?= $row->top_header_color ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Middle Header Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_middle_header_bg" required="" autocomplete="off" value="<?= $row->middle_header_bg ?>"/>
                            </div>
                        </div> -->
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Middle Header Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_middle_header_color" required="" autocomplete="off" value="<?= $row->middle_header_color ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Header Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_menu_bg" required="" autocomplete="off" value="<?= $row->menu_bg ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Header Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_menu_color" required="" autocomplete="off" value="<?= $row->menu_color ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Header Hover:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_menu_hover" required="" autocomplete="off" value="<?= $row->menu_hover ?>"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Footer</strong></p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Top Footer Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_footer_top_bg" required="" autocomplete="off" value="<?= $row->footer_top_bg ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Top Footer Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_footer_top_color" required="" autocomplete="off" value="<?= $row->footer_top_color ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Top Footer Hover:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_footer_top_hover" required="" autocomplete="off" value="<?= $row->footer_top_hover ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Footer Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_footer_bottom_bg" required="" autocomplete="off" value="<?= $row->footer_bottom_bg ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Footer Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_footer_bottom_color" required="" autocomplete="off" value="<?= $row->footer_bottom_color ?>"/>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p><strong>BTT (Back To Top)</strong></p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Footer Bg:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_btt_bg" required="" autocomplete="off" value="<?= $row->btt_bg ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">Bottom Footer Color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_btt_color" required="" autocomplete="off" value="<?= $row->btt_color ?>"/>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p><strong>Highlight Color</strong></p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">highlight color:</label>
                                <input type="color" class="form-control" placeholder="" name="txt_highlight_color" required="" autocomplete="off" value="<?= $row->highlight_color ?>"/>
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