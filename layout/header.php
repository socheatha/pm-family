<?php include_once 'config/database.php' ?>
<?php include_once 'language/index.php' ?>
<?php include_once 'function.php' ?>
<!DOCTYPE html>
<html lang="km-KH" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<link href="https://fonts.googleapis.com/css?family=Hanuman" rel="stylesheet">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title>ប្លង់វែបសាយ | <?= $row_website_config->{'title_'.$lang} ?></title>
    <meta name="keywords" content="<?= $row_website_config->{'keywords'} ?>">
    <meta name="description" content="<?= $row_website_config->{'description_'.$lang} ?>">
    <meta name="author" content="Bss | Socheatha Tey">
    
    <style id='rs-plugin-settings-inline-css' type='text/css'>
        #rs-demo-id {}
    </style>
    <link rel='stylesheet' id='tlpportfolio-css-css'  href='css/tlpportfolio.css' type='text/css' media='all' />
    <!-- <link rel='stylesheet' id='wpml-menu-item-0-css'  href='//boreypenghuoth.com/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/menu-item/style.css?ver=1' type='text/css' media='all' /> -->
    <link rel='stylesheet' id='homesweet-theme-fonts-css'  href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Dosis:300,400,500,600,700,800&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
    <link rel='stylesheet' id='js_composer_front-css'  href='css/js_composer_front_custom.css' type='text/css' media='all' />
    <link rel='stylesheet' id='awesome-css'  href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css' media='all' />
    <!-- <link rel='stylesheet' id='font-ionicons-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/ionicons.css?ver=v2.0.0' type='text/css' media='all' /> -->
    <!-- <link rel='stylesheet' id='apus-font-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/apus-font.css?ver=1.0.0' type='text/css' media='all' /> -->
    <!-- <link rel='stylesheet' id='material-design-iconic-font-css'  href='https://boreypenghuoth.com/wp-content/themes/gfproperty/css/material-design-iconic-font.css?ver=2.2.0' type='text/css' media='all' /> -->
    <link rel='stylesheet' id='animate-css'  href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css' type='text/css' media='all' />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel='stylesheet' id='homesweet-template-css'  href='css/template.css' type='text/css' media='all' />
    <style id='homesweet-template-inline-css' type='text/css'>
        @import url('css/homesweet-template-inline-css.css');
    </style>
    <style type="text/css" title="dynamic-css" class="options-output">h1{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h1,{opacity: 0;}.ie.wf-loading h1,{visibility: hidden;}h2{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h2,{opacity: 0;}.ie.wf-loading h2,{visibility: hidden;}h3, .widgettitle, .widget-title{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h3, .widgettitle, .widget-title,{opacity: 0;}.ie.wf-loading h3, .widgettitle, .widget-title,{visibility: hidden;}h4{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h4,{opacity: 0;}.ie.wf-loading h4,{visibility: hidden;}h5{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h5,{opacity: 0;}.ie.wf-loading h5,{visibility: hidden;}h6{opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;}.wf-loading h6,{opacity: 0;}.ie.wf-loading h6,{visibility: hidden;}.apus-footer,.apus-footer .dark{background-color:#000000;}.apus-copyright{background-color:#000000;}</style><style type="text/css" data-type="vc_custom-css">@media screen and (min-width:1024px){
    .custom_side_map .wpb_content_element {margin-bottom: 12px;}
    .custom_sub_title {margin-top: 2px;}
    }

    .custom_menu_title {font-size: 21px;color: #009345;}
    .custom_sub_title {
        font-size: 16px;
        color: #009345;
        text-indent: 20px;
    }</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
    <style>
        @import url('css/style.css');
        #apus-header .apus-topbar{ background: <?= $row_website_config->{'top_header_bg'} ?> }
        #apus-header .apus-topbar .information p{ color: <?= $row_website_config->{'top_header_color'} ?>!important; }
        .apus-header .contact-info-widget{ color: <?= $row_website_config->{'middle_header_color'} ?>!important; }
        .header-bottom,.navbar-offcanvas-collapse,.apus-offcanvas{background: <?= $row_website_config->{'menu_bg'} ?>!important;  }
        .navbar-nav.megamenu > li > a,.navbar-offcanvas .navbar-nav > li > a{ color: <?= $row_website_config->{'menu_color'} ?>; }
        .navbar-nav.megamenu > li:hover > a, .navbar-offcanvas .navbar-nav > li:hover > a{ color: <?= $row_website_config->{'menu_hover'} ?>; }
        #primary-menu.navbar-nav.megamenu > li > a:hover,#primary-menu.navbar-nav.megamenu > li > a:active,#primary-menu.navbar-nav.megamenu > li > a:focus {color: <?= $row_website_config->{'menu_hover'} ?> !important;}
    
        /* footer */
        .vc_custom_1509356778902{ background-color: <?= $row_website_config->{'footer_top_bg'} ?>; }
        .apus-footer a,._sct_footer_top{ color: <?= $row_website_config->{'footer_top_color'} ?>; }
        h2.widgettitle{ color: <?= $row_website_config->{'footer_top_color'} ?>!impotant; }
        .footer-1 ul li a:hover{ color: <?= $row_website_config->{'footer_top_hover'} ?>!important; }
        #apus-footer .vc_custom_1522135018928{ background-color: <?= $row_website_config->{'footer_bottom_bg'} ?>; }
        .apus-footer{ color: <?= $row_website_config->{'footer_top_color'} ?>; }

        /* btt */
        a#back-to-top{ background-color: <?= $row_website_config->{'btt_bg'} ?>; }
        a#back-to-top i{ color: <?= $row_website_config->{'btt_color'} ?>; }
    </style>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
        <img src="img/banner/top_banner.png" width="100%"/>
        <div id="apus-main-content">
            <?php //include_once('body_breadcrumb.php') ?>
            <section id="main-container" class="container inner">
                <div class="row">
                    <div id="main-content" class="main-page col-xs-12">
                        <main id="main" class="site-main" role="main">