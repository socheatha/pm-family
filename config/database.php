<?php
	$isHosted = true;
	if($isHosted){
		$servername = "184.154.104.106";
		$username = "pm_family";
		$password = "5)P?@cvQp7#F";
		$database = "pm_family";
		$mysqldump = "/usr/bin/mysqldump";
	}else{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "pm_family";
		$mysqldump = "/Applications/MAMP/Library/bin/mysqldump";
	}

	// Create connection
	$connect = mysqli_connect($servername, $username, $password, $database);

	// Check connection
	if (!$connect) die("Connection failed: " . mysqli_connect_error());

	mysqli_set_charset($connect,"utf8");
	mysqli_query($connect, "SET SESSION sql_mode = ''");
	session_start();
	ob_start();
	date_default_timezone_set("Asia/Bangkok");
	// language
	if(@$_GET['lang']!=""){ 
		@$_SESSION['language']= @$_GET['lang']; 
		header('location: '.$_SERVER['PHP_SELF']); 
	}
	if(@$_SESSION['language'] != ""){ $lang = @$_SESSION['language']; }else{ $lang = 'kh'; }


	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $base_url = "https://";   
    else  
        $base_url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $base_url.= $_SERVER['HTTP_HOST'];
?>