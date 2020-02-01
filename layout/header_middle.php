<div class="header-middle">
    <div class="container">
        <div class="pull-left">

            <!--<div class="logo-in-theme ">   
                <div class="logo">
                    <a href="#" >
                        <img src="" alt="">
                    </a>
                </div>
            </div>-->

        </div>
        <div style="width: 100%;">
            <div class="header-infor" style="margin: 30px auto; ">
                <div class="contact-info-widget" style="margin-left: -110px; ">
                    <table align="center">
                        <tr>
                            <td valign="middle">
                                <i class="fa fa-phone fa-fw icon_color fa-2x"></i>
                            </td>
                            <td>
                                <div class="pull-right">
                                    <div class="content">
                                        <?= $row_website_config->{'phone_'.$lang} ?>
                                        <br>
                                        <?= $row_website_config->{'email_address'} ?>
                                    </div>
                                </div>
                            </td>
                            <td width="20px"></td>
                            <td>
                                <i class="fa fa-map-marker fa-fw icon_color fa-2x"></i>
                            </td>
                            <td>
                                <div class="pull-right">
                                    <div class="content">
                                        <?= $row_website_config->{'address_line_1_'.$lang} ?>
                                        <br> 
                                        <?= $row_website_config->{'address_line_2_'.$lang} ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- <aside id="apus_contact_info-2" class="widget widget_apus_contact_info">
                    <div class="contact-info-widget">
                        <div class="media phone-info pull-left">
                            <div class="media-body">
                                <div class="content">
                                    <div class="media phone-info pull-left">
                                        <div class="media-left media-middle">
                                            <div class="icon">
                                                <i class="fa fa-phone icon_color fa-2x"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="content">
                                                <?= $row_website_config->{'phone_'.$lang} ?>
                                                <br>
                                                <?= $row_website_config->{'email_address'} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media address-info pull-left">
                            <div class="media-body">
                                <div class="content">
                                    <div class="media address-info pull-left">
                                        <div class="media-left media-middle">
                                            <div class="icon">
                                                <i class="fa fa-map-marker icon_color fa-2x"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="content">
                                                <?= $row_website_config->{'address_line_1_'.$lang} ?>
                                                <br> 
                                                <?= $row_website_config->{'address_line_2_'.$lang} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>                    -->
            </div>
        </div>
    </div>
</div>