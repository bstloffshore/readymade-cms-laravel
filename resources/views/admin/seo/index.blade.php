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
            <h1><small>{{ __('seo.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
              <li class="breadcrumb-item active">{{ __('seo.list') }}</li>
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
            <a role="button" href="{{route('seo.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('seo.create') }}</a>


                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="seo-data" class="table table-bordered table-striped common-data-table table-response seo-data-table">
                  <thead>
                  <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>{{ __('seo.meta_title') }}</th>
                    <th>{{ __('seo.page_name') }}</th>
                    <th>{{ __('seo.status') }}</th>
                    <th>{{ __('seo.date') }}</th>
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

      var table = $('.seo-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('seo.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'seo-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'seo-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'seo-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId',orderable: false, searchable: false},
              {data: 'meta_title', name: 'meta_title', orderable: false, searchable: false},
              {data: 'page_name', name: 'page_name', orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false, searchable: false},
              {data: 'created_on', name: 'created_on', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });




    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete seo? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('seo.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting seo. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting seo. Please try later.');
                    },
                });
            }

            return false;
        }

  </script>
@endsection

