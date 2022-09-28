@extends('backend.layouts.master')

@section('title')
Role Create - Admin Panel
@endsection


@section('admin-content')

<div class="main-content">
    <!-- header area start -->
    @include('backend.layouts.partials.header')
    <!-- header area end -->
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{route('dashboard.view')}}">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">

        <!--Create Role form start -->
        <div class="mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create New Role</h4>
                    @include('backend.layouts.partials.massage')

                    <form method="POST" action="{{route('admin.roles.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="role-name">Role Name</label>
                            <input type="text" class="form-control" name="name" id="role-name" aria-describedby="emailHelp" placeholder="Enter a Role Name">

                        </div>

                        <h4 class="mb-3">All permissions:</h4>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="" class="form-check-input" id="allCheckPermission">
                            <label class="form-check-label" for="allCheckPermission">All</label>
                        </div>

                        <hr />

                        @php
                        $i = 1
                        @endphp
                        @foreach ($permission_groups as $permission_group )
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="" id="{{ $i }}Management" value="{{$permission_group -> group_name}}" onclick="checkPermissionByGroup('role-{{$i}}-managment-checkbox',this)">
                                    <label class="form-check-label" for="{{$i}}Management">{{$permission_group -> group_name}}</label>
                                </div>
                            </div>
                            <div class="col-md-9 role-{{$i}}-managment-checkbox">

                                @php
                                $permissions = App\Models\User::getpermissionsByGroupName($permission_group -> group_name);
                                $j = 1;
                                @endphp

                                @foreach ($permissions as $permission )
                                <div class="form-check">

                                    <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{$permission -> id}}" value="{{$permission -> name}}">
                                    <label class="form-check-label" for="checkPermission{{$permission -> id}}">{{$permission -> name}}</label>

                                </div>
                                @php
                                $j++;
                                @endphp

                                @endforeach
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!--Create Role form end -->
    </div>
</div>

@endsection

@push('script')
<!-- script for mark all checkbox at once -->
<script>
    $("#allCheckPermission").click(function() {
        if ($(this).is(':checked')) {
            //Check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // Un check all the checkbox 
            $('input[type=checkbox]').prop('checked', false);
        }
    })

    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckBox = $('.' + className + ' input');

        // console.log(classCheckBox);
        if (groupIdName.is(':checked')) {

            classCheckBox.prop('checked', true);
        } else {

            classCheckBox.prop('checked', false);
        }
    }
</script>

@endpush