<div class="footer-builder-wrapper lighting footer-1">
    <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-parallax="1.5" class="vc_row wpb_row vc_row-fluid vc_custom_1509356778902 vc_row-has-fill vc_general vc_parallax vc_parallax-content-moving">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div class="vc_empty_space  hidden-sm hidden-xs"   style="height: 10px" >
                        <span class="vc_empty_space_inner"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <div class="apus_custom_menu wpb_content_element ">
                                <div class="">
                                    <h2 class="widgettitle"><?= $lang_text['f_other_page'][$lang] ?></h2>
                                    <div class="menu-quick-link-kh-container">
                                        <ul id="menu-quick-link-kh" class="menu">
                                            <li id="menu-item-4417" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4417"><a href="privacy_policy.php"><?= $lang_text['l_term'][$lang] ?></a></li>
                                            <li id="menu-item-4418" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4418"><a href="about_us.php"><?= $lang_text['l_about'][$lang] ?></a></li>
                                            <li id="menu-item-4419" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4419"><a href="privacy_policy.php"><?= $lang_text['l_privacy'][$lang] ?></a></li>
                                            <li id="menu-item-6568" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6568"><a href="sitemap.php"><?= $lang_text['l_sitemap'][$lang] ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="apus_custom_menu wpb_content_element ">
                                <div class="">
                                    <h2 class="widgettitle"><?= $lang_text['f_project'][$lang] ?></h2>
                                    <div class="menu-quick-link-kh-container">
                                        <ul id="menu-quick-link-kh" class="menu">
                                            <li id="menu-item-4417" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4417"><a href="project.php?project_type_id=2"><?= $lang_text['l_current_pro'][$lang] ?></a></li>
                                            <li id="menu-item-4418" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4418"><a href="project.php?project_type_id=1"><?= $lang_text['l_future_pro'][$lang] ?></a></li>
                                            <li id="menu-item-4419" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4419"><a href="project.php?project_type_id=3"><?= $lang_text['l_exist_pro'][$lang] ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div> 
                        <div class="visible-sm visible-xs">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="apus_custom_menu wpb_content_element ">
                                <div class="">
                                    <h2 class="widgettitle"><?= $lang_text['f_social'][$lang] ?></h2>
                                    <div>
                                        <div class="wpb_wrapper">
                                            <div>
                                                <p>
                                                    <a href="<?= $social['fb'] ?>" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-right: 8px; margin-bottom: 10px;" src="img/social/fbiconph-icon.png" alt="<?= $row_website_config->{'title_'.$lang} ?>" width="40" height="40" /></a>
                                                    <a href="<?= $social['u_tube'] ?>" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-right: 8px; margin-bottom: 10px; " src="img/social/youtubeiconph_icon.png" alt="<?= $row_website_config->{'title_'.$lang} ?>" /></a>
                                                    <a href="<?= $social['twitter'] ?>" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-right: 8px; margin-bottom: 10px; " src="img/social/twitter-icon.png" alt="<?= $row_website_config->{'title_'.$lang} ?>" /></a>
                                                    <a href="<?= $social['linkedin'] ?>" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-bottom: 10px; " src="img/social/linkiniconph_icon.png" alt="<?= $row_website_config->{'title_'.$lang} ?>" /></a>
                                                    <!-- <a class="social-media" href="#" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-right: 8px; margin-bottom: 10px;" src="img/social/gplusiconph_icon.png" alt="P.M Family Reality & Invesment" /></a> -->
                                                    <!-- <a class="social-media" href="#" target="_blank" rel="noopener noreferrer"><img style="width: 35px; margin-right: 8px; margin-bottom: 10px;" src="img/social/instagramiconph_icon.png" alt="P.M Family Reality & Invesment" /></a> -->
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="apus_custom_menu wpb_content_element ">
                                <div class="">
                                    <h2 class="widgettitle"><?= $lang_text['f_contact'][$lang] ?></h2>
                                        <div style="margin-top: -1.5px;">
                                            <table>
                                                <tr style="font-size: 15px;">
                                                    <td width="25px" class="text-center"><i class="fa fa-map-marker fa-fw" style="font-size: 20px;"></i></td>
                                                    <td>
                                                        <span style="white-space: nowrap;"><?= $row_website_config->{'address_line_1_'.$lang} ?></span>
                                                        <br> 
                                                        <?= $row_website_config->{'address_line_2_'.$lang} ?>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2" height="10px"></td></tr>
                                                <tr style="font-size: 15px;">
                                                    <td class="text-center"><i class="fa fa-phone fa-fw"></i></td>
                                                    <td style="white-space: nowrap;">
                                                        <?= $row_website_config->{'phone_'.$lang} ?>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2" height="10px"></td></tr>
                                                <tr style="font-size: 15px;">
                                                    <td class="text-center"><i class="fa fa-envelope fa-fw"></i></td>
                                                    <td style="white-space: nowrap;">
                                                        <?= ' &nbsp;'.$lang_text['l_email'][$lang] ?>: <?= $row_website_config->{'email_address'} ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                </div>
                            </div>
                            <div class="apus_custom_menu wpb_content_element _sct_footer_top">
                                
                            </div>
                            <br><br>
                        </div>
                    </div>    
                </div>
                <div class="vc_empty_space"   style="height: 20px" >
                    <span class="vc_empty_space_inner"></span>
                </div>
            </div>
        </div>
    </div>
</div>