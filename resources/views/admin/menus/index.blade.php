@extends('layouts.master')
@section('pageTitle', 'Manage Menu')
@section('meta')
{{-- @include('partials.datatablescss') --}}
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('menus.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{ __('menus.list') }}</li>
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
                <a role="button" href="{{route('menus.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> <b>{{ __('menus.create') }}</b></a>

                </h3>
              </div>

              <!-- /.card-header -->

              <div class="card-body table-responsive">
                <table id="menu-data" class="table table-bordered table-striped common-data-table table-response menu-data-table">
                  <thead>
                  <tr>
                    <th>#ID</th>
                    <th>{{ __('menus.menu_name_en') }}</th>
                    <th>{{ __('menus.menu_name_ar') }}</th>
                    <th>{{ __('menus.parent_name') }}</th>
                    <th>{{ __('menus.status') }}</th>
                    <th>{{ __('menus.sort_order') }}</th>
                    <th>{{ __('menus.action') }}</th>
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
{{-- @include('partials.datatablesjs') --}}
<script type="text/javascript">
    $(function () {

      var table = $('.menu-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('menus.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'menus-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'menus-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'menus-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'menu_name_en', name: 'menu_name_en', orderable: false},
              {data: 'menu_name_ar', name: 'menu_name_ar', orderable: false},
              {data: 'parent_name', name: 'parent_name', orderable: false},
              {data: 'status', name: 'status', orderable: false},
              {data: 'sort_order', name: 'sort_order', orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 0, className: 'text-center' },
                { targets: 4, className: 'text-center' },
                { targets: 5, className: 'text-center' }
            ],
      });

      $('#select-all').on('change', function() {
        $('.menu-data-table tbody input[type="checkbox"]').prop('checked', this.checked);
    });

    // Handle the "Delete Selected" button click event
    $('#delete-selected').on('click', function() {
        var selectedIds = [];
        $('.menu-data-table tbody input[type="checkbox"]:checked').each(function() {
            selectedIds.push($(this).val());
        });


        if (selectedIds.length > 0) {
            $('#prepagemessage').show();
            if(confirm('Are you sure to delete galleries? This cannot be undone.')) {
            $.ajax({
                url: "{{ route('delete-selected-menus') }}", // Change to your delete route
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
                        toastr.error('There was a problem while deleting galleries. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting galleries. Please try later.');
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

            if(confirm('Are you sure to delete menus? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('menus.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting menus. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting menus. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection

