<?php 
    $dir    = '/home/bsssolution/posila.bsssolution.com/sonthormuk/database';
    $files = scandir($dir,1);
    $name = $files[2];
    $path =  "http://espackaging-group.com/cron/receiver.php?name=".$name;
    echo date('Y-m-d H:i:s').' ==> '.$path;
    // header('location:$path');
?>
<hmtl>
    <head>
        <title>Cron Sync Data</title>
    </head>
    <body>
        <iframe src="<?php echo $path ?>"/>
    </body>
</hmtl>
