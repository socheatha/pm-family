<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['feature'][$lang] ?></h3>
            </li>
            <li class="nav-item  ">
                <a href="../transaction_monthly/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['monthlyTransaction'][$lang] ?></span>
                </a>
            </li>
<!--             <?php if (@$_SESSION['user']->position_id == 1 OR @$_SESSION['user']->position_id == 2) : ?>
                <li class="nav-item  ">
                    <a href="../transaction_new/" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">New Transaction</span>
                    </a>
                </li>
            <?php endif ?> -->
<!--             <li class="nav-item  ">
                <?php 
                    $get_data = $connect->query("SELECT * FROM tbl_transaction AS A 
                        LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                        LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                        LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                        WHERE A.t_fix_status='1' OR A.t_fix_status='0'
                        ORDER BY A.t_date_received DESC");
                    $v_get_record = mysqli_num_rows($get_data);
                ?>
                <a href="../transaction_list/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">List of Transaction <span style="color: red;">[<?= $v_get_record ?>]</span></span>
                </a>
            </li> -->
     <!--        <li class="nav-item  ">
                <?php 
                    $get_data = $connect->query("SELECT * FROM tbl_transaction AS A 
                        LEFT JOIN tbl_pos_customer AS C ON C.no=A.t_customer
                        LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
                        LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
                        WHERE A.t_fix_status='2'
                        ORDER BY A.t_date_received DESC");
                    $v_get_record = mysqli_num_rows($get_data);
                ?>
                <a href="../transaction_finished/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Finished Transaction <span style="color: red;">[<?= $v_get_record ?>]</span></span>
                </a>
            </li> -->
            <li class="nav-item  ">
                <a href="../transaction_cashed/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['cashedTransaction'][$lang] ?> </span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="../transaction_report/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['reportTransaction'][$lang] ?> </span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>