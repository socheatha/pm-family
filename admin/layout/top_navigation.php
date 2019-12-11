<?php 
    $select = "SELECT * FROM tbl_pos_invoice Order by inv_no desc";
    $query_select = $connect->query($select);
    $sel = $query_select->fetch_array();
    $tt = $query_select->num_rows;
    $no = $sel['transaction_id'];
    $no1 = $sel['inv_no'];
    $finalcode = '';

    if($tt > 0 ){
        $finalcode = $no1 + 1;
    }else{
        $finalcode = $no + 1;
    }
?>
<div class="page-actions">
    <li class="btn-group"><a href="../dashboard/" class="btn red-haze btn-sm <?= (@$menu_active==0)?("active"):("") ?>"><?= $lang_text['dashborad'][$lang] ?></a></li>
    <?php if (@$_SESSION['user']->position_id == 1): ?>
    <li class="btn-group"><a href="../account/" class="btn red-haze btn-sm <?= (@$menu_active==6)?("active"):("") ?>"><?= $lang_text['incomeExpense'][$lang] ?></a></li>
    <?php endif ?>
    <li class="btn-group"><a href="../transaction" class="btn red-haze btn-sm <?= (@$menu_active==9998)?("active"):("") ?>"><?= $lang_text['transaction'][$lang] ?></a></li>
    <li class="btn-group"><a href="../product_model/" class="btn red-haze btn-sm <?= (@$menu_active==1887)?("active"):("") ?>"><?= $lang_text['modelProblem'][$lang] ?></a></li>
    <li class="btn-group"><a href="../product/" class="btn red-haze btn-sm <?= (@$menu_active==2)?("active"):("") ?>"><?= $lang_text['product'][$lang] ?></a></li>
    <li class="btn-group"><a href="../stock_sell/" class="btn red-haze btn-sm <?= (@$menu_active==3)?("active"):("") ?>"><?= $lang_text['stock'][$lang] ?></a></li>
    <li class="btn-group"><a href="../supplier/" class="btn red-haze btn-sm <?= (@$menu_active==4)?("active"):("") ?>"><?= $lang_text['supplier'][$lang] ?></a></li>
    <?php if (@$_SESSION['user']->position_id == 1): ?>
    <li class="btn-group"><a href="../employee/" class="btn red-haze btn-sm <?= (@$menu_active==8)?("active"):("") ?>"><?= $lang_text['employee'][$lang] ?></a></li>
    <li class="btn-group"><a href="../setting/" class="btn red-haze btn-sm <?= (@$menu_active==10)?("active"):("") ?>"><?= $lang_text['setting'][$lang] ?></a></li>
    <li class="btn-group"><a href="../user/" class="btn red-haze btn-sm <?= (@$menu_active==5)?("active"):("") ?>"><?= $lang_text['user'][$lang] ?></a></li>
    <li class="btn-group"><a href="../system/" class="btn red-haze btn-sm <?= (@$menu_active==99)?("active"):("") ?>"><?= $lang_text['help'][$lang] ?></a></li>
    <?php endif ?>
</div>