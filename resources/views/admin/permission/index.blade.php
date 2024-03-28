@extends('layouts.master')
@section('pageTitle', 'Permission')
@section('meta')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('moduleSetting.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Module Settings</li>
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
                    <a role="button" href="{{route('module-settings.create')}}" data-toggle="modal" data-target="#ajaxModal" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('moduleSetting.create') }}</a>
                    <button id="delete-selected" class="btn btn-danger"><i class="fa fa-trash"></i>Delete Selected</button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="moduleSetting-data-table" class="table table-bordered table-striped common-data-table table-response moduleSetting-data-table">
                  <thead>
                  <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Module Name</th>
                    <th>Module Slug</th>
                    <th>Permission Defined</th>
                    <th>Date Created</th>
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
      var table = $('.moduleSetting-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('module-settings.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'module-settings-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'module-settings-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'module-settings-excel',
                   }
              ],
          columns: [
            {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'module_name', name: 'module_name', orderable: false, searchable: false},
              {data: 'module_slug', name: 'module_slug', orderable: false, searchable: false},
              {data: 'permission', name: 'permission', orderable: false, searchable: false},
              {data: 'created_on', name: 'created_on', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('#select-all').on('change', function() {
        $('.moduleSetting-data-table tbody input[type="checkbox"]').prop('checked', this.checked);
    });

    // Handle the "Delete Selected" button click event
    $('#delete-selected').on('click', function() {
        var selectedIds = [];
        $('.moduleSetting-data-table tbody input[type="checkbox"]:checked').each(function() {
            selectedIds.push($(this).val());
        });
        console.log(selectedIds);

        if (selectedIds.length > 0) {
            $('#prepagemessage').show();
            if(confirm('Are you sure to delete module-settings? This cannot be undone.')) {
            $.ajax({
                url: "{{ route('delete-selected-module-settings') }}", // Change to your delete route
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
                        toastr.error('There was a problem while deleting module-settings. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting module-settings. Please try later.');
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

            if(confirm('Are you sure to delete module-settings? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('module-settings.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting module-settings. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting module-settings. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection

