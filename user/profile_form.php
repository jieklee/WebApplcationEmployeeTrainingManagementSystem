<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../head_src.php'); ?>    
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require_once('user_nav.php'); ?>
        <div class="content-wrapper">
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Profile Form
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form role="form" method="post">
                                        <?php
                                            $error = [];
                                            if(isset($_POST['save_btn'])){
                                                $error = $User->edit_profile();

                                                echo form_error('error', $error);
                                            }
                                        ?>

                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input readonly type="text" class="form-control" value="<?= $_SESSION['User_Name']; ?>"/>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <label>User Email</label>
                                            <div class="form-group">
                                                <input readonly type="text" class="form-control" value="<?= $_SESSION['User_Email']; ?>"/>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group <?= form_error('user_phone_number', $error, TRUE); ?>">
                                                <label for="user_phone_number">Phone Number</label>
                                                <input type="text" class="form-control" name="user_phone_number" minlength="10" maxlength="11" onkeypress="return number_input(event);" value="<?= $_SESSION['User_Phone']; ?>"/>
                                                <?= form_error('user_phone_number', $error); ?>
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
                                            <div class="form-group <?= form_error('password', $error, TRUE); ?>">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password">
                                                <?= form_error('password', $error); ?>
                                            </div>
                                            <p class="help-block">
                                                Enter password to edit your profile.
                                            </p>
                                        </div>

                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-success btn-flat" name="save_btn">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<script>
function number_input(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
</script>
<? ob_flush(); ?>