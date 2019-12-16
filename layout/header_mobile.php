<div id="apus-mobile-menu" class="apus-offcanvas hidden-lg hidden-md"> 
    <div class="apus-offcanvas-body">
        <div class="offcanvas-head bg-primary">
            <a class="btn-toggle-canvas" data-toggle="offcanvas">
                <i class="fa fa-close"></i> <strong>MENU</strong>
            </a>
        </div>
        <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
            <div class="navbar-collapse navbar-offcanvas-collapse">
                <ul id="main-mobile-menu" class="nav navbar-nav">
                    <li id="menu-item-7131" class="menu-item-7131"><a href="index.php"><?= $lang_text['m_home'][$lang] ?></a></li>
                    <li id="menu-item-7132" class="has-submenu menu-item-7132"><a href="#"><?= $lang_text['m_about'][$lang] ?></a> <span class="icon-toggle"><i class="fa fa-plus"></i></span>
                    <ul class="sub-menu">
                        <li id="menu-item-7133" class="menu-item-7133"><a href="about_us.php"><?= $lang_text['m_wwa'][$lang] ?></a></li>
                        <li id="menu-item-7134" class="has-submenu menu-item-7134"><a href="#"><?= $lang_text['m_csr'][$lang] ?></a> <span class="icon-toggle"><i class="fa fa-plus"></i></span>
                        <ul class="sub-menu">
                            <li id="menu-item-7135" class="menu-item-7135"><a href="activity.php"><?= $lang_text['m_activity'][$lang] ?></a></li>
                            <li id="menu-item-7136" class="menu-item-7136"><a href="certificate.php"><?= $lang_text['m_certificate'][$lang] ?></a></li>
                        </ul>
                    </li>
                        <li id="menu-item-7137" class="menu-item-7137"><a href="honor_and_award.php"><?= $lang_text['m_honor'][$lang] ?></a></li>
                    </ul>
                    </li>
                    <li id="menu-item-7138" class="has-submenu menu-item-7138"><a href="#"><?= $lang_text['m_project'][$lang] ?></a> <span class="icon-toggle"><i class="fa fa-plus"></i></span>
                    <ul class="sub-menu">
                        <li id="menu-item-7143" class="menu-item-7143"><a href="project_current.php"><?= $lang_text['l_current_pro'][$lang] ?></a></li>
                        <li id="menu-item-7143" class="menu-item-7143"><a href="project_existing.php"><?= $lang_text['l_exist_pro'][$lang] ?></a></li>
                    </ul>
                    </li>
                    <li id="menu-item-7154" class="has-submenu menu-item-7154"><a href="#"><?= $lang_text['m_news'][$lang] ?></a> <span class="icon-toggle"><i class="fa fa-plus"></i></span>
                    <ul class="sub-menu">
                        <li id="menu-item-7156" class="menu-item-7156"><a href="hot_sale.php"><?= $lang_text['m_promotion'][$lang] ?></a></li>
                        <li id="menu-item-7155" class="menu-item-7155"><a href="news.php"><?= $lang_text['m_news'][$lang] ?></a></li>
                    </ul>
                    </li>
                    <li id="menu-item-7158" class="menu-item-7158"><a href="contact_us.php"><?= $lang_text['m_contact'][$lang] ?></a></li>
                    <li id="menu-item-wpml-ls-317-en" class="menu-item-wpml-ls-317-en">
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?lang=<?= $lang=='en'?'kh':'en' ?>"><img class="wpml-ls-flag" src="img/flag/<?= $lang=='en'?'kh':'en' ?>.png" alt="en" title="English">
                    </a></li>
                </ul>
            </div>        
        </nav>
    </div>
</div>
<div class="over-dark"></div>
<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">
    <div class="container">
        <div class="logo pull-left">
            <a href="index.php">
                <img src="img/logo/<?= $row_website_config->logo ?>" alt="<?= $row_website_config->{'title_'.$lang} ?>">
            </a>
        </div>
        <div class="pull-right header-mobile-right">
            <button data-toggle="offcanvas" class="btn btn-offcanvas btn-toggle-canvas offcanvas pull-left" type="button">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
</div>