@php
$guard = Auth::guard('admin')->user()
@endphp
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
                    <!-- Dashboard -->
                    <li class="{{Route::is('dashboard.view')? 'active' : ''}}">
                        <a href="{{route('dashboard.view')}}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('dashboard.view')? 'active' : ''}}"><a href="{{route('dashboard.view')}}">Dashboard</a></li>

                        </ul>
                    </li>
                    <!-- Roles & Permissions -->
                    <li class="{{Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.edit')|| Route::is('admin.roles.show') ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks "></i><span> Roles & Permissions
                            </span></a>
                        <ul class="collapse {{Route::is('admin.roles.create') || Route::is('admin.roles.index') ||Route::is('admin.roles.
                            edit') ||Route::is('admin.roles.show') ? 'in' : ''}}">
                            <li class="{{Route::is('admin.roles.index')|| Route::is('admin.roles.edit')? 'active' : ''}}"><a href="{{route('admin.roles.index')}}">All Roles</a></li>
                            <li class="{{Route::is('admin.roles.create')? 'active' : ''}}"><a href="{{route('admin.roles.create')}}">Create Role</a></li>
                        </ul>
                    </li>
                    <!-- Users -->
                    <li class="{{Route::is('admin.users.index') || Route::is('admin.users.create') || Route::is('admin.users.edit')|| Route::is('admin.users.show') ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user "></i><span> Users
                            </span></a>
                        <ul class="collapse {{Route::is('admin.users.create') || Route::is('admin.users.index') ||Route::is('admin.users.
                            edit') ||Route::is('admin.users.show') ? 'in' : ''}}">
                            <li class="{{Route::is('admin.users.index')|| Route::is('admin.users.edit')? 'active' : ''}}"><a href="{{route('admin.users.index')}}">All Users</a></li>
                            <li class="{{Route::is('admin.users.create')? 'active' : ''}}"><a href="{{route('admin.users.create')}}">Create User</a></li>
                        </ul>
                    </li>
                    <!-- Admins -->

                    <li class="{{Route::is('admin.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit')|| Route::is('admin.admins.show') ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user "></i><span> Admins
                            </span></a>
                        <ul class="collapse {{Route::is('admin.admins.create') || Route::is('admin.admins.index') ||Route::is('admin.admins.
                            edit') ||Route::is('admin.admins.show') ? 'in' : ''}}">
                            <li class="{{Route::is('admin.admins.index')|| Route::is('admin.admins.edit')? 'active' : ''}}"><a href="{{route('admin.admins.index')}}">All Admins</a></li>
                            <li class="{{Route::is('admin.admins.create')? 'active' : ''}}"><a href="{{route('admin.admins.create')}}">Create Admin</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>