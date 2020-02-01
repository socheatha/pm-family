<?php 
	$APP_TITLE = "Contact Us";
	include_once('layout/header.php') 
?>
<br><br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3909.490550926209!2d104.77139531434194!3d11.516626248244457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31094fd87d628643%3A0x7c04b515d0624d73!2sP.M%20Family%20Realty%20%26%20Investment!5e0!3m2!1sen!2skh!4v1579180671279!5m2!1sen!2skh" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
<br><br><br><br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 form_contact">
		<div class="form-contact">
			<h3 class="title"><?= $lang_text['ct_message_title'][$lang]  ?></h3>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="<?= $lang_text['ct_name'][$lang]  ?>"></span>
				</div>
				<div class="col-xs-12 col-sm-6">
					<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email form-control" id="Email" aria-invalid="false" placeholder="<?= $lang_text['ct_email'][$lang]  ?>"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="wpcf7-form-control-wrap tel-72"><input type="tel" name="tel-72" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel form-control" aria-required="true" aria-invalid="false" placeholder="<?= $lang_text['ct_phone'][$lang]  ?>"></span>
				</div>
				<div class="col-xs-12 col-sm-6">
					<span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text form-control" id="contact-subject" aria-invalid="false" placeholder="<?= $lang_text['ct_subject'][$lang]  ?>"></span>
				</div>
			</div>
			<p><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-control" aria-invalid="false" placeholder="<?= $lang_text['ct_message'][$lang]  ?>"></textarea></span></p>
			<div style="margin-bottom: 20px;">
				<div class="wpcf7-form-control-wrap">
					<div data-sitekey="6LfwCawUAAAAACKWxdyqVQyVCoqIdde804bD8S9J" class="wpcf7-form-control g-recaptcha wpcf7-recaptcha">
						<div style="width: 304px; height: 78px;">
							<div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfwCawUAAAAACKWxdyqVQyVCoqIdde804bD8S9J&amp;co=aHR0cHM6Ly9ib3JleXBlbmdodW90aC5jb206NDQz&amp;hl=en&amp;v=mhgGrlTs_PbFQOW4ejlxlxZn&amp;size=normal&amp;cb=gle9u3auiol" width="304" height="78" role="presentation" name="a-otwqksizy4ds" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
						</div>
					</div>
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
			<p><input type="submit" value="<?= $lang_text['ct_sent_button'][$lang]  ?>" class="wpcf7-submit btn btn-submit btn-submit-kh"><span class="ajax-loader"></span></p>
		</div>
		<br>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 contact_info">
		<div class="widget-information-box ">
			<h3 class="title">
				<span><?= $lang_text['ct_our_info'][$lang]  ?></span>
			</h3>
			<div class="description">
				<div class="space-30"></div>
				<div class="information-footer">
					<table>
						<tr style="font-size: 15px;">
							<td width="25px" class="text-center"><i class="fa fa-map-marker fa-fw" style="font-size: 20px;"></i></td>
							<td>
								<?= $row_website_config->{'address_line_1_'.$lang} ?>
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
			<ul class="social">
				<li>
					<a href="<?= $social['fb'] ?>" target="_blank" class="facebook">
						&nbsp;&nbsp;<i class="fa fa-facebook "></i>
					</a>
				</li>
				<li>
					<a href="<?= $social['u_tube'] ?>" target="_blank" class="youtube">
						<i class="fa fa-youtube "></i>
					</a>
				</li>
				<li>
					<a href="<?= $social['u_tube'] ?>" target="_blank" class="youtube">
						<i class="fa fa-twitter "></i>
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
	.form_contact>div,
	.contact_info>div {
		background: #F0F9FB;
	}

	.form_contact * {
		border-radius: 0px;
	}

	.form_contact .form-control,
	.form-control input[type="submit"] {
		padding-top: 25px !important;
		padding-bottom: 25px !important;
		border: 1px solid #eee;
	}

	.icon i {
		font-size: 20px;
	}
</style>
<br><br>
<?php include_once('layout/footer.php') ?>