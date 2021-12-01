<!DOCTYPE html>
<html>
<head>
    <?php require_once('../head_src.php'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require_once('system_nav.php');?>
        <div class="content-wrapper">
            <section class="content container-fluid">                
                <div class="row">
                    <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
								Feedback Form
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form role="form" method="post">
                                        <?php
                                            $error = [];
                                            if(isset($_POST['submit_btn'])){
                                                $error = $Admin->submit_feedback();
                                            }
                                        ?>

                                        <div class="col-lg-12">
                                            <div class="form-group <?= form_error('title', $error, TRUE); ?>">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" name="title" maxlength="100" value="<?= @$error['title']; ?>">
                                                <?= form_error('title', $error); ?>
                                            </div>

                                            <div class="form-group <?= form_error('description', $error, TRUE); ?>">
                                                <label for="title">Description</label>
                                                <textarea class="form-control" name="description" cols="30" rows="5" maxlength="500"><?= @$error['description']; ?></textarea>
                                                <?= form_error('description', $error); ?>
                                            </div>

                                            <span class="pull-right">
                                                <button type="submit" class="btn btn-success btn-flat" name="submit_btn">Submit</button>
                                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                            </span>
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
<? ob_flush(); ?>