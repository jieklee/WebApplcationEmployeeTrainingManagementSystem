<?php require_once('user.php'); ?>

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
                <a href="dashboard.php"><i class="fa fa-user fa-fw"></i> <span>Dashboard</span></a>
            </li>
			<li>
                <a href="form_request.php"><i class="fa fa-user fa-fw"></i> <span>Request Form</span></a>
            </li>
			<li>
                <a href="feedback_form.php"><i class="fa fa-user fa-fw"></i> <span>Feedback Form</span></a>
            </li>
        </ul>
    </section>
</aside>
<?php// require_once('../modal_box.php'); ?>