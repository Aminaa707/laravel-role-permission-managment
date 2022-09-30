<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{route('dashboard.view')}}"><img src="{{asset('backend')}}/assets/images/icon/logo.png" alt="logo"></a>

        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{Route::is('dashboard.view')? 'active' : ''}}">
                        <a href="{{route('dashboard.view')}}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('dashboard.view')? 'active' : ''}}"><a href="{{route('dashboard.view')}}">Dashboard</a></li>

                        </ul>
                    </li>
                    <li class="{{Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.edit')|| Route::is('admin.roles.show') ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left "></i><span> Roles & Permissions
                            </span></a>
                        <ul class="collapse {{Route::is('admin.roles.create') || Route::is('admin.roles.index') ||Route::is('admin.roles.
                            edit') ||Route::is('admin.roles.show') ? 'in' : ''}}">
                            <li class="{{Route::is('admin.roles.index')|| Route::is('admin.roles.edit')? 'active' : ''}}"><a href="{{route('admin.roles.index')}}">All Roles</a></li>
                            <li class="{{Route::is('admin.roles.create')? 'active' : ''}}"><a href="{{route('admin.roles.create')}}">Create Role</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>