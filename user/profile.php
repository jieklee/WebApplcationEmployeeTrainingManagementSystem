<!DOCTYPE html>
<html>
<head>
    <?php require_once('../head_src.php'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require_once('../admin/system_nav.php');?>
        <div class="content-wrapper">
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                My Profile 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input readonly type="text" class="form-control" value="<?= $_SESSION['User_Name']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input readonly type="text" class="form-control" value="<?= $_SESSION['User_Email']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input readonly type="text" class="form-control" value="<?= $_SESSION['User_Phone']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <?php
                                                foreach($department as $key => $value):
                                                    if($key == $_SESSION['User_Department']):
                                                        $profile_department = $value;
                                                    endif;
                                                endforeach;
                                            ?>
                                            <input readonly type="text" class="form-control" value="<?= (!empty($_SESSION['User_Department']) ? $profile_department : ''); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <a href="profile_form.php" class="btn btn-default btn-flat">Edit Profile</a>
                                        <button class="btn btn-default btn-flat" data-toggle="modal" data-target="#change_password_modal">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
	
<div class="modal fade" id="change_password_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" method="post">
                        <?php
                            $error = [];
                            if(isset($_POST['change_password_btn'])){
                                $error = $Admin->change_password();

                                echo form_error('error', $error);
                            }
                        ?>
                        <div class="col-lg-12">
                            <div class="form-group <?= form_error('old_password', $error, TRUE); ?>">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" name="old_password">
                                <?= form_error('old_password', $error); ?>
                            </div>

                            <div class="form-group <?= form_error('new_password', $error, TRUE); ?>">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password">
                                <?= form_error('new_password', $error); ?>
                            </div>

                            <div class="form-group <?= form_error('reenter_password', $error, TRUE); ?>">
                                <label>Re-enter Password</label>
                                <input type="password" class="form-control" name="reenter_password">
                                <?= form_error('reenter_password', $error); ?>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-flat" name="change_password_btn">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    <?php if(!empty($error)): ?>
        $('#change_password_modal').modal('show');
    <?php endif; ?>
});
</script>
<? ob_flush(); ?>