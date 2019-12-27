<?php 
    $menu_active =49;
    $layout_title = "Welcome Dashboard";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header_frame.php';
?>


<?php 
	if(@$_GET['del_id'] != ""){
		$del_id = @$_GET['del_id'];
		$connect->query("DELETE FROM tbl_project_images WHERE id='$del_id'");
	}
	if(@$_GET['del_img'] != ""){
		$del_img = @$_GET['del_img'];
		if(file_exists("../../img/project/".$del_img)){
			unlink("../../img/project/".$del_img);
		}
	}
	if(@$_GET['parent_id']){
		$parent_id = @$_GET['parent_id'];
	}
?>
<input type="text" id="parent_id" value="<?= $parent_id ?>">
<script type="text/javascript">
	window.location.replace("index.php?parent_id="+document.getElementById('parent_id').value);
</script>