<?php require_once('Admin.php'); ?>

<header class="main-header">

    <a href="#" class="logo">
        <span class="logo-lg"><b>FUXION ETMS</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                <!-- notification -->
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="../index.php?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
			 <li>
                <a href="profile.php"><i class="fa fa-user fa-fw"></i> <span>My Profile</span></a>
            </li>
		
			<li>
                <a href="training_course.php"><i class="fa fa-user fa-fw"></i> <span>Manage Training Courses</span></a>
            </li>
			
            <li>
                <a href="user.php"><i class="fa fa-user fa-fw"></i> <span>Manage User</span></a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i> <span>Trainee Request Details</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="assign_trainee.php"><i class="fa fa-circle-o"></i>Assign Training Courses</a>
                    </li>
                    <li>
                        <a href="response_request.php"><i class="fa fa-circle-o"></i>Requested List</a>
                    </li>
					<li>
                        <a href="form_request.php"><i class="fa fa-circle-o"></i>Request Form</a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i> <span>Training Feedback</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="response_feedback.php"><i class="fa fa-circle-o"></i>Feedback List</a>
                    </li>
                    <li>
                        <a href="feedback_form.php"><i class="fa fa-circle-o"></i> Feedback Form</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears fa-fw"></i> <span>Manage Venue</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="setting_venue_n_room.php">Venue Setting</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
<?php// require_once('../modal_box.php'); ?>