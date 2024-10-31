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
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span>@lang('translation.dashboards')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link">@lang('translation.analytics')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link">@lang('translation.crm')</a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link">@lang('translation.ecommerce')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link">@lang('translation.crypto')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link">@lang('translation.projects')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link">@lang('translation.nft')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-job" class="nav-link"><span>@lang('translation.job')</span>
                                    <span class="badge badge-pill bg-success">@lang('translation.new')</span></a>
                            </li>
                        </ul>
                    </div>
                </li> end Dashboard Menu -->

                <!-- Campus Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCampus" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCampus">
                        <i class="mdi mdi-school"></i> <span>@lang('Campus')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCampus">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('campus.index') }}" class="nav-link">@lang('Show Capmus')</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- end Campus Menu -->
                <!-- Sections Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSections" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSections">
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
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSubjects" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSubjects">
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
                <!-- end Subjects Menu -->

                <!-- Teacher Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTeacher" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTeacher">
                        <!-- Teacher Icon -->

                        <i class="mdi mdi-account-plus-outline"></i>
                        <span>@lang('Teachers')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTeacher">
                        <ul class="nav nav-sm flex-column">
                            <!-- Show Teachers Link -->
                            <li class="nav-item">
                                <a href="{{ route('teacher.index') }}" class="nav-link">
                                    <i class="mdi mdi-account-multiple-outline"></i> <!-- List Icon -->
                                    @lang('Show Teachers')
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
                        <span>@lang('Users')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <!-- Show Users Link -->
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="mdi mdi-account-multiple-outline"></i> <!-- List Icon -->
                                    @lang('Show Users')
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
                        <span>@lang('Teacher Evaluations')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEvaluation">
                        <ul class="nav nav-sm flex-column">
                            <!-- Show Evaluations Link -->
                            <li class="nav-item">
                                <a href="{{ route('evaluation.index') }}" class="nav-link">
                                    <i class="mdi mdi-clipboard-text-outline"></i> <!-- List Icon for evaluations -->
                                    @lang('View Evaluations 1-7')
                                </a>
                            </li>
                            <!-- Add New Evaluation Link -->
                            <li class="nav-item">
                                <a href="{{ route('seniorevaluation.index') }}" class="nav-link">
                                    <i class="mdi mdi-clipboard-plus-outline"></i> <!-- Add Icon for evaluations -->
                                    @lang('View Evaluation 8-10')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.index') }}" class="nav-link">
                                    <i class="mdi mdi-clipboard-plus-outline"></i> <!-- Add Icon for evaluations -->
                                    @lang('View Nazra Report')
                                </a>
                            </li>
                            <!-- Add more links if necessary for additional evaluation-related actions -->
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarRoles">
                        <!-- Roles Icon (certificate icon for roles management) -->
                        <i class="mdi mdi-account-key-outline"></i>
                        <span>@lang('Roles Management')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoles">
                        <ul class="nav nav-sm flex-column">
                            <!-- View All Roles Link -->
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="mdi mdi-file-document-outline"></i>
                                    <!-- Icon representing listing of roles -->
                                    @lang('View All Roles')
                                </a>
                            </li>
                            <!-- Add New Role Link -->
                            <li class="nav-item">
                                <a href="{{ route('roles.assignPermissionsForm') }}" class="nav-link">
                                    <i class="mdi mdi-file-key-outline"></i>
                                    <!-- Icon representing assigning permissions -->
                                    @lang('Assign Permissions to Role')
                                </a>
                            </li>


                            <!-- Add more links if necessary for additional role-related actions -->
                        </ul>
                    </div>
                </li>
                {{-- for permissions --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPermissions" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarPermissions">
                        <!-- Permissions Icon -->
                        <i class="mdi mdi-file-certificate-outline"></i>
                        <span>@lang('Permissions')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermissions">
                        <ul class="nav nav-sm flex-column">
                            <!-- View All Permissions Link -->
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="mdi mdi-file-document-outline"></i>
                                    <!-- Icon representing listing of permissions -->
                                    @lang('View All Permissions')
                                </a>
                            </li>
                            <!-- Add New Permission Link -->

                            <!-- Add more links if necessary for additional permission-related actions -->
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
