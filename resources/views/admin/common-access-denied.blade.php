@extends('layouts.adminLTE')
@section('pageTitle', 'Manage Advisors')
@section('meta')
@include('partials.datatablecss')
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><small>{{ __('advisor.manage_title') }}</small></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashaboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Advisor</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="row card-body">
    <div class="col-xs-12">
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="fa fa-ban"></span> Access Denied</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="alert alert-warning">
                    You do not have permission to view this content or perform this action. Kindly get in touch with the administrator for further assistance.                </div>
            </div>
        </div>

    </div>
</div>
@endsection
