<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>

                <!-- Dashboard Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link"><?php echo app('translator')->get('translation.analytics'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link"><?php echo app('translator')->get('translation.crm'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link"><?php echo app('translator')->get('translation.ecommerce'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link"><?php echo app('translator')->get('translation.crypto'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link"><?php echo app('translator')->get('translation.projects'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link"><?php echo app('translator')->get('translation.nft'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-job" class="nav-link"><span><?php echo app('translator')->get('translation.job'); ?></span>
                                    <span class="badge badge-pill bg-success"><?php echo app('translator')->get('translation.new'); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li> end Dashboard Menu -->

                <!-- Campus Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCampus" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCampus">
                        <i class="mdi mdi-school"></i> <span><?php echo app('translator')->get('Campus'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCampus">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('campus.index')); ?>" class="nav-link"><?php echo app('translator')->get('Show Capmus'); ?></a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- end Campus Menu -->
                <!-- Teacher Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTeacher" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTeacher">
                        <!-- Teacher Icon -->

                        <i class="mdi mdi-account-plus-outline"></i>
                        <span><?php echo app('translator')->get('Teachers'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTeacher">
                        <ul class="nav nav-sm flex-column">
                            <!-- Show Teachers Link -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('teacher.index')); ?>" class="nav-link">
                                    <i class="mdi mdi-account-multiple-outline"></i> <!-- List Icon -->
                                    <?php echo app('translator')->get('Show Teachers'); ?>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <!-- end Teacher Menu -->
                 <!-- Users Menu -->
                 <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarUser">
                        <!-- User Icon -->
                        <i class="mdi mdi-account-outline"></i>
                        <span><?php echo app('translator')->get('Users'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <!-- Show Users Link -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('user.index')); ?>" class="nav-link">
                                    <i class="mdi mdi-account-multiple-outline"></i> <!-- List Icon -->
                                    <?php echo app('translator')->get('Show Users'); ?>
                                </a>
                            </li>
                            <!-- Add more links for user-specific actions if necessary -->
                        </ul>
                    </div>
                </li>
                

                <!-- end Users Menu -->

                <!-- Evaluation Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarEvaluation" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarEvaluation">
        <!-- Evaluation Icon (e.g., clipboard outline) -->
        <i class="mdi mdi-clipboard-outline"></i>
        <span><?php echo app('translator')->get('Teacher Evaluations'); ?></span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarEvaluation">
        <ul class="nav nav-sm flex-column">
            <!-- Show Evaluations Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('evaluation.index')); ?>" class="nav-link">
                    <i class="mdi mdi-clipboard-text-outline"></i> <!-- List Icon for evaluations -->
                    <?php echo app('translator')->get('View Evaluations 1-7'); ?>
                </a>
            </li>
            <!-- Add New Evaluation Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('seniorevaluation.index')); ?>" class="nav-link">
                    <i class="mdi mdi-clipboard-plus-outline"></i> <!-- Add Icon for evaluations -->
                    <?php echo app('translator')->get('View Evaluation 8-10'); ?>
                </a>
            </li>
            <!-- Add more links if necessary for additional evaluation-related actions -->
        </ul>
    </div>
</li>
<!-- end Evaluation Menu -->
<li class="nav-item"> 
    <a class="nav-link menu-link" href="#sidebarReportCard" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarReportCard">
        <!-- Report Card Icon (certificate icon for report cards) -->
        <i class="mdi mdi-file-certificate-outline"></i>
        <span><?php echo app('translator')->get('Report Cards'); ?></span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarReportCard">
        <ul class="nav nav-sm flex-column">
            <!-- View All Report Cards Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('report.index')); ?>" class="nav-link">
                    <i class="mdi mdi-file-document-outline"></i> <!-- Icon representing listing of documents -->
                    <?php echo app('translator')->get('View All Report Cards'); ?>
                </a>
            </li>
            <!-- Add New Report Card Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('report.create')); ?>" class="nav-link">
                    <i class="mdi mdi-file-plus-outline"></i> <!-- Icon representing adding a new document -->
                    <?php echo app('translator')->get('Add New Report Card'); ?>
                </a>
            </li>
            <!-- Add more links if necessary for additional report-related actions -->
        </ul>
    </div>
</li>
<!-- end Evaluation Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
        aria-expanded="false" aria-controls="sidebarRoles">
        <!-- Roles Icon (certificate icon for roles management) -->
        <i class="mdi mdi-account-key-outline"></i>
        <span><?php echo app('translator')->get('Roles Management'); ?></span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarRoles">
        <ul class="nav nav-sm flex-column">
            <!-- View All Roles Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('roles.index')); ?>" class="nav-link">
                    <i class="mdi mdi-file-document-outline"></i> <!-- Icon representing listing of roles -->
                    <?php echo app('translator')->get('View All Roles'); ?>
                </a>
            </li>
            <!-- Add New Role Link -->
            <li class="nav-item">
                <a href="<?php echo e(route('roles.create')); ?>" class="nav-link">
                    <i class="mdi mdi-file-plus-outline"></i> <!-- Icon representing adding a new role -->
                    <?php echo app('translator')->get('Add New Role'); ?>
                </a>
            </li>
            <!-- Add more links if necessary for additional role-related actions -->
        </ul>
    </div>
</li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>