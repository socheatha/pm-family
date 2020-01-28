<?php 
    // get website config layout
    $get_website_config = $connect->query("SELECT * FROM tbl_website_config");
    $row_website_config = mysqli_fetch_object($get_website_config);

    $social['fb'] = 'https://web.facebook.com/pmfamilyrealtyandinvestment/';
    $social['u_tube'] = 'https://www.youtube.com/channel/UCQ28cp5FBnMIPyRHmD9MwDA'; 
    $social['twitter'] = 'https://twitter.com/PMFAMILYREALTY1'; 
    $social['linkedin'] = 'https://www.linkedin.com/in/p-m%E2%80%8B-family-6b0a3919a'; 

    require_once('function/date.php');
	$CustomDate = new CustomDate();
?>  