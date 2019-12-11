
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">2017 - <?= date("Y") ?> &copy; BSS Solution </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END FOOTER -->
        
        <!-- BEGIN CORE PLUGINS -->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../../assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-select-1.12.4/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <!-- <script src="../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
        <!-- <script src="../../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script> -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    </body>

</html> 
<?php 
    if(isset($_POST['btn_change_password'])){
        $v_pass = $_POST['txt_password'];
        $v_c_pass = $_POST['txt_password_conform'];
        if($v_pass == $v_c_pass){
            $v_pass = md5($v_pass);
            $enctypt_password = sha1(md5($v_pass)).sha1("0962195196");
            $v_user = $_SESSION['user']->id;
            $connect->query("UPDATE tbl_pos_user SET password='$enctypt_password' WHERE id='$v_user'");
            echo '<script> window.location.replace("../../login.php?action=logout") </script>';
        }else{
            echo '<script> alert("password not match ..."); </script>';
        }
    }
?>
<div class="modal fade" id="modal_change_passwprd">
    <div class="modal-dialog">
        <div class="modal-content modal-xs">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= $lang_text['changePassword'][$lang] ?></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="form_change_password">
                    <div class="form-group">
                        <label for=""><?= $lang_text['newPassword'][$lang] ?></label>
                        <input type="password" class="form-control" name="txt_password" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for=""><?= $lang_text['confirmPassword'][$lang] ?></label>
                        <input type="password" class="form-control" name="txt_password_conform" required="" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="btn_change_password" form="form_change_password" class="btn btn-primary"><?= $lang_text['savePassword'][$lang] ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $lang_text['close'][$lang] ?></button>
            </div>
        </div>
    </div>
</div>
<?php //mysqli_close($connect); ?>
