@extends('layouts.master')
@section('pageTitle', 'Manage')
@section('meta')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('office-location.manage_title') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{ __('office-location.list_title') }}</li>
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
                    <a role="button" href="{{route('office-locations.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('office-location.create_title') }}</a>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="office-location-data" class="table table-bordered table-striped common-data-table table-response office-location-data-table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Title</th>
                    <th>Second Title</th>
                    <th>Third Title</th>
                    <th>Sort Order</th>
                    <th>Status</th>
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
      var table = $('.office-location-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('office-locations.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'office-location-pdf',
                   },
                   {
                       extend: 'csv',
                       filename: 'office-location-csv',
                   },
                   {
                       extend: 'excel',
                       filename: 'office-location-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'first_title_en', name: 'first_title_en'},
              {data: 'second_title_en', name: 'second_title_en'},
              {data: 'third_title_en', name: 'third_title_en'},
              {data: 'sort_order', name: 'sort_order', orderable: false, searchable: false},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 0, className: 'text-center' },
                { targets: 4, className: 'text-center' },
                { targets: 5, className: 'text-center' },
                { targets: 6, className: 'table-column-size' },

            ],
      });

    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete jobs? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('office-locations.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting jobs. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting jobs. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection

