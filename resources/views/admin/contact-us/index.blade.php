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
            <h1><small>Contact us data</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Contact us data</li>
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
                </h3>
              </div>

              <!-- /.card-header -->

              <div class="card-body">
                <table id="country-data" class="table table-bordered table-striped common-data-table table-response country-data-table">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Reference ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created on</th>
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
          ajax: "{{ route('contact-us.index') }}",
          dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       filename: 'countries-pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       filename: 'countries-csv',
                       exportOptions: {
                           columns: [0,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       filename: 'countries-excel',
                   }
              ],
          columns: [
              {data: 'checkboxAndId', name: 'checkboxAndId'},
              {data: 'reference_id', name: 'reference_id', orderable: false, searchable: false},
              {data: 'name', name: 'name', orderable: false, searchable: false},
              {data: 'email', name: 'email', orderable: false, searchable: false},
              {data: 'phone', name: 'phone', orderable: false, searchable: false},
              {data: 'created_on', name: 'created_on', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [
                { targets: 0, className: 'text-center' },
                { targets: 3, className: 'text-center' },
                { targets: 4, className: 'text-center' },

            ],
      });

    });

  </script>
@endsection

