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
                <span>USERS</span>
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-folder"></i>
                <span>PLATFORMS</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/platforms/create') }}">ADD PLATFORM</a>
                    <a class="collapse-item" href="{{ url('/platforms') }}">MANAGE PLATFORMS</a>
                </div>
            </div>
        </li>
    @endcanany

    @role('Super Admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                <i class="fas fa-user-tie"></i>
                <span>CLIENTS</span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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
                    <a class="collapse-item" href="{{ url('/project-statuses/create') }}">ADD NEW P.STATUS</a>
                    <a class="collapse-item" href="{{ url('/project-statuses') }}">MANAGE P.STATUS</a>
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
                <a class="collapse-item" href="{{ url('/task-statuses/create') }}">ADD NEW T.STATUS</a>
                <a class="collapse-item" href="{{ url('/task-statuses') }}">MANAGE T.STATUS</a>
            </div>
        </div>
    </li>




    <!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>