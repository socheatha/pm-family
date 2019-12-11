<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['feature'][$lang] ?></h3>
            </li>            
            <li class="nav-item  ">
                <a href="../st_stockin/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockIn'][$lang] ?></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="../st_stockout/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockOut'][$lang] ?></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="../st_stock_adjust/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockAdjust'][$lang] ?></span>
                </a>
            </li>            
            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['reportStockIn'][$lang] ?></h3>
            </li> 
            <li class="nav-item  ">
                <a href="../st_stock_report/stockin_by_date.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockInByDate'][$lang] ?></span>
                </a>
            </li>
<!--             <li class="nav-item  ">
                <a href="../st_stock_report/stockin_by_employee.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Stockin by Employee</span>
                </a>
            </li> -->
            <li class="nav-item  ">
                <a href="../st_stock_report/stockin_by_category.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockInByCategory'][$lang] ?></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['reportStockOut'][$lang] ?></h3>
            </li> 
            <li class="nav-item  ">
                <a href="../st_stock_report/stockout_by_date.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockOutByDate'][$lang] ?></span>
                </a>
            </li>
<!--             <li class="nav-item  ">
                <a href="../st_stock_report/stockout_by_employee.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Stockout by Employee</span>
                </a>
            </li> -->
            <li class="nav-item  ">
                <a href="../st_stock_report/stockout_by_category.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockOutByCategory'][$lang] ?></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase"><?= $lang_text['reportStockBalance'][$lang] ?></h3>
            </li> 
            <li class="nav-item  ">
                <a href="../st_stock_balance/" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title"><?= $lang_text['stockBalance'][$lang] ?></span>
                </a>
            </li>
<!--             <li class="nav-item  ">
                <a href="../st_stock_report/balance_by_invoice.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Stock Balance by Invoice</span>
                </a>
            </li> -->
<!--             <li class="nav-item  ">
                <a href="../st_stock_report/balance_by_date.php" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Stock Balance by Date</span>
                </a>
            </li> -->
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>