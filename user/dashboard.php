<!DOCTYPE html>
<html>
<head>
    <?php require_once('../head_src.php'); 
        $active = '';
        if(!empty($_GET['active'])){
            $active = $_GET['active'];
        }
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
            require_once('../admin/system_nav.php');
			
            $training_course_info = $User->get_training_course_info($_SESSION['Training_Course_ID']);
        ?>
        <div class="content-wrapper">
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="panel panel-default">
							<div class="panel-heading">
								<h4>Current Training Course Involved</h4>
							</div>
                            <div class="panel-body">
                                <?php require_once('dashboard_course.php'); ?>
								<br/><br/>
								<?php require_once('dashboard_announcement.php'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($_SESSION['User_Type'] == 'TR'): ?>
                        <div class="col-lg-2">
                            <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#make_announcement_modal">Make Announcement</button>
                        </div>

                        <div class="modal fade" id="make_announcement_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Make New Announcement</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                <?php
                                                    $error = [];
                                                    if(isset($_POST['submit_btn'])){ 
                                                        $error = $User->add_new_announcement();
                                                    }
                                                ?>
                                                    <div class="form-group" <?= form_error('title', $error, TRUE); ?>>
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" name="title">
                                                        <?= form_error('title', $error); ?>
                                                    </div>

                                                    <div class="form-group" <?= form_error('description', $error, TRUE); ?>>
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description" rows="5"></textarea>
                                                        <?= form_error('description', $error); ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Assignment</label>
                                                        <input type="file" class="form-control" name="assignment">
                                                    </div>

                                                    <span class="pull-right">
                                                        <button type="submit" class="btn btn-success btn-flat" name="submit_btn">Submit</button>
                                                    </span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
    <?php if(!empty($error)): ?>
        $('#make_announcement_modal').modal('show');
    <?php endif; ?>
});
</script>
<? ob_flush() ?>