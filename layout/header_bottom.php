<div class="header-bottom">
    <div class="container">
        <div class="bottom-inner clearfix">
            <div class="main-menu pull-left">
                <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar p-static" role="navigation">
                    <div class="collapse navbar-collapse"><ul id="primary-menu" class="nav navbar-nav megamenu"><li class="menu-item-7131 aligned-"><a href="index.php"><?= $lang_text['m_home'][$lang] ?></a></li>
                        <li class="dropdown menu-item-7132 aligned-"><a href="#" class="dropdown-toggle"  data-hover="dropdown" data-toggle="dropdown"><?= $lang_text['m_about'][$lang] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="menu-item-7133 aligned-"><a href="about_us.php"><?= $lang_text['m_wwa'][$lang] ?></a></li>
                            <li class="dropdown menu-item-7134 aligned-"><a href="#" class="dropdown-toggle"  data-hover="dropdown" data-toggle="dropdown"><?= $lang_text['m_csr'][$lang] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item-7135 aligned-"><a href="activity.php"><?= $lang_text['m_activity'][$lang] ?></a></li>
                                <li class="menu-item-7136 aligned-"><a href="certificate.php"><?= $lang_text['m_certificate'][$lang] ?></a></li>
                            </ul>
                        </li>
                            <li class="menu-item-7137 aligned-"><a href="honor_and_award.php"><?= $lang_text['m_honor'][$lang] ?></a></li>
                        </ul>
                        </li>
                        <li class="dropdown menu-item-7138 aligned-"><a href="#"  data-hover="dropdown" data-toggle="dropdown"><?= $lang_text['m_project'][$lang] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item-7133 aligned-"><a href="project.php?project_type_id=2"><?= $lang_text['l_current_pro'][$lang] ?></a></li>
                                <li class="menu-item-7133 aligned-"><a href="project.php?project_type_id=3"><?= $lang_text['l_exist_pro'][$lang] ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown menu-item-7154 aligned-"><a href="#" class="dropdown-toggle"  data-hover="dropdown" data-toggle="dropdown"><?= $lang_text['m_news_cap'][$lang] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="menu-item-7156 aligned-"><a href="hot_sale.php"><?= $lang_text['m_promotion'][$lang] ?></a></li>
                            <li class="menu-item-7155 aligned-"><a href="news.php"><?= $lang_text['m_news'][$lang] ?></a></li>
                        </ul>
                        </li>
                        <li class="menu-item-7158 aligned-"><a href="contact_us.php"><?= $lang_text['m_contact'][$lang] ?></a></li>
                        <li class="menu-item-wpml-ls-317-en aligned-">
                            <a href="<?= $_SERVER['PHP_SELF'] ?>?lang=<?= $lang=='en'?'kh':'en' ?>"><img class="wpml-ls-flag" src="img/flag/<?= $lang=='en'?'kh':'en' ?>.png" alt="en" title="English"></a>
                        </li>
                        </ul>
                    </div>                                
                </nav>
            </div>
            <div class="pull-right"> </div>
        </div>
    </div>
</div>