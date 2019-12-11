<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?= @$layout_title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for blank page layout" name="description" />
        <meta content="" name="author" />
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../assets/global/plugins/bootstrap-select-1.12.4/css/bootstrap-select.min.css">
        <!-- END PAGE LEVEL PLUGINS -->
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <!-- <link href="../../assets/global/css/components-rounded.css" rel="stylesheet" id="style_components" type="text/css" /> -->
        <link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../../assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../../assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        
        <link rel="shortcut icon" href="favicon.ico" /> 
        <style type="text/css">
            table#sample_2 * { white-space: nowrap; }
            *,h1,h2,h3,h4,h5,h6{ font-family: 'Chenla',"Open Sans", sans-serif; }
            .portlet h2{ margin: 10px!important; }
            .page-sidebar-menu li{ border-bottom: 1px dashed #aaa!important; }
        </style>
        <!-- language -->
        <?php include_once '../../language/index.php';  ?>
    </head>
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="../../index.php">
                        <img src="../../img/img_logo/Pos_Malaysia_Logo.png" width="100px" alt="logo" class="logo-default" /> 
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                <?php include_once('top_navigation.php') ?>
                <!-- END PAGE ACTIONS -->
                
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <small><i class="fa fa-circle" style="color: lightgreen;"></i></small>
                                    <span class="username username-hide-on-mobile"> <?= @$_SESSION['user']->username ?> </span>

                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="../../img/img_user/blank.png" /> </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <?php if (@$_SESSION['user']->position_id == 1): ?>
                                        <li>
                                            <a href="../user/">
                                                <i class="icon-user"></i> <?= $lang_text['userManagement'][$lang] ?></a>
                                        </li>
                                    <?php endif ?>
                                    <li>
                                        <a href="<?= $_SERVER['PHP_SELF'] ?>?lang=<?= ($lang=='en'?'kh':'en') ?>">
                                            <i class="fa fa-language"></i> <?= $lang_text['changeLanguage'][$lang] ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" href='#modal_change_passwprd'>
                                            <i class="fa fa-lock"></i> <?= $lang_text['changePassword'][$lang] ?></a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="../../login.php?action=logout">
                                            <i class="icon-key"></i> <?= $lang_text['logout'][$lang] ?> </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container" style="padding: 5px;">
            
            <!-- BEGIN SIDEBAR -->
            <?php include_once getcwd().'/left_navigation.php'; ?>
            <!-- END SIDEBAR -->
            
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" style="transform: translate(0px,-10px); padding-left: 5px;">

