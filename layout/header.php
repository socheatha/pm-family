<?php include_once 'config/database.php' ?>
<?php include_once 'language/index.php' ?>
<?php include_once 'function.php' ?>
<!DOCTYPE html>
<html lang="km-KH" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <link href="https://fonts.googleapis.com/css?family=Hanuman|Teko" rel="stylesheet">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?= $APP_TITLE??$row_website_config->{'title_' . $lang} ?></title>
    <meta name="keywords" content="<?= $row_website_config->{'keywords'} ?>">
    <meta name="description" content="<?= $row_website_config->{'description_' . $lang} ?>">
    <meta name="author" content="Bss | Socheatha Tey">
    <?= $prepare_meta_tags??'' ?>
    <style id='rs-plugin-settings-inline-css' type='text/css'>
        #rs-demo-id {}
    </style>
    <link rel='stylesheet' id='tlpportfolio-css-css' href='css/tlpportfolio.css' type='text/css' media='all' />
    <!-- <link rel='stylesheet' id='wpml-menu-item-0-css'  href='//boreypenghuoth.com/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/menu-item/style.css?ver=1' type='text/css' media='all' /> -->
    <link rel='stylesheet' id='homesweet-theme-fonts-css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Dosis:300,400,500,600,700,800&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
    <link rel='stylesheet' id='js_composer_front-css' href='css/js_composer_front_custom.css' type='text/css' media='all' />
    <link rel='stylesheet' id='awesome-css' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css' media='all' />
    <!-- <link rel='stylesheet' id='font-ionicons-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/ionicons.css?ver=v2.0.0' type='text/css' media='all' /> -->
    <!-- <link rel='stylesheet' id='apus-font-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/apus-font.css?ver=1.0.0' type='text/css' media='all' /> -->
    <!-- <link rel='stylesheet' id='material-design-iconic-font-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/material-design-iconic-font.css?ver=2.2.0' type='text/css' media='all' /> -->
    <link rel='stylesheet' id='animate-css' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css' type='text/css' media='all' />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel='stylesheet' id='homesweet-template-css' href='css/template.css' type='text/css' media='all' />
    <link rel="stylesheet" href="plugin/OwlCarousel2-2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="plugin/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css">
    <style id='homesweet-template-inline-css' type='text/css'>
        @import url('css/homesweet-template-inline-css.css');
    </style>
    <style type="text/css" title="dynamic-css" class="options-output">
        h1 {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h1,
            {
            opacity: 0;
        }

        .ie.wf-loading h1,
            {
            visibility: hidden;
        }

        h2 {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h2,
            {
            opacity: 0;
        }

        .ie.wf-loading h2,
            {
            visibility: hidden;
        }

        h3,
        .widgettitle,
        .widget-title {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h3,
        .widgettitle,
        .widget-title,
            {
            opacity: 0;
        }

        .ie.wf-loading h3,
        .widgettitle,
        .widget-title,
            {
            visibility: hidden;
        }

        h4 {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h4,
            {
            opacity: 0;
        }

        .ie.wf-loading h4,
            {
            visibility: hidden;
        }

        h5 {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h5,
            {
            opacity: 0;
        }

        .ie.wf-loading h5,
            {
            visibility: hidden;
        }

        h6 {
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading h6,
            {
            opacity: 0;
        }

        .ie.wf-loading h6,
            {
            visibility: hidden;
        }

        .apus-footer,
        .apus-footer .dark {
            background-color: #000000;
        }

        .apus-copyright {
            background-color: #000000;
        }
    </style>
    <style type="text/css" data-type="vc_custom-css">
        @media screen and (min-width:1024px) {
            .custom_side_map .wpb_content_element {
                margin-bottom: 12px;
            }

            .custom_sub_title {
                margin-top: 2px;
            }
        }

        .custom_menu_title {
            font-size: 21px;
            color: #009345;
        }

        .custom_sub_title {
            font-size: 16px;
            color: #009345;
            text-indent: 20px;
        }
    </style><noscript>
        <style type="text/css">
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
    <style>
        @import url('css/style.css');

        #apus-header .apus-topbar {
            background: <?= $row_website_config->{'top_header_bg'} ?>
        }

        #apus-header .apus-topbar .information p {
            color: <?= $row_website_config->{'top_header_color'} ?> !important;
        }

        .apus-header .contact-info-widget {
            color: <?= $row_website_config->{'middle_header_color'} ?> !important;
        }

        .header-bottom,
        .navbar-offcanvas-collapse,
        .apus-offcanvas,
        #apus-header-mobile {
            background: <?= $row_website_config->{'menu_bg'} ?> !important;
        }

        .navbar-nav.megamenu>li>a,
        .navbar-offcanvas .navbar-nav>li>a {
            color: <?= $row_website_config->{'menu_color'} ?>;
        }

        .header-mobile .btn.dropdown-toggle,.header-mobile .btn.dropdown-toggle:hover, .header-mobile .btn.dropdown-toggle:active, .header-mobile .btn.dropdown-toggle:focus, .header-mobile .btn.offcanvas:hover, .header-mobile .btn.offcanvas:active, .header-mobile .btn.offcanvas:focus,
        .header-mobile .btn.dropdown-toggle, {
            font-size: 28px; color: <?= $row_website_config->{'middle_header_color'} ?>!important;
        }

        .navbar-nav.megamenu>li:hover>a,
        .navbar-offcanvas .navbar-nav>li:hover>a {
            color: <?= $row_website_config->{'menu_hover'} ?>;
        }

        #primary-menu.navbar-nav.megamenu>li>a:hover,
        #primary-menu.navbar-nav.megamenu>li>a:active,
        #primary-menu.navbar-nav.megamenu>li>a:focus {
            color: <?= $row_website_config->{'menu_hover'} ?> !important;
        }

        /* footer */
        .vc_custom_1509356778902 {
            background-color: <?= $row_website_config->{'footer_top_bg'} ?>;
        }

        .apus-footer a,
        ._sct_footer_top {
            color: <?= $row_website_config->{'footer_top_color'} ?>;
        }

        h2.widgettitle {
            color: <?= $row_website_config->{'footer_top_color'} ?> !impotant;
        }

        .footer-1 ul li a:hover {
            color: <?= $row_website_config->{'footer_top_hover'} ?> !important;
        }

        #apus-footer .vc_custom_1522135018928 {
            background-color: <?= $row_website_config->{'footer_bottom_bg'} ?>;
        }

        .apus-footer {
            color: <?= $row_website_config->{'footer_top_color'} ?>;
        }

        /* btt */
        a#back-to-top {
            background-color: <?= $row_website_config->{'btt_bg'} ?>;
        }

        a#back-to-top i {
            color: <?= $row_website_config->{'btt_color'} ?>;
        }

        a {
            text-decoration: none !important;
        }

        <?php $hilight_color = $row_website_config->highlight_color; ?>#main-content h2.vc_custom_heading,
        h1.title_sub,
        .simple-text h4,
        .info-content .entry-title a:hover,
        #main-content .widget-text-heading .title,
        .entry-content .entry-title a:hover,
        .btn-readmore,
        .entry-title a:active,
        .entry-title a:hover,
        h4.title span,
        .bo-social-facebook,
        .bo-social-twitter,
        .bo-social-instagram,
        .apus-topbar .information p,
        .bo-social-linkedin,
        .bo-social-tumblr,
        .bo-social-google,
        .bo-social-pinterest,
        .sidebar-section ul li a:hover,
        .sidebar-section ul li a:focus,
        .tagcloud a,
        .detail-post .meta>span,
        .nav-links>a,
        .form-contact h3.title,
        .widget-information-box .title span,
        .widget-filter-form .filter-amenities-title i,
        .apus-footer .properties-list-small .property-box-price,
        .text-second,
        .second-color,
        .widget-information-box a:hover,
        .widget-information-box a:focus,
        .box-white .entry-title a:hover,
        .text-theme,
        .entry-title.property-title,
        .property-content>.property-section>h3,
        .widget-title,
        span.text-footer-descr:before,
        span.phone-footer:before,
        span.email-footer:before,
        .icon_color,
        .h3_title_sub {
            color: <?= $hilight_color ?> !important;
        }

        #primary-menu .dropdown-menu li>a,
        #primary-menu.navbar-nav.megamenu .dropdown-menu li>a:hover,
        .navbar-nav.megamenu .dropdown-menu li>a:active {
            color: <?= $row_website_config->{'menu_hover'} ?> !important;
        }

        /*Sticky-Header*/
        .home .sticky-header .header-bottom,
        .widget-content .owl-carousel .owl-controls .owl-dots .owl-dot.active span,
        .tlp-portfolio button.selected,
        .tlp-portfolio button:hover,
        .property-layout-full-icon .nav-table>li.active>a,
        .property-content>.property-section .map-direction,
        .property-layout-full-icon .nav-table>li>a,
        .nav-links>a:hover,
        .nav-links>span.current,
        .btn_readmore,
        .form-contact .btn,
        input.wpcf7-form-control.wpcf7-submit.btn.btn-submit,
        .owl-next,
        .owl-prev {
            background: <?= $hilight_color ?>;
            background-color: <?= $hilight_color ?> !important;
        }

        .btn-readmore:hover {
            color: #f1cec8;
        }

        #main-content .border_custom .vc_sep_line {
            border-color: #facac9 !important;
        }

        .vc_sep_holder .vc_sep_line {
            border-color: #f1cec8 !important;
        }

        .btn_readmore:hover {
            background-color: #444;
        }

        .tagcloud a:hover {
            background: #444;
        }

        .tlp-content-holder h3 {
            border-bottom: 1px solid #facac9;
        }

        .property-box-title .entry-title a:hover,
        .property-box-title .entry-title a:active,
        .property-box-title .entry-title a:focus {
            color: <?= $hilight_color ?> !important;
        }

        .header-mobile .btn.offcanvas {
            color: #fff;
            padding-top: 25px;
        }
        span.phone-property,
        .phone-property:before{
            color: <?= $hilight_color ?> !important;
        }

        .btn.btn-purple {
            background: <?= $hilight_color ?> !important;
            border-color: <?= $hilight_color ?>;
        }

        .btn.btn-purple:hover {
            background: <?= $hilight_color ?> !important;
            border-color: <?= $hilight_color ?>;
        }

        .property-layout-full-icon .nav-table>li>a:hover {
            background-color: #facac9 !important;
        }

        /*Contact*/
        /* input.wpcf7-form-control.wpcf7-submit.btn.btn-submit:hover {color: <?= $hilight_color ?>;border: 1px solid <?= $hilight_color ?>;} */

        /*Footer*/
        #apus-footer .vc_sep_line {
            border-color: #f1cec8 !important;
        }

        .menu li a:hover,
        .menu li a:active {
            color: #f1cec8 !important;
        }

        .entry-title a,
        .recentTitle h5,
        .entry-title {
            text-decoration: none;
            /* font-family: "Chenla", "Neuron", serif !important; */
            line-height: 1.3;
        }

        .title_sub,
        .portfolio-title,
        .widget-title span {
            /* font-family: "Chenla", "Neuron", serif !important; */
        }

        span.phone-footer {
            font-family: "cursive", "Cute Font", "Chenla", "Neuron", serif !important;
        }

        .h1,
        h1 {
            font-size: 28.5px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Chenla|Cute+Font&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script type="text/javascript" src="engine1/jquery.js"></script>
    <!-- End WOWSlider.com HEAD section -->
</head>

<body data-rsssl=1 class="page-template-default page page-id-6532 apus-body-loading image-lazy-loading wpb-js-composer js-comp-ver-5.2.1 vc_responsive">
    <div class="apus-page-loading">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <div id="wrapper-container" class="wrapper-container">
        <?php include_once('header_mobile.php') ?>
        <header id="apus-header" class="apus-header header-v1 hidden-sm hidden-xs" role="banner">
            <?php include_once('header_top.php') ?>
            <?php include_once('header_middle.php') ?>
            <div class="main-sticky-header-wrapper">
                <div class="main-sticky-header">
                    <?php include_once('top_logo.php') ?>
                    <?php include_once('header_bottom.php') ?>
                </div>
        </header>
        <?= @!$is_index ? '<img class="hidden-xs" src="img/logo/' . $row_website_config->banner . '" width="100%" />' : '' ?>
        <div id="apus-main-content">
            <?php //include_once('body_breadcrumb.php') 
            ?>
            <section id="main-container" class="<?= @$is_index ? 'container-fluit' : 'container' ?> inner">
                <div class="row">
                    <div id="main-content" class="main-page col-xs-12">
                        <main id="main" class="site-main" role="main">