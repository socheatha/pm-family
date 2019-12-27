<?php include_once('layout/header.php') ?>
<?php 
    $id = @$_GET['id'];
    if(!$id){ 
        header('location: project_current.php'); 
    }
    $get_data = $connect->query("SELECT A.*,
        GROUP_CONCAT(B.image ORDER BY B.index ASC) as sliders 
        FROM tbl_projects as A
        LEFT JOIN tbl_project_images as B ON B.parent_id=A.id
        WHERE A.id='$id'");
    $row = mysqli_fetch_object($get_data);
    $sliders = explode(',',$row->sliders);
?>
    <h1 class="title_sub">ដឹស្តា មេរាហ្កាដិន</h1>
    <div class="tabs-gallery-map">
	    <div class="tab-content tab-content-descrip">
					<div id="tab-gallery-map-gallery" class="tab-pane active">
					<div class="property-gallery">
		<div class="property-gallery-preview property-box-image-inner">
			            
			        <div class="owl-carousel property-gallery-preview-owl owl-theme owl-loaded" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-loop="false" data-pagination="false" data-nav="true" data-margin="0">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 5700px;">
                                <div class="owl-item active" style="width: 1140px; margin-right: 0px;">
                                    <img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo1.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo1.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo1-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo1-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px">
                                </div>
                                <div class="owl-item" style="width: 1140px; margin-right: 0px;">
                                    <img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo2.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo2.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo2-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo2-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px">
                                </div>
                                <div class="owl-item" style="width: 1140px; margin-right: 0px;">
                                    <img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo3.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo3.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo3-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo3-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px">
                                </div>
                                <div class="owl-item" style="width: 1140px; margin-right: 0px;">
                                    <img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo4.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo4.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo4-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo4-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px">
                                </div>
                            <div class="owl-item" style="width: 1140px; margin-right: 0px;">
                                <img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo5.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo5.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo5-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo5-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px">
                            </div>
                        </div>
                    </div>
                <div class="owl-controls">
                    <div class="owl-nav">
                        <div class="owl-prev" style="">
                            <span class="ion-ios-arrow-left"></span>
                        </div>
                        <div class="owl-next" style="">
                            <span class="ion-ios-arrow-right"></span>
                        </div>
                    </div>
                    <div class="owl-dots" style="display: none;"></div>
                </div>
            </div>
		</div>
        <div class="owl-carousel property-gallery-index owl-theme owl-loaded" data-smallmedium="8" data-extrasmall="3" data-items="8" data-carousel="owl" data-pagination="false" data-nav="true" data-margin="10">				
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 718.75px;">
                    <?php
                        foreach($sliders as $slider){
                            echo '<div class="owl-item" style="width: 133.75px; margin-right: 10px;">
                                <div class="thumb-link">
                                    <a href="https://boreypenghuoth.com/wp-content/uploads/2018/04/Condo2.jpg" class="cboxElement">
                                        <img width="194" height="114" src="img/project/'.$slider.'" class="attachment-homesweet-gallery-thumbnails size-homesweet-gallery-thumbnails" alt="" srcset="img/project/'.$slider.'">						
                                    </a>
                                </div>
                            </div>';
                        }
                    ?>
                </div>
            </div>
        <div class="owl-controls">
            <div class="owl-nav">
                <div class="owl-prev" style="display: none;">
                    <span class="ion-ios-arrow-left"></span>
                </div>
                <div class="owl-next" style="display: none;">
                    <span class="ion-ios-arrow-right"></span>
                </div>
            </div>
            <div class="owl-dots" style="display: none;"></div>
        </div>
    </div>
</div><!-- /.property-gallery -->
</div>

    </div>
</div>																																																<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2280px, 0px, 0px); transition: all 0.25s ease 0s; width: 6840px;"><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-1140x690.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-1140x690.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-520x316.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-768x466.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item active" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><span class="ion-ios-arrow-left"></span></div><div class="owl-next" style=""><span class="ion-ios-arrow-right"></span></div></div><div class="owl-dots" style="display: none;"></div></div></div> -->
    <?php
        print_r($sliders);
        // echo $row->{'title_'.$lang};
        // echo '<br>';
        echo $row->{'detail_'.$lang};
    ?>																																																								<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-2280px, 0px, 0px); transition: all 0.25s ease 0s; width: 6840px;"><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-1140x690.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-1140x690.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-520x316.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/The_Star_Diamond_01-768x466.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star3-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item active" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Start1-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star2-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Star.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Star-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div><div class="owl-item" style="width: 1140px; margin-right: 0px;"><img width="1140" height="690" src="https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1.jpg" class="attachment-homesweet-gallery-v3 size-homesweet-gallery-v3" alt="" srcset="https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1.jpg 1140w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1-520x315.jpg 520w, https://boreypenghuoth.com/wp-content/uploads/2018/06/Euro1-768x465.jpg 768w" sizes="(max-width: 1140px) 100vw, 1140px"></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><span class="ion-ios-arrow-left"></span></div><div class="owl-next" style=""><span class="ion-ios-arrow-right"></span></div></div><div class="owl-dots" style="display: none;"></div></div></div>
<?php include_once('layout/footer.php') ?>