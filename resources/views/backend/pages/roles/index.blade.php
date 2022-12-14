@extends('backend.layouts.master')

@push('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('title')
Role Page - Admin Panel
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
        <!-- Role table start -->
        <div class="mt-5">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Roles List</h3>
                </div>
                @include('backend.layouts.partials.massage')

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th width="60%">Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key=>$role )


                            <tr>
                                <td>{{++ $key}}</td>
                                <td class="text-capitalize"> {{$role->name}}</td>
                                <td>
                                    @foreach ($role->permissions as $permisson)
                                    <span class="badge badge-info me-2">
                                        {{$permisson -> name}}
                                    </span>
                                    @endforeach
                                </td>
                                <td>

                                    @if (Auth::guard('admin')->user()->can('role.edit'))
                                    <a class="btn btn-info" href="{{route('admin.roles.edit', $role->id)}}">Edit</a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('role.delete'))
                                    <a class="btn btn-danger" href="route('logout')" onclick="event.preventDefault(); document.getElementById('delete-form{{$role->id}}').submit();">
                                        Delete
                                    </a>

                                    <form id='delete-form{{$role->id}}' method="POST" action="{{route('admin.roles.destroy', $role->id)}}" style="display:none;">
                                        @method('DELETE')
                                        @csrf

                                    </form>
                                    @endif


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- Role table end -->
    </div>
</div>

@endsection

@push('script')
<!-- DataTables  & Plugins -->
<script src="{{asset('backend')}}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush