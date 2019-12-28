<?php include_once('layout/header.php') ?>
    <div class="container tlp-portfolio tlp-portfolio-detail">
        <div class="row">
            <?php 
                $id = @$_GET['id'];
                $type = 1;
                if(!$id){ header('location: honor_and_award.php'); }
                $get_data = $connect->query("SELECT A.*
                    FROM tbl_certificates as A
                    Where A.id='$id'");
                $row = mysqli_fetch_object($get_data);
                echo '
                    <article id="post-8856" class="tlp-single-detail post-8856 portfolio type-portfolio status-publish has-post-thumbnail hentry portfolio-category-353">
                        <div class="tlp-col-lg-6 tlp-col-md-6 tlp-col-sm-12 tlp-col-xs-12 ">
                            <div class="portfolio-feature-img">
                                <img src="img/certificate/'.$row->{'profile'}.'" alt="'.$row->{'title_'.$lang}.' - '.$row->{'short_description_'.$lang}.'">                    </div>
                        </div>
                        <div class="portfolio-detail-desc tlp-col-lg-6 tlp-col-md-6 tlp-col-sm-12 tlp-col-xs-12">
                            <h2 class="portfolio-title">'.$row->{'title_'.$lang}.'</h2>
                            <div class="portfolio-details"></div>
                            <div class="others-info">
                                <ul class="single-item-meta">
                                    <ul class="single-item-meta">
                                        <li class="categories">'.$lang_text['date'][$lang].': '.$CustomDate->date_format($row->{'date'},"d-F-Y",$lang).'</li>
                                        <li class="categories">'.$row->{'short_description_'.$lang}.'</li>
                                    </ul>
                                </ul>                    
                            </div>
                        </div>
                    </article>
                ';
            ?>
        </div>
    </div>
    <br>
<?php include_once('layout/footer.php') ?>