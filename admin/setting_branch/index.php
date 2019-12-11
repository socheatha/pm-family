<?php 
    $menu_active =10;
    $layout_title = "Welcome to Website";
    include_once '../../config/database.php';
    include_once '../../config/athonication.php';
    include_once '../layout/header.php';
?>
<?php 
    if(isset($_POST["btnadd"])){
        $v_name = $_POST["txtname"];
        $v_note = $_POST["txtnote"];

        $sql = "INSERT INTO tbl_pos_branch 
                    (bra_name,bra_note) 
                  VALUES 
                    ('$v_name', '$v_note')";
        $result = mysqli_query($connect, $sql);
        echo '<script> window.location.replace("index.php"); </script>';
    }

    if(isset($_GET["del_id"])){
        $id = $_GET["del_id"];
          
        $sql = "DELETE FROM tbl_pos_branch WHERE bra_id = '$id'" ;
        $result = mysqli_query($connect, $sql);
        echo '<script> window.location.replace("index.php"); </script>';
    } 
?>

<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i> Branch Administrator</h2>
        </div>
    </div>
    <br>
    <br>
    <div class="portlet-title">
        <div class="caption font-dark">
            <a  data-toggle="modal" data-target="#myModal" id="sample_editable_1_new" class="btn green"> Add New
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="sample_2" role="grid" aria-describedby="sample_1_info" style="width: 1180px;">
               <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Branch</th>
                        <th>Note</th>
                       <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>                                 
                    <?php 
                        $i = 0;

                        $get_data = $connect->query("SELECT * FROM tbl_pos_branch");
                        while ($row = mysqli_fetch_object($get_data)) {
                            echo '<tr>';
                                echo '<td>'.(++$i).'</td>';
                                echo '<td>'.$row->bra_name.'</td>';
                                echo '<td>'.$row->bra_note.'</td>';
                                echo '<td class="text-center">';
                                    echo '<a href="edit.php?edit_id='.$row->bra_id.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a> ';
                                    echo '<a href="index.php?del_id='.$row->bra_id.'" onclick="return confirm(\'Are you sure to delete this?\')" class="btn btn-xs btn-danger" title="delete"><i class="fa fa-trash"></i></a> ';
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Add New </h4>
              </div>
              <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="">  
                        <label for ="">Branch Name:</label>                                          
                        <input class="form-control" required autocomplete="off"  name="txtname" type="text" placeholder="Name..">          
                        <br>
                        <label for="note">Note:</label>
                        <textarea class="form-control" rows="4" id="note" name = "txtnote"></textarea>
                        <br>
                        <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>
                </div>
          </div>
    </div>
</div>
