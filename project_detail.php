<?php include_once 'config/database.php' ?>
<?php
$id = @$_GET['id'];
if (!$id) {
    header('location: project.php');
}

if (isset($_POST['btn_send_mail'])) 
{
    include_once('layout/header.php');
    $to = $row_website_config->{'email_address'};
    $v_post_url = $connect->real_escape_string(@$_POST['txt_post_url']); 
    $v_subject = $connect->real_escape_string(@$_POST['txt_subject']); 
    $v_name = $connect->real_escape_string(@$_POST['txt_name']); 
    $v_email = $connect->real_escape_string(@$_POST['txt_email']); 
    $v_phone = $connect->real_escape_string(@$_POST['txt_phone']); 
    $v_message = $connect->real_escape_string(@$_POST['txt_message']); 

    // start send mail
    $subject = mb_encode_mimeheader($v_subject, 'UTF-8', 'B', "\r\n", strlen('Subject: '));
    $v_message = "<p>-url: <a target='_blank' href='".$v_post_url."'>".$v_post_url."</a></p>
                <p>-name: " .$v_name. "</p>
                <p>-email: " .$v_email. "</p>
                <p>-tel: " . $v_phone . "</p>
                <p>-message: " . $v_message. "</p>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$v_email.'>' . "\r\n";
    if(mail($to,$subject,$v_message,$headers)){
        echo '<script> window.alert("'.$lang_text['ct_email_sended'][$lang].'"); window.location.replace("'.$v_post_url.'"); </script>';
    }else{
        echo '<script> window.alert("Problem while sending please contact directly!") </script>';
    }
}

$get_data = $connect->query("SELECT A.*,
        GROUP_CONCAT(B.image ORDER BY B.index ASC) as sliders,
        (SELECT GROUP_CONCAT(CONCAT(E.name_en,'_dev_socheatha_',E.name_kh,'_dev_socheatha_',E.profile) 
            ORDER BY E.name_en ASC 
            SEPARATOR '_dev_split_') 
            FROM tbl_proj_feat AS DE 
            LEFT JOIN tbl_project_feature AS E ON E.id=DE.feature_id
            WHERE DE.project_id=A.id
        ) AS features
        FROM tbl_projects as A
        LEFT JOIN tbl_project_images as B ON B.parent_id=A.id
        WHERE A.id='$id'");
$row = mysqli_fetch_object($get_data);
$sliders = explode(',', $row->sliders);

// prepare for fb share
$APP_TITLE = $row->{'title_'.$lang};
$prepare_meta_tags = '
    <meta property="og:title" content="'.$row->{'title_'.$lang}.'" />
    <meta property="og:description " content="'.$row->phone_saler.' | '.$row->email_saler.'" />
    <meta property="og:site_name" content="'.$_SERVER['HTTP_HOST'].'" />
    <meta property="og:url" content="'.$base_url.$_SERVER['REQUEST_URI'].'" />
    <meta property="og:image" content="'.$base_url.$_SERVER['REQUEST_URI'].'/../img/project/'. $row->{'profile'}.'" />
';

?>
<?php include_once('layout/header.php') ?>
<h1 class="title_sub title_border_bottom"><?= $row->{'title_' . $lang} ?>
    <div class="pull-right">
        <div class="addthis_inline_share_toolbox"></div>
    </div>
</h1>
<div class="clearfix"></div>
<br>
<?php if (isset($row->sliders)) { ?>
    <div id="tab-gallery-map-gallery" class="tab-pane active">
        <div class="property-gallery">
            <div class="property-gallery-preview property-box-image-inner">
                <div class="owl-carousel property-gallery-preview-owl" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-loop="false" data-pagination="false" data-nav="true" data-margin="0">
                    <?php foreach ($sliders as $slider) {
                        echo '<img width="1140" height="690" src="img/project/' . $slider . '" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="' . $row_website_config->{'keywords'} . '" />';
                    } ?>
                </div>
            </div>
            <div class="owl-carousel property-gallery-index" data-smallmedium="8" data-extrasmall="3" data-items="8" data-carousel="owl" data-pagination="false" data-nav="true" data-margin="10">
                <?php
                $s_index = 0;
                foreach ($sliders as $slider) {
                    echo ' <div class="thumb-link ' . ($s_index++ == 0 ? 'active' : '') . '">
                        <a href="#">
                            <img width="194" src="img/project/' . $slider . '" class="attachment-homesweet-gallery-thumbnails size-homesweet-gallery-thumbnails" alt="' . $row_website_config->{'keywords'} . '"/>						
                        </a>
                    </div>';
                }
                ?>
            </div><!-- /.property-gallery -->
        </div>
    </div>
    <br>
<?php } ?>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div id="property-section-detail" class="property-section property-overview">
            <h3 class="h3_title_sub"><?= $lang_text['feature'][$lang] ?></h3>
            <hr>
            <div class="overview-header">
                <ul class="columns-gap columns-gap5">

                    <?php
                        foreach (explode('_dev_split_', @$row->features) as $feaure) {
                            if ($feaure) {
                                $feature_data = explode('_dev_socheatha_', $feaure);
                                echo '<li ><span>'. ($lang == "kh" ? $feature_data[1] : $feature_data[0]). ':</span> 
                                <img src="img/project/feature/' . $feature_data[2] . '"></li>';
                            }
                        }
                    ?>
                </ul>
                <br>
            </div>
            <ul class="columns-gap"></ul>
        </div>
        <?php echo $row->{'detail_' . $lang}; ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="sidebar-detail sidebar sticky-this" style="">
            <!-- sidebar -->

            <aside id="enquire_widget-3" class="widget widget_enquire_widget">
                <form method="post" class="contact-agent" action="">
                    <input type="hidden" name="txt_post_url" value="<?= $base_url.$_SERVER['REQUEST_URI'] ?>">
                    <input type="hidden" name="txt_subject" value="<?= $row->{'title_' . $lang} ?>">
                    <div class="form-group">
                        <input class="form-control" name="txt_name" required type="text" placeholder="<?= $lang_text['name'][$lang] ?>" value="" required="required">
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <input class="form-control" name="txt_email" required type="email" placeholder="<?= $lang_text['l_email'][$lang] ?>" value="" required="required">
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <input class="form-control" name="txt_phone" required type="text" placeholder="<?= $lang_text['phone'][$lang] ?>" value="" required="required">
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <textarea class="form-control" name="txt_message" required required="required" placeholder="<?= $lang_text['p_comment'][$lang] ?>" rows="4"></textarea>
                    </div><!-- /.form-group -->
                    <div class="button-wrapper">
                        <button type="submit" name="btn_send_mail" class="button btn btn-block btn-purple"><?= $lang_text['p_sent'][$lang] ?></button>
                    </div><!-- /.button-wrapper -->
                </form>
            </aside>
        </div>
    </div>
</div>
<style>
    .form-control,
    input[type="submit"] {
        padding-top: 25px !important;
        padding-bottom: 25px !important;
        border: 1px solid #eee;
    }
</style>
<?php include_once('layout/footer.php') ?>