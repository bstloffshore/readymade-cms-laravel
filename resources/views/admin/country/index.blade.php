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
            <h1><small>{{ __('country.manage') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
              <li class="breadcrumb-item active">{{ __('breadcrumb.country') }}</li>
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
                    <a role="button" href="{{route('countries.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('country.create') }}</a>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="country-data" class="table table-bordered table-striped common-data-table table-response country-data-table">
                  <thead>
                  <tr>
                    <th>{{ __('country.id') }}</th>
                    <th>{{ __('country.country_name_en') }}</th>
                    <th>{{ __('country.sort_order') }}</th>
                    <th>{{ __('country.status') }}</th>
                    <th>{{ __('country.action') }}</th>
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
          ajax: "{{ route('countries.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'countries-pdf',
                   },
                   {
                       extend: 'csv',
                       filename: 'countries-csv',
                   },
                   {
                       extend: 'excel',
                       filename: 'countries-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'country_name_en', name: 'country_name_en'},
              {data: 'sort_order', name: 'sort_order', orderable: false, searchable: false},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 0, className: 'text-center' },
                { targets: 2, className: 'text-center' },
                { targets: 3, className: 'text-center' },



            ],
      });

    });
    function confirmDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            if(confirm('{{ __('country.are_you_sure_delete') }}')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('countries.index')}}/'+id,
                    type: 'delete',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': token },
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

