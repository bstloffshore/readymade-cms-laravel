@extends('layouts.master')
@section('pageTitle', 'Manage Roles')
@section('meta')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('roles.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">

              <div class="card-header">
                <h3 class="card-title">
                <a role="button" href="{{route('roles.create')}}" data-toggle="modal" data-target="#ajaxModalOfSmall" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('roles.create') }}</a>

                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="country-data" class="table table-bordered table-striped common-data-table table-response country-data-table">
                  <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Group Name</th>
                    <th>Date Created</th>
                    <th>Permission</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
      var table = $('.country-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('roles.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'roles-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'roles-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'roles-excel',
                   }
              ],
          columns: [
              {data: 'sno', name: 'sno'},
              {data: 'name', name: 'name', orderable: false, searchable: false},
              {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
              {data: 'permissoin', name: 'permissoin', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 3, className: 'text-center' }
            ],

      });

    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete role? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('roles.index')}}/'+id,
                    type: 'delete',
                    dataType: 'json',
                    headers: {
            'X-CSRF-TOKEN': token
        },

                    success: function(res){
                        $('#prepagemessage').hide();
                        if(!res.error){
                            toastr.success(res.msg);
                            window.location.reload();
                        } else {
                            toastr.error(res.msg);
                        }
                    },
                    error: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting country. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting country. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection

