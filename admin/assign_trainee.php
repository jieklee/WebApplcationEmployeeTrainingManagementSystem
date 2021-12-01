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
            require_once('system_nav.php');
            if(!empty($_GET['Training_Course_ID'])){
                $assigned_training_course_info = $Admin->get_assigned_training_course_info($_GET['Training_Course_ID']);
            }
        ?>
        <div class="content-wrapper">
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="<?= (empty($active) && empty($error) ? 'active' : ''); ?>">
                                        <a href="#assigned_training_course_list" data-toggle="tab">Assigned Training Courses List</a>
                                    </li>
                                    <li class="<?= ($active == '2' ? 'active' : ''); ?>">
                                        <a href="assign_trainee.php?active=2">Assign Training Courses</a>
                                    </li>
                                    <?php if($active == '3'): ?>
                                        <li class="active">
                                            <a href="#edit_assigned_training_course" data-toggle="tab"><?= $assigned_training_course_info['Training_Course_Name']; ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane <?= (empty($active) && empty($error) ? 'active' : ''); ?>" id="assigned_training_course_list">
                                        <?php require_once('assigned_training_course_list.php'); ?>
                                    </div>
                                    <?php if($active == '2'): ?>
                                        <div class="tab-pane active">
                                            <?php require_once('assign_trainee_to_course.php'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($active == '3'): ?>
                                        <div class="tab-pane active" id="edit_assigned_training_course">
                                            <?php require_once('edit_assigned_training_course.php'); ?>
                                        </div>
                                    <?php endif; ?>
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
<? ob_flush() ?>