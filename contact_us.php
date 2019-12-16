<?php include_once('layout/header.php') ?>
	<br><br>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.828766936103!2d104.87787861367515!3d11.564597867895452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951bc85342909%3A0x5189fa20cc4c87e1!2z4Z6Y4Z6H4Z-S4Z6N4Z6Y4Z6O4Z-S4Z6M4Z6b4oCL4Z6i4Z6X4Z634Z6c4Z6M4Z-S4Z6N4Z6T4Z-PIOGen-GeoOGeguGfkuGemuGet-GekyDhnoDhnpjhn5LhnpbhnrvhnofhnrYg4Z6l4Z6O4Z-S4Z6M4Z62!5e0!3m2!1sen!2skh!4v1576309939716!5m2!1sen!2skh" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	<br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 form_contact">
			<div class="form-contact">
				<h3 class="title">សូមផ្ញើសារមកកាន់យើងខ្ញុំ</h3>
				<div class="row">
				<div class="col-xs-12 col-sm-6">
				<span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="Your Name"></span>
					</div>
				<div class="col-xs-12 col-sm-6">
				<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email form-control" id="Email" aria-invalid="false" placeholder="Your Email"></span>
					</div>
				</div>
				<div class="row">
				<div class="col-xs-12 col-sm-6">
				<span class="wpcf7-form-control-wrap tel-72"><input type="tel" name="tel-72" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel form-control" aria-required="true" aria-invalid="false" placeholder="Phone Number"></span>
					</div>
				<div class="col-xs-12 col-sm-6">
							<span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text form-control" id="contact-subject" aria-invalid="false" placeholder="Subject"></span>
						</div>
				</div>
				<p><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-control" aria-invalid="false" placeholder="Message"></textarea></span></p>
				<div style="margin-bottom: 20px;">
				<div class="wpcf7-form-control-wrap"><div data-sitekey="6LfwCawUAAAAACKWxdyqVQyVCoqIdde804bD8S9J" class="wpcf7-form-control g-recaptcha wpcf7-recaptcha"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfwCawUAAAAACKWxdyqVQyVCoqIdde804bD8S9J&amp;co=aHR0cHM6Ly9ib3JleXBlbmdodW90aC5jb206NDQz&amp;hl=en&amp;v=mhgGrlTs_PbFQOW4ejlxlxZn&amp;size=normal&amp;cb=gle9u3auiol" width="304" height="78" role="presentation" name="a-otwqksizy4ds" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div></div>
				<noscript>
					<div style="width: 302px; height: 422px;">
						<div style="width: 302px; height: 422px; position: relative;">
							<div style="width: 302px; height: 422px; position: absolute;">
								<iframe src="https://www.google.com/recaptcha/api/fallback?k=6LfwCawUAAAAACKWxdyqVQyVCoqIdde804bD8S9J" frameborder="0" scrolling="no" style="width: 302px; height:422px; border-style: none;">
								</iframe>
							</div>
							<div style="width: 300px; height: 60px; border-style: none; bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px; background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
								<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;">
								</textarea>
							</div>
						</div>
					</div>
				</noscript>
				</div>
				</div>
				<p><input type="submit" value="ផ្ញើសារ" class="wpcf7-submit btn btn-submit btn-submit-kh"><span class="ajax-loader"></span></p>
			</div>
			<br>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 contact_info">
			<div class="widget-information-box ">
				<h3 class="title">
				<span>ព័ត៌មានរបស់យើងខ្ញុំ</span>
				</h3>
						<div class="description">
					<div class="space-30"></div>
				<div class="information-footer">
				<div class="media">
				<div class="media-left media-middle">
				<div class="icon">
					<i class="fa fa-paper-plane"></i>
				</div>
				</div>
				<div class="media-body media-middle">
					<?= $row_website_config->{'address_line_1_'.$lang} ?><br>
					<?= $row_website_config->{'address_line_2_'.$lang} ?><br>
				</div>
				</div>
				<div class="media">
				<div class="media-left media-middle">
				<div class="icon">
					<i class="fa fa-phone"></i>
				</div>
				</div>
				<div class="media-body media-middle">
				<p><?= $row_website_config->{'phone_'.$lang} ?></p>
				</div>
				</div>
				<div class="media">
					<div class="media-left">
						<div class="icon">
							<i class="fa fa-envelope"></i>
						</div>
					</div>
					<div class="media-body media-middle">
						<p><?= $row_website_config->{'email_address'} ?></p>
					</div>
				</div>
				</div>
				</div>
					<ul class="social">
						<li>
							<a href="<?= $social['fb'] ?>" target="_blank" class="facebook">
								<i class="fa fa-facebook "></i>
							</a>
						</li>
						<li>
							<a href="<?= $social['u_tube'] ?>" target="_blank" class="youtube">
								<i class="fa fa-youtube "></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	<style>
		.form_contact > div, .contact_info > div{
			background: #F0F9FB;
		}
		.form_contact *{
			border-radius: 0px;
		}
		.form_contact .form-control, .form-control input[type="submit"]{
			padding-top: 25px!important;
			padding-bottom: 25px!important;
			border: 1px solid #eee;
		}
		.icon i{
			font-size: 20px;
		}
	</style>
	<br><br>
<?php include_once('layout/footer.php') ?>