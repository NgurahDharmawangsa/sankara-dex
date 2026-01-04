<li class="nav-item nav-item-has-children {{ request()->is('master/*') ? 'open' : '' }}">
    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#master-data" aria-controls="master-data"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon bx bx-folder-open" style="color: #333;"></span>
        <span class="text" style="color: #333;">Master Data</span>
    </a>
    <ul id="master-data" class="collapse dropdown-nav {{ request()->is('master/*') ? 'show' : '' }}">
        <li class="nav-item {{ request()->is('master/category*') ? 'active' : '' }}">
            <a href="{{ route('master.category.index') }}"> Category</a>
        </li>
        <li class="nav-item {{ request()->is('master/subcategory*') ? 'active' : '' }}">
            <a href="{{ route('master.subcategory.index') }}"> Sub Category</a>
        </li>
    </ul>
</li>
<li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
    <a href="{{ route('user.index') }}">
        <span class="icon bx bx-user"></span>
        <span class="text">User Management</span>
    </a>
</li>
<li class="nav-item {{ request()->is('job*') ? 'active' : '' }}">
    <a href="{{ route('job.index') }}">
        <span class="icon bx bx-task"></span>
        <span class="text">Job List</span>
    </a>
</li>
<li class="nav-item {{ request()->is('report/job*') ? 'active' : '' }}">
    <a href="{{ route('report.job.index') }}">
        <span class="icon bx bxs-report"></span>
        <span class="text">Report</span>
    </a>
</li>
