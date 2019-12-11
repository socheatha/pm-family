<?php 
    $menu_active =1887;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>  
<?php 
    if(@$_SESSION['link_model_id']) unset($_SESSION['link_model_id']);
?>
<div class="portlet light bordered">
    <div class="portlet-body">
        <img src="../../img/img_system/product_model_and_problem.png" class="img-responsive img-thumbnail" width="100%" alt="Image">
    </div>
</div>
<?php include_once '../layout/footer.php' ?>