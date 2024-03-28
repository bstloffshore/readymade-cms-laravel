@extends('layouts.adminLTE')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('country.show_title') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashaboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('country.show_title') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table id="vertical-datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Country Name(English)</th>
                                <td>{{ $country->country_name_en }}</td>
                            </tr>
                            <tr>
                                <th>Country Name(Arabic)</th>
                                <td>{{ $country->country_name_ar }}</td>
                            </tr>

                            <tr>
                                <th>Country Slug</th>
                                <td>{{ $country->country_slug }}</td>
                            </tr>
                            <tr>
                                <th>Sort Order</th>
                                <td>{{ $country->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>@if($country->status==1) Published @else In Active @endif</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
    </div>
</div>
</div>
</section>
@endsection
