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
            <li class="nav-item  <?php echo (@$_SESSION['history_status']==0 && @$_SESSION['history_status']!='')?'active':''; ?>">
                <a href="index.php?history_status='0'" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: purple;"></i>
                    <span class="title"><?= $lang_text['pending'][$lang] ?></span>
                </a>
            </li>
             <li class="nav-item  <?php echo (@$_SESSION['history_status']=='1')?'active':''; ?>">
                <a href="index.php?history_status=1" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: brown;"></i>
                    <span class="title"><?= $lang_text['doing'][$lang] ?></span>
                </a>
            </li>
             <li class="nav-item  <?php echo (@$_SESSION['history_status']=='2')?'active':''; ?>">
                <a href="index.php?history_status=2" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: green;"></i>
                    <span class="title"><?= $lang_text['finished'][$lang] ?></span>
                </a>
            </li>
            <li class="nav-item  <?php echo (@$_SESSION['history_status']=='3')?'active':''; ?>">
                <a href="index.php?history_status=3" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: #444;"></i>
                    <span class="title"><?= $lang_text['cashed'][$lang] ?></span>
                </a>
            </li>
            <li class="nav-item  <?php echo (@$_SESSION['history_status']=='4')?'active':''; ?>">
                <a href="index.php?history_status=4" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: red;"></i>
                    <span class="title"><?= $lang_text['notDone'][$lang] ?></span>
                </a>
            </li>
            <li class="nav-item  <?php echo (@$_SESSION['history_status']=='0962195196' || @$_SESSION['history_status']=='')?'active':''; ?>">
                <a href="index.php?history_status=0962195196" class="nav-link nav-toggle">
                    <i class="fa fa-stop" style="color: purple;"></i>
                    <i class="fa fa-stop" style="color: brown;"></i>
                    <i class="fa fa-stop" style="color: green;"></i>
                    <i class="fa fa-stop" style="color: #444;"></i>
                    <i class="fa fa-stop" style="color: red;"></i>
                    <span class="title"><?= $lang_text['all'][$lang] ?></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>