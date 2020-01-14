<?php 
	function backup_mysqldump($host_name,$user_name,$password,$database,$mysqldump,$isHosted=false)
	{
        $v_path_store="../../database/backup/"; 
        makeNewDir($v_path_store,date('Y')); $v_path_store.='/'.date('Y');
        makeNewDir($v_path_store,date('m')); $v_path_store.='/'.date('m');
        makeNewDir($v_path_store,date('d')); $v_path_store.='/'.date('d');
        $v_path_store.="/db_backup_".date('Ymd_H').'.sql'.($isHosted?'.bz2':'');
        
        $v_cmd=$mysqldump.' -u '.$user_name.' -p'.$password.' '.$database.' '.($isHosted?'| bzip2':'').' > '.$v_path_store;
		if(!file_exists($v_path_store)) shell_exec($v_cmd);
	}

	function makeNewDir($path,$dir_name)
	{
		if(!file_exists($path.'/'.$dir_name)) mkdir($path.'/'.$dir_name, 0777, true);
	}
 ?>