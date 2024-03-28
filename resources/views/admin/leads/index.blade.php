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
            <h1><small>{{ __('lead.manage') }}</small></h1>
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
                    {{-- <a role="button" href="{{route('countries.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('lead.create') }}</a> --}}
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="country-data" class="table table-bordered table-striped common-data-table table-response country-data-table">
                  <thead>
                  <tr>
                    <th>{{ __('lead.id') }}</th>
                    <th>{{ __('lead.name') }}</th>
                    <th>{{ __('lead.email') }}</th>
                    <th>{{ __('lead.phone') }}</th>
                    <th>{{ __('lead.location') }}</th>
                    <th>{{ __('lead.action') }}</th>
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
          ajax: "{{ route('leads.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'leads-pdf',
                   },
                   {
                       extend: 'csv',
                       filename: 'leads-csv',
                   },
                   {
                       extend: 'excel',
                       filename: 'leads-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'location', name: 'location'},
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
            if(confirm('{{ __('lead.are_you_sure_delete') }}')) {
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
                        toastr.error('There was a problem while deleting lead. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting lead. Please try later.');
                    },
                });
            }

            return false;
        }
  </script>
@endsection

