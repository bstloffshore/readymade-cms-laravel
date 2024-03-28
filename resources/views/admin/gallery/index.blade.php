@extends('layouts.master')
@section('pageTitle', 'Manage Gallery')
@section('meta')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('gallery.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
              <li class="breadcrumb-item active">{{ __('breadcrumb.list_gallery') }}</li>
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
                <a role="button" href="{{route('galleries.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> <b>{{ __('gallery.create') }}</b></a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="gallery-data" class="table table-bordered table-striped common-data-table table-response gallery-data-table">
                  <thead>
                  <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>First Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Sort Order</th>
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

      var table = $('.gallery-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('galleries.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'galleries-pdf',
                   },
                   {
                       extend: 'csv',
                       filename: 'galleries-csv',
                   },
                   {
                       extend: 'excel',
                       filename: 'galleries-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'title_en', name: 'title_en'},
              {data: 'image', name: 'image',orderable: false, searchable: false},
              {data: 'status', name: 'status',orderable: false, searchable: false},
              {data: 'sort_order', name: 'sort_order'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 0, className: 'text-center table-sn-size' },
                { targets: 2, className: 'text-center' },
                { targets: 3, className: 'text-center' },
                { targets: 4, className: 'text-center' },
                { targets: 5, className: 'text-center table-column-size' },
                { targets: 6, className: 'text-center table-column-size' },
            ],

      });
    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete galleries? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('galleries.index')}}/'+id,
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


  </script>
@endsection
