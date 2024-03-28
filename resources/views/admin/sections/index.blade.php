@extends('layouts.adminLTE')
@section('pageTitle', 'Manage customers')
@section('meta')
@include('partials.datatablecss')
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
              <li class="breadcrumb-item"><a href="{{ route('admin.dashaboard') }}">Dashboard</a></li>
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
                    <a role="button" href="{{route('general-sections.create')}}" data-toggle="modal" data-target="#ajaxModal" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('general-sections.create_title') }}</a>

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
                    <th>Add Sections</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $count=1;
                    @endphp
                    @foreach($generalSections as $generalSection)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{$generalSection->category_title_en}}
                            <a class="" href="{{route("general-sections.edit",$generalSection->id)}}" data-toggle="modal" data-target="#ajaxModal"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>@if($generalSection->status==1) Active @else In Active @endif</td>
                        <td>{{$generalSection->created_on}}</td>

                        <td>
                            <a role="button" href="{{route('general-sections.create')}}" data-toggle="modal" data-target="#ajaxModal" class="btn btn-success"><i class="fa fa-plus"></i></a>

                        </td>
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
@include('partials.datatablejs')
<script type="text/javascript">
    $(function () {
        $('.general-sections-data-table').DataTable();
    });

  </script>
@endsection
