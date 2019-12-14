<?php 
    // get website config layout
    $get_website_config = $connect->query("SELECT * FROM tbl_website_config");
    $row_website_config = mysqli_fetch_object($get_website_config);
?>  