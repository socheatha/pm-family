<?php include_once('layout/header.php') ?>
<?php 
    $id = @$_GET['id'];
    if(!$id){ 
        header('location: project.php'); 
    }
    $get_data = $connect->query("SELECT A.*,
        GROUP_CONCAT(B.image ORDER BY B.index ASC) as sliders 
        FROM tbl_projects as A
        LEFT JOIN tbl_project_images as B ON B.parent_id=A.id
        WHERE A.id='$id'");
    $row = mysqli_fetch_object($get_data);
    $sliders = explode(',',$row->sliders);
?>
    <h1 class="title_sub">ដឹស្តា មេរាហ្កាដិន</h1><br>
    <?php if(isset($row->sliders)){ ?>
        <div id="tab-gallery-map-gallery" class="tab-pane active">
            <div class="property-gallery">
                <div class="property-gallery-preview property-box-image-inner">
                    <div 
                        class="owl-carousel property-gallery-preview-owl" 
                        data-smallmedium="1" 
                        data-extrasmall="1" 
                        data-items="1" 
                        data-carousel="owl" 
                        data-loop="false"  
                        data-pagination="false" 
                        data-nav="true" 
                        data-margin="0"
                    >
                        <?php foreach($sliders as $slider){ echo '<img width="1140" height="690" src="img/project/'.$slider.'" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="'.$row_website_config->{'keywords'}.'" />'; } ?>						
                    </div>
                </div>
                <div class="owl-carousel property-gallery-index" data-smallmedium="8" data-extrasmall="3" data-items="8" data-carousel="owl" data-pagination="false" data-nav="true" data-margin="10">
                    <?php 
                        $s_index = 0;
                        foreach($sliders as $slider){
                            echo ' <div class="thumb-link '.($s_index++==0?'active':'').'">
                                <a href="#">
                                    <img width="194" src="img/project/'.$slider.'" class="attachment-homesweet-gallery-thumbnails size-homesweet-gallery-thumbnails" alt="'.$row_website_config->{'keywords'}.'"/>						
                                </a>
                            </div>';
                        }
                    ?>
                </div><!-- /.property-gallery -->
            </div>
        </div>
        <br>
        <hr>																																															
        <br>																																															
    <?php } ?>		
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <?php echo $row->{'detail_'.$lang}; ?>																																																						
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="sidebar-detail sidebar sticky-this" style="">
                    <!-- sidebar -->
                                                    
                <aside id="enquire_widget-3" class="widget widget_enquire_widget">
                    <form method="post" class="contact-agent" action="">
                        <input type="hidden" name="post_id" value="<?= $id ?>">
                        <div class="form-group">
                            <input class="form-control" name="name" type="text" placeholder="<?= $lang_text['name'][$lang] ?>" value="" required="required">
                        </div><!-- /.form-group -->   
                        <div class="form-group">
                            <input class="form-control" name="email" type="email" placeholder="<?= $lang_text['l_email'][$lang] ?>" value="" required="required">
                        </div><!-- /.form-group -->
                        <div class="form-group">
                            <input class="form-control" name="phone" type="text" placeholder="<?= $lang_text['phone'][$lang] ?>" value="" required="required">
                        </div><!-- /.form-group --> 
                        <div class="form-group">
                            <textarea class="form-control" name="message" required="required" placeholder="<?= $lang_text['p_comment'][$lang] ?>" rows="4"></textarea>
                        </div><!-- /.form-group -->        
                        <div class="button-wrapper">
                                    <button type="submit" class="button btn btn-block btn-purple" name="enquire_form"><?= $lang_text['p_sent'][$lang] ?></button>
                        </div><!-- /.button-wrapper -->
                    </form>
                </aside>							
            </div>
        </div>
    </div>					
    <style>
        .form-control, input[type="submit"]{
			padding-top: 25px!important;
			padding-bottom: 25px!important;
			border: 1px solid #eee;
		}
    </style>																																								
<?php include_once('layout/footer.php') ?>