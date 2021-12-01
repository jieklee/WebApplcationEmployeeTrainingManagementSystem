<!DOCTYPE html>
<html>
<head>
    <?php require_once('head_src.php'); ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Employee Training Management System</b>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Login</p>
            <form role="form" method="post">
                <fieldset>
                    <?php 
                        $error = [];
                        if(isset($_POST['login_btn'])){
                            $error = $sef->login();
                            
                            echo form_error('error', $error);
                        }else{
                            $sef->check_login();
                        }
                    ?>
                    <div class="col-lg-12">
                        <div class="form-group <?= form_error('username', $error, TRUE); ?>">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username"/>
                            <?= form_error('username', $error); ?>
                        </div>
                        <div class="form-group <?= form_error('password', $error, TRUE); ?>">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password"/>
                            <?= form_error('password', $error); ?>
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary btn-flat" name="login_btn">Login</button>
                    </div>
                </fieldset>
            </form>

            <div class="text-center">
                <br>
            </div>
        </div>
    </div>
</body>
</html>
<? ob_flush(); ?>