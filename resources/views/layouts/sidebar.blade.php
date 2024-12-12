<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                {{-- <img src="{{ URL::asset('build/images/school.jpeg') }}" alt="" height="45"  width="40"> --}}
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
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
                <li class="menu-title"><span>@lang('translation.menu')</span></li>

                <!-- Dashboard Menu -->


                <!-- Campus Menu -->
              <!-- Campus Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarCampus"
        role="button" aria-expanded="false" aria-controls="sidebarCampus">
        <i class="mdi mdi-school"></i> <span>@lang('Campus')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarCampus">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('campus.index') }}" class="nav-link">@lang('Show Campus')</a>
            </li>
        </ul>
    </div>
</li>


                <!-- end Campus Menu -->
                <!-- Sections Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarSections"
                        role="button" aria-expanded="false" aria-controls="sidebarSections">
                        <i class="mdi mdi-view-grid-outline"></i> <span>@lang('Sections')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSections">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('sections.index') }}" class="nav-link">@lang('Show Sections')</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- end Sections Menu -->

                <!-- Subjects Menu -->
            <!-- Subjects Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarSubjects"
        role="button" aria-expanded="false" aria-controls="sidebarSubjects">
        <i class="mdi mdi-book-open-variant"></i> <span>@lang('Subjects')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarSubjects">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('subjects.index') }}" class="nav-link">@lang('Show Subjects')</a>
            </li>
        </ul>
    </div>
</li>
<!-- End Subjects Menu -->

<!-- Teacher Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarTeacher"
        role="button" aria-expanded="false" aria-controls="sidebarTeacher">
        <i class="mdi mdi-account-plus-outline"></i> <span>@lang('Teachers')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarTeacher">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('teacher.index') }}" class="nav-link">
                    <i class="mdi mdi-account-multiple-outline"></i> @lang('Show Teachers')
                </a>
            </li>
        </ul>
    </div>
</li>
<!-- End Teacher Menu -->

<!-- Users Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarUser"
        role="button" aria-expanded="false" aria-controls="sidebarUser">
        <i class="mdi mdi-account-outline"></i> <span>@lang('Users')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarUser">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="mdi mdi-account-multiple-outline"></i> @lang('Show Users')
                </a>
            </li>
        </ul>
    </div>
</li>
<!-- End Users Menu -->

<!-- Evaluation Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarEvaluation"
        role="button" aria-expanded="false" aria-controls="sidebarEvaluation">
        <i class="mdi mdi-clipboard-outline"></i> <span>@lang('Teacher Evaluations')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarEvaluation">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('evaluation.index') }}" class="nav-link">
                    <i class="mdi mdi-clipboard-text-outline"></i> @lang('View Evaluations 1-7')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('seniorevaluation.index') }}" class="nav-link">
                    <i class="mdi mdi-clipboard-plus-outline"></i> @lang('View Evaluation 8-10')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('report.index') }}" class="nav-link">
                    <i class="mdi mdi-clipboard-plus-outline"></i> @lang('View Nazra Report')
                </a>
            </li>
        </ul>
    </div>
</li>
<!-- End Evaluation Menu -->

<!-- Roles Management Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarRoles"
        role="button" aria-expanded="false" aria-controls="sidebarRoles">
        <i class="mdi mdi-account-key-outline"></i> <span>@lang('Roles Management')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarRoles">
        <ul class="nav nav-sm flex-column">
            <!-- View All Roles Link -->
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="mdi mdi-file-document-outline"></i> @lang('View All Roles')
                </a>
            </li>
            <!-- Assign Permissions to Role Link -->
            <li class="nav-item">
                <a href="{{ route('roles.assignPermissionsForm') }}" class="nav-link">
                    <i class="mdi mdi-file-key-outline"></i> @lang('Assign Permissions to Role')
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Permissions Menu -->
<li class="nav-item">
    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarPermissions"
        role="button" aria-expanded="false" aria-controls="sidebarPermissions">
        <i class="mdi mdi-file-certificate-outline"></i> <span>@lang('Permissions')</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarPermissions">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="mdi mdi-shield-key-outline"></i> @lang('Show Permissions')
                </a>
            </li>
        </ul>
    </div>
</li>

                {{-- end permissions --}}
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-icon').forEach(function(toggleIcon) {
            toggleIcon.addEventListener('click', function(event) {
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
