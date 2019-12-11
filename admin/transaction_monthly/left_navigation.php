<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['feature'][$lang] ?></h3>
            </li>
            <li class="nav-item  ">
                <a href="../transaction/" class="nav-link nav-toggle">
                    <i class="fa fa-undo"></i>
                    <span class="title"><?= $lang_text['back'][$lang] ?></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <?php 
            $v_recent_date=date('Y-m-d');
            $get_recent = $connect->query("SELECT t_customer_phone_number,t_created_at 
            FROM tbl_transaction
            WHERE DATE_FORMAT(t_created_at,'%Y-%m-%d')='$v_recent_date'
            ORDER BY t_id DESC
            ");
            if(mysqli_num_rows($get_recent)){
                ?>
                <div class="panel panel-primary" style="margin-bottom: 0px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><em><?= $lang_text['recentTransaction'][$lang] ?></em></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover tbl_pd0">
                        <?php 
                            $v_recent_array = [];
                            while ($row_recent = mysqli_fetch_object($get_recent)) {
                                echo '<tr class="'.( (in_array($row_recent->t_customer_phone_number, $v_recent_array))?('text-danger'):('') ).'">
                                    <td>'.$row_recent->t_customer_phone_number.'</td>
                                    <td class="text-right"><em><small>'.date("h:i:sa", strtotime($row_recent->t_created_at)).'</small></em></td>
                                </tr>';
                                array_push($v_recent_array,$row_recent->t_customer_phone_number);
                            }
                        ?>
                        </table>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <style type="text/css" media="screen">
        .tbl_pd0 *{
            padding: 2px 5px!important;
        }
    </style>
    <!-- END SIDEBAR -->
</div>