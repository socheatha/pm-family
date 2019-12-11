<?php 
    $menu_active =5;
    $layout_title = "Welcome to System";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>


<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-user fa-fw"></i><?= $lang_text['userAdministrator'][$lang] ?></h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a href="add.php" id="sample_editable_1_new" class="btn green"> <?= $lang_text['addNew'][$lang] ?>
                <i class="fa fa-plus"></i>
            </a>
                <select name="txt_postition" form="form_search" class="btn red btn-sm" onchange="this.form.submit()">
                    <option value="">==<?= $lang_text['allPosition'][$lang] ?>==</option>
                    <?php 
                        $get_position = $connect->query("SELECT * FROM tbl_pos_position ORDER BY position_id ASC");
                        while ($row_position = mysqli_fetch_object($get_position)) {
                            if($row_position->position_id == @$_GET['txt_postition']){
                                echo '<option SELECTED value="'.$row_position->position_id.'">'.$row_position->position.'</option>';
                                
                            }else{
                                echo '<option value="'.$row_position->position_id.'">'.$row_position->position.'</option>';

                            }
                        }
                    ?>
                </select>
            <form action="" id="form_search" method="get"> </form>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr role="row">
                        <th>N&deg; #</th>
                        <th><?= $lang_text['username'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['password'][$lang] ?></th>
                        <th><?= $lang_text['position'][$lang] ?></th>
                        <th class="text-center"><?= $lang_text['action'][$lang] ?> <i class="fa fa-cog fa-spin"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(@$_GET['txt_postition'] != ""){
                            $v_position = @$_GET['txt_postition'];
                            $user_query = $connect->query("SELECT * FROM  tbl_pos_user AS U LEFT JOIN tbl_pos_position AS P ON U.position_id=P.position_id WHERE U.position_id='$v_position'");
                        }else{
                            $user_query = $connect->query("SELECT * FROM  tbl_pos_user AS U LEFT JOIN tbl_pos_position AS P ON U.position_id=P.position_id");
                        }

                        $no = 0;
                        while ($row_user = mysqli_fetch_object($user_query)) {
                            echo '<tr>';
                                echo "<td>".(++$no)."</td>";
                                echo "<td>$row_user->username</td>";
                                echo "<td class='text-center'>**********</td>";
                                echo "<td>$row_user->position</td>";
                                echo '<td class="text-center">';
                                    echo '<a href="edit.php?edit_id='.$row_user->id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a> '; 
                                    echo '<a href="delete.php?del_id='.$row_user->id.'" onclick="return confirm(\'Are u sure to  delete this user?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a> ';
                                    echo '</td>';
                            echo '</tr>';
                        }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include_once '../layout/footer.php' ?>
