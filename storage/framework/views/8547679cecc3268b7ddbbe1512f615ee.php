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


                <!-- Campus Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('campus.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCampus">
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
                <!-- Sections Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('sections.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarSections">
                        <i class="mdi mdi-view-grid-outline"></i> <span><?php echo app('translator')->get('Sections'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSections">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('sections.index')); ?>" class="nav-link"><?php echo app('translator')->get('Show Sections'); ?></a>
                            </li>

                        </ul>
                    </div>
                </li>
                <!-- end Sections Menu -->

                <!-- Subjects Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('subjects.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarSubjects">
                        <i class="mdi mdi-book-open-variant"></i> <span><?php echo app('translator')->get('Subjects'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSubjects">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('subjects.index')); ?>" class="nav-link"><?php echo app('translator')->get('Show Subjects'); ?></a>
                            </li>

                        </ul>
                    </div>
                </li>
                <!-- end Subjects Menu -->

                <!-- Teacher Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('teacher.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarTeacher">
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
                    <a class="nav-link menu-link" href="<?php echo e(route('user.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarUser">
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

             <!-- Evaluation Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="<?php echo e(route('evaluation.index')); ?>">
        <i class="mdi mdi-clipboard-outline"></i>
        <span><?php echo app('translator')->get('Teacher Evaluations'); ?></span>
        <i class="mdi mdi-chevron-down toggle-icon" data-bs-toggle="collapse" data-bs-target="#sidebarEvaluation"></i>
    </a>
    <div class="collapse menu-dropdown" id="sidebarEvaluation">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="<?php echo e(route('evaluation.index')); ?>" class="nav-link">
                    <i class="mdi mdi-clipboard-text-outline"></i> 
                    <?php echo app('translator')->get('View Evaluations 1-7'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('seniorevaluation.index')); ?>" class="nav-link">
                    <i class="mdi mdi-clipboard-plus-outline"></i> 
                    <?php echo app('translator')->get('View Evaluation 8-10'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('report.index')); ?>" class="nav-link">
                    <i class="mdi mdi-clipboard-plus-outline"></i> 
                    <?php echo app('translator')->get('View Nazra Report'); ?>
                </a>
            </li>
        </ul>
    </div>
</li>



                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('roles.index')); ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarRoles">
                        <!-- Roles Icon (certificate icon for roles management) -->
                        <i class="mdi mdi-account-key-outline"></i>
                        <span><?php echo app('translator')->get('Roles Management'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoles">
                        <ul class="nav nav-sm flex-column">
                            <!-- View All Roles Link -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('roles.index')); ?>" class="nav-link">
                                    <i class="mdi mdi-file-document-outline"></i>
                                    <!-- Icon representing listing of roles -->
                                    <?php echo app('translator')->get('View All Roles'); ?>
                                </a>
                            </li>
                            <!-- Add New Role Link -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('roles.assignPermissionsForm')); ?>" class="nav-link">
                                    <i class="mdi mdi-file-key-outline"></i>
                                    <!-- Icon representing assigning permissions -->
                                    <?php echo app('translator')->get('Assign Permissions to Role'); ?>
                                </a>
                            </li>


                            <!-- Add more links if necessary for additional role-related actions -->
                        </ul>
                    </div>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('permissions.index')); ?>" role="button">
                        <i class="mdi mdi-file-certificate-outline"></i> 
                        <span><?php echo app('translator')->get('permissions'); ?></span>
                        <i class="mdi mdi-chevron-down toggle-icon" data-bs-toggle="collapse" data-bs-target="#sidebarPermissions"></i>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermissions">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('permissions.index')); ?>" class="nav-link"><?php echo app('translator')->get('Show Permissions'); ?></a>
                            </li>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-icon').forEach(function (toggleIcon) {
        toggleIcon.addEventListener('click', function (event) {
            event.preventDefault();
            const targetId = toggleIcon.getAttribute('data-bs-target');
            const targetElement = document.querySelector(targetId);
            if (targetElement.classList.contains('show')) {
                targetElement.classList.remove('show');
            } else {
                targetElement.classList.add('show');
            }
        });
    });
});

</script>
<?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>