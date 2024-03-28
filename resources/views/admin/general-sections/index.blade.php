@extends('layouts.master')
@section('pageTitle', 'Manage customers')
@section('meta')
<style>
.tree {
    list-style: none;
    margin: 0;
    padding: 0;
}

.parent {
    background-color: #f0f0f0;
    margin: 5px 0;
    padding: 5px;
    border-radius: 3px;
}

.child {
    margin: 5px 0;
    padding: 5px 0 5px 20px;
}

.actions {
    float: right;
}

.action {
    margin-left: 5px;
}

.tree > li > ul {
    border-left: 1px solid #ccc;
    padding-left: 20px;
    margin-top: 5px;
}


    </style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>{{ __('general-sections.manage_title') }}</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Customers</li>
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

                    <a role="button" href="{{route('general-sections.create')}}" data-toggle="modal" data-target="#ajaxModal" class="btn btn-success"><i class="fa fa-plus"></i> <b>{{ __('general-sections.create_title') }}</b></a>

                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="customers-data" class="table table-bordered table-striped common-data-table table-response general-sections-data-table">
                  <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created On</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $count=1;
                    @endphp
                    @foreach($generalSections as $generalSection)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>
                            <ul class="tree">
                                <li class="parent">
                                    <span>{{$generalSection->category_title_en}}</span>

                                    <a class="ml-2 btn btn-warning btn-sm" href="{{route("general-sections.edit",$generalSection->id)}}" data-toggle="modal" data-target="#ajaxModal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @include('admin.general-sections.children', ['subGeneralSections' => $generalSection->children])

                                </li>
                            </ul>
                        </td>
                        <td>@if($generalSection->status==1) Active @else In Active @endif</td>
                        @php
                        $createdOn=Carbon\Carbon::parse($generalSection->created_on)->format('d-m-y h:i A');
                        @endphp
                        <td>{{$createdOn}}</td>

                    </tr>
                    @endforeach
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
        $('.general-sections-data-table').DataTable({
            columnDefs: [
            { targets: 1, width: '500px' } // Adjust the width value as needed
        ]
        });
    });

    function confirmSectionDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete section? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('sections.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting section. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting section. Please try later.');
                    },
                });
            }

            return false;
        }


        function confirmGeneralSectionDelete(id)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(confirm('Are you sure to delete section? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('general-sections.index')}}/'+id,
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
                        toastr.error('There was a problem while deleting section. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while deleting section. Please try later.');
                    },
                });
            }

            return false;
        }

  </script>
@endsection
