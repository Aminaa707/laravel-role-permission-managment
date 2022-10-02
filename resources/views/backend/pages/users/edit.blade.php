@extends('backend.layouts.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endpush

@section('title')
Edit User - Admin Panel
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
                    <h4 class="page-title pull-left">Edit User</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{route('dashboard.view')}}">Home</a></li>
                        <li><span>Edit User - {{$users->name}}</span></li>
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

        <!--Edit Role form start -->
        <div class="mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit User - {{$users->name}}</h4>
                    @include('backend.layouts.partials.massage')

                    <form method="POST" action="{{route('admin.users.update', $users->id)}}">
                        @method('PUT')
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6 com-sm-12 form-group">
                                <label for="user-name">User Name</label>
                                <input type="text" class="form-control" name="name" id="user-name" value="{{$users->name}}" aria-describedby="emailHelp" placeholder="Enter a Name">

                            </div>
                            <div class="col-md-6 com-sm-12 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter a email" value="{{$users->email}}">

                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 com-sm-12 form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Password">

                            </div>
                            <div class="col-md-6 com-sm-12 form-group">
                                <label for="confirm_password">Confairm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confairm-password" aria-describedby="emailHelp" placeholder="Confirm your password">

                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 com-sm-12 form-group">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach ($roles as $role )
                                    <option value="{{$role->name}}" {{$users->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                    </form>


                </div>
            </div>
        </div>
        <!--Edit Role form end -->
    </div>
</div>

@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush