@extends('layouts.master')
@section('pageTitle', 'Manage Users')
@section('meta')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('users.manage_title') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                    <a role="button" href="{{route('users.create')}}" data-toggle="modal" data-target="#ajaxModal" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('users.create_title') }}</a>
                    <button id="delete-selected" class="btn btn-danger"><i class="fa fa-trash"></i>Delete Selected</button>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="user-data" class="table table-bordered table-striped common-data-table table-response user-data-table">
                  <thead>
                  <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>User Group</th>
                    <th>Member Since</th>
                    <th>Status</th>
                    <th>Reset Password</th>
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

      var table = $('.user-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'users-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'users-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'users-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'roles', name: 'roles'},
              {data: 'created_at', name: 'created_at'},
              {data: 'status', name: 'status'},
              {data: 'reset', name: 'reset', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 6, className: 'text-center' },
                { targets: 7, className: 'text-center' },
                { targets: 8, className: 'text-center' }
            ],
      });
      $('#select-all').on('change', function() {
        $('.user-data-table tbody input[type="checkbox"]').prop('checked', this.checked);
    });

    $('#delete-selected').on('click', function() {
        var selectedIds = [];
        $('.user-data-table tbody input[type="checkbox"]:checked').each(function() {
            selectedIds.push($(this).val());
        });
        if (selectedIds.length > 0) {
            $('#prepagemessage').show();
            if(confirm('Are you sure to delete users? This cannot be undone.')) {
            $.ajax({
                url: "{{ route('users.delete-selected') }}", // Change to your delete route
                method: 'POST',
                data: { ids: selectedIds },
                success: function(res){
                        $('#prepagemessage').hide();
                        if(!res.error){
                            toastr.success(res.msg);
                            window.location.reload();
                            // table.ajax.reload();
                        } else {
                            toastr.error(res.msg);
                        }
                    },
                    error: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting users. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting users. Please try later.');
                    },
            });
        }
        return false;
        }
    });

    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete user? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('users.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting users. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting users. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection
