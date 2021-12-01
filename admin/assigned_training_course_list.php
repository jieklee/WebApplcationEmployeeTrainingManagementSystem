<?php $assigned_training_course_list = $Admin->get_assigned_training_course_list(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="assigned_training_course_dtb">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Training Courses Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($assigned_training_course_list as $key => $value): ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['Training_Course_Name']; ?></td>
                                <td>
                                    <a href="assign_trainee.php?active=3&Training_Course_ID=<?= $value['Training_Course_ID']; ?>" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit fa-fw"></i></a>
                                   <?php if($_SESSION['User_Type'] == ROLE_ADMIN){?>
								   <a href="AdminAJAX.php?action=delete_assigned_training_course&Training_Course_ID=<?= $value['Training_Course_ID']; ?>" class="btn btn-xs btn-danger" title="Delete" onclick="return delete_training_course();"><i class="fa fa-trash-o fa-fw"></i></a>
								   <?php } ?>
								</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function delete_training_course(){
    return window.confirm("Delete ?")
}
</script>