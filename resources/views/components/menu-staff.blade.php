<li class="nav-item {{ request()->is('job*') ? 'active' : '' }}">
    <a href="{{ route('job.index', !auth()->user()->isStaff() ? $userId : '')  }}">
        <span class="icon bx bx-task"></span>
        <span class="text">Create Job</span>
    </a>
</li>
<li class="nav-item {{ request()->is('history*') ? 'active' : '' }}">
    <a href="{{ route('history.index', !auth()->user()->isStaff() ? $userId : '')  }}">
        <span class="icon bx bx-history"></span>
        <span class="text">Job History</span>
    </a>
</li>
