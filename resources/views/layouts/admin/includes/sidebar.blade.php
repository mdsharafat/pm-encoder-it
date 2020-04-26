<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Encoder-IT</div>
    </a>

    @role('Admin')
        <hr class="sidebar-divider">
        <div class="sidebar-heading"> Users </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>USER</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/users/create') }}">ADD USER</a>
                    <a class="collapse-item" href="{{ url('/users') }}">MANAGE USER</a>
                </div>
            </div>
        </li>
    @endrole

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Projects </div>

    @role('Admin')
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
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClient" aria-expanded="true" aria-controls="collapseClient">
                <i class="fas fa-users"></i>
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjectNotes" aria-expanded="true" aria-controls="collapseProjectNotes">
                <i class="far fa-sticky-note"></i>
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

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProject" aria-expanded="true" aria-controls="collapseProject">
            <i class="fas fa-project-diagram"></i>
            <span>PROJECT</span>
        </a>
        <div id="collapseProject" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @role('Admin')
                    <a class="collapse-item" href="{{ url('/projects/create') }}">ADD PROJECT</a>
                @endrole
                <a class="collapse-item" href="{{ url('/projects') }}">@role('Admin')MANAGE PROJECT @endrole @role('User') PROJECT LIST @endrole</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> TASK ASSIGNMENTS </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTaskAssignments" aria-expanded="true" aria-controls="collapseTaskAssignments">
            <i class="fas fa-tasks"></i>
            <span>TASK ASSIGNMENTS</span>
        </a>
        <div id="collapseTaskAssignments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('add-task')
                    <a class="collapse-item" href="{{ url('/tasks/create') }}">NEW TASK</a>
                @endcan
                @can('view-task')
                    <a class="collapse-item" href="{{ url('/tasks') }}">ASSIGNED TASK LISTS</a>
                    <a class="collapse-item" href="{{ url('/pending-feedback-tasks') }}">PENDING FEEDBACK</a>
                    <a class="collapse-item" href="{{ url('/completed-tasks') }}">COMPLETED TASK</a>
                @endcan
                @role('User')
                    <a class="collapse-item" href="{{ url('/my-assigned-tasks') }}">ASSIGNED TO ME</a>
                    <a class="collapse-item" href="{{ url('/my-in-progress-tasks') }}">IN PROGRESS TASKS</a>
                    <a class="collapse-item" href="{{ url('/my-completed-tasks') }}">COMPLETED BY ME</a>
                @endrole
            </div>
        </div>
    </li>


    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Employee </div>

    @canany(['add-department', 'edit-department', 'view-department', 'delete-department'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartment" aria-expanded="true" aria-controls="collapseDepartment">
            <i class="far fa-building"></i>
            <span>DEPARTMENT</span>
        </a>
        <div id="collapseDepartment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('add-department')
                    <a class="collapse-item" href="{{ url('/departments/create') }}">ADD DEPARTMENT</a>
                @endcan
                @canany(['edit-department', 'view-department', 'delete-department'])
                    <a class="collapse-item" href="{{ url('/departments') }}">@role('Admin')MANAGE DEPARTMENT @endrole @role('User') DEPARTMENT LIST @endrole</a>
                @endcanany
            </div>
        </div>
    </li>
    @endcanany
    @canany(['add-designation', 'edit-designation', 'view-designation', 'delete-designation'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDesignation" aria-expanded="true" aria-controls="collapseDesignation">
            <i class="fas fa-address-card"></i>
            <span>DESIGNATION</span>
        </a>
        <div id="collapseDesignation" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            @can('add-designation')
                <a class="collapse-item" href="{{ url('/designations/create') }}">ADD DESIGNATION</a>
            @endcan
            @canany(['edit-designation', 'view-designation', 'delete-designation'])
                <a class="collapse-item" href="{{ url('/designations') }}">@role('Admin')MANAGE DESIGNATION @endrole @role('User') DESIGNATION LIST @endrole</a>
            @endcanany
            </div>
        </div>
    </li>
    @endcanany
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
            <i class="fas fa-people-carry"></i>
            <span>EMPLOYEE</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('add-employee')
                    <a class="collapse-item" href="{{ url('/employees/create') }}">ADD EMPLOYEE</a>
                @endcan
                @can('view-employee-list')
                    <a class="collapse-item" href="{{ url('/employees') }}">@role('Admin')MANAGE EMPLOYEE @endrole @role('User') EMPLOYEE LIST @endrole</a>
                @endcan
                @role('User')
                    <a class="collapse-item" href="{{ url('/employees') }}">MY PROFILE</a>
                @endrole
            </div>
        </div>
    </li>
    @canany(['add-review', 'edit-review', 'view-review', 'delete-review'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReview" aria-expanded="true" aria-controls="collapseReview">
            <i class="fas fa-star"></i>
            <span>REVIEW</span>
        </a>
        <div id="collapseReview" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('add-review')
                    <a class="collapse-item" href="{{ url('/reviews/create') }}">ADD REVIEW</a>
                @endcan
                @can('view-review')
                    <a class="collapse-item" href="{{ url('/reviews') }}">@role('Admin') MANAGE REVIEW @endrole @role('User') REVIEW LISTS @endrole</a>
                    <a class="collapse-item" href="{{ url('/employee-view-reviews') }}">EMPLOYEE VIEW</a>
                @endcan
            </div>
        </div>
    </li>
    @endcanany
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeaveManagement" aria-expanded="true" aria-controls="collapseLeaveManagement">
            <i class="fas fa-plane"></i>
            <span>LEAVE MANAGEMENT</span>
        </a>
        <div id="collapseLeaveManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @role('User')
                    <a class="collapse-item" href="{{ url('/leave-managements/create') }}">APPLY</a>
                    <a class="collapse-item" href="{{ url('/my-leave-applications-pending') }}">MY APPLICATION</a>
                    <a class="collapse-item" href="{{ url('/my-leave-applications-summary') }}">MY LEAVE SUMMARY</a>
                @endrole
                @canany(['view-leave', 'approval-leave'])
                    <a class="collapse-item" href="{{ url('/leave-managements') }}">PENDING LIST</a>
                    <a class="collapse-item" href="{{ url('/approved-leave-lists') }}">APPROVED LIST</a>
                    <a class="collapse-item" href="{{ url('/rejected-leave-lists') }}">REJECTED LIST</a>
                @endcanany
            </div>
        </div>
    </li>

    @role('Admin')
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading"> Accounts </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCredit" aria-expanded="true" aria-controls="collapseCredit">
            <i class="fas fa-money-bill-alt"></i>
            <span>CREDIT</span>
        </a>
        <div id="collapseCredit" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/credits/create') }}">ADD CREDIT</a>
                <a class="collapse-item" href="{{ url('/credits') }}">MANAGE CREDIT</a>
                <a class="collapse-item" href="{{ url('/credits-view-by-month') }}">VIEW BY MONTH</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpense" aria-expanded="true" aria-controls="collapseExpense">
          <i class="fas fa-hand-holding-usd"></i>
          <span>EXPENSES</span>
        </a>
        <div id="collapseExpense" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SALARY EXPENSE</h6>
                <a class="collapse-item" href="{{ url('/salary-expenses/create') }}">ADD SALARY</a>
                <a class="collapse-item" href="{{ url('/salary-expenses') }}">MANAGE SALARY</a>
                <a class="collapse-item" href="{{ url('/employee-view-salary-expenses') }}">VIEW BY EMPLOYEE</a>
                <a class="collapse-item" href="{{ url('/salary-expenses-view-by-month') }}">VIEW BY MONTH</a>

                <div class="collapse-divider"></div>

                <h6 class="collapse-header">MISCELLANEOUS</h6>
                <a class="collapse-item" href="{{ url('/miscellaneous-expenses/create') }}">ADD EXPENSE</a>
                <a class="collapse-item" href="{{ url('/miscellaneous-expenses') }}">MANAGE EXPENSE</a>
                <a class="collapse-item" href="{{ url('/miscellaneous-expenses-view-by-month') }}">VIEW BY MONTH</a>
            </div>
        </div>
    </li>
    @endrole

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>