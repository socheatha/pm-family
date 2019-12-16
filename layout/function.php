<?php 
    // get website config layout
    $get_website_config = $connect->query("SELECT * FROM tbl_website_config");
    $row_website_config = mysqli_fetch_object($get_website_config);

    $social['fb'] = 'https://web.facebook.com/pmfamilyrealtyandinvestment/';
    $social['u_tube'] = 'https://www.youtube.com/channel/UCQ28cp5FBnMIPyRHmD9MwDA'; 
?>  