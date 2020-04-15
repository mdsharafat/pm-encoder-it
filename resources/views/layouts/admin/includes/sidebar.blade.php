<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Encoder-IT</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>DASHBOARD</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading"> Users </div>

    @canany(['add-user', 'edit-user', 'view-user', 'delete-user'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>USER</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                @can('add-user')
                    <a class="collapse-item" href="{{ url('/users/create') }}">ADD USER</a>
                @endcan
                @can('view-user')
                    <a class="collapse-item" href="{{ url('/users') }}">MANAGE USER</a>
                @endcan
                </div>
            </div>
        </li>
    @endcanany

    <hr class="sidebar-divider">

    <div class="sidebar-heading"> Projects </div>

    @canany(['add-platform', 'edit-platform', 'view-platform', 'delete-platform'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlatform" aria-expanded="true" aria-controls="collapsePlatform">
                <i class="fas fa-fw fa-folder"></i>
                <span>PLATFORM</span>
            </a>
            <div id="collapsePlatform" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/platforms/create') }}">ADD PLATFORM</a>
                    <a class="collapse-item" href="{{ url('/platforms') }}">MANAGE PLATFORMS</a>
                </div>
            </div>
        </li>
    @endcanany

    @role('Super Admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClient" aria-expanded="true" aria-controls="collapseClient">
                <i class="fas fa-user-tie"></i>
                <span>CLIENT</span>
            </a>
            <div id="collapseClient" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/clients/create') }}">ADD CLIENT</a>
                    <a class="collapse-item" href="{{ url('/clients') }}">MANAGE CLIENT</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjectStatus" aria-expanded="true" aria-controls="collapseProjectStatus">
                <i class="fas fa-user-tie"></i>
                <span>PROJECT STATUS</span>
            </a>
            <div id="collapseProjectStatus" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/project-statuses/create') }}">ADD P.STATUS</a>
                    <a class="collapse-item" href="{{ url('/project-statuses') }}">MANAGE P.STATUS</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProject" aria-expanded="true" aria-controls="collapseProject">
                <i class="fas fa-user-tie"></i>
                <span>PROJECT</span>
            </a>
            <div id="collapseProject" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/projects/create') }}">ADD PROJECT</a>
                    <a class="collapse-item" href="{{ url('/projects') }}">MANAGE PROJECT</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjectNotes" aria-expanded="true" aria-controls="collapseProjectNotes">
                <i class="fas fa-user-tie"></i>
                <span>PROJECT NOTE</span>
            </a>
            <div id="collapseProjectNotes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/project-notes/create') }}">ADD NOTE</a>
                    <a class="collapse-item" href="{{ url('/project-notes') }}">MANAGE NOTE</a>
                </div>
            </div>
        </li>
    @endrole

    <hr class="sidebar-divider">

    <div class="sidebar-heading"> Task & Reminder </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTaskStatus" aria-expanded="true" aria-controls="collapseTaskStatus">
            <i class="fas fa-user-tie"></i>
            <span>TASK STATUS</span>
        </a>
        <div id="collapseTaskStatus" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/task-statuses/create') }}">ADD T.STATUS</a>
                <a class="collapse-item" href="{{ url('/task-statuses') }}">MANAGE T.STATUS</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading"> Employee </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartment" aria-expanded="true" aria-controls="collapseDepartment">
            <i class="fas fa-user-tie"></i>
            <span>DEPARTMENT</span>
        </a>
        <div id="collapseDepartment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/departments/create') }}">ADD DEPARTMENT</a>
                <a class="collapse-item" href="{{ url('/departments') }}">MANAGE DEPARTMENT</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDesignation" aria-expanded="true" aria-controls="collapseDesignation">
            <i class="fas fa-user-tie"></i>
            <span>DESIGNATION</span>
        </a>
        <div id="collapseDesignation" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/designations/create') }}">ADD DESIGNATION</a>
                <a class="collapse-item" href="{{ url('/designations') }}">MANAGE DESIGNATION</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
            <i class="fas fa-user-tie"></i>
            <span>EMPLOYEE</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/employees/create') }}">ADD EMPLOYEE</a>
                <a class="collapse-item" href="{{ url('/employees') }}">MANAGE EMPLOYEE</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJobStatus" aria-expanded="true" aria-controls="collapseJobStatus">
            <i class="fas fa-user-tie"></i>
            <span>JOB TYPE</span>
        </a>
        <div id="collapseJobStatus" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/job-types/create') }}">ADD JOB TYPE</a>
                <a class="collapse-item" href="{{ url('/job-types') }}">MANAGE JOB TYPE</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>