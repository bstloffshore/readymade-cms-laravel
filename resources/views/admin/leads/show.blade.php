@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('country.show') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('country.show') }}</li>
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
                                <th>{{ __('country.country_name_en') }}</th>
                                <td>{{ $country->country_name_en }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('country.country_name_ar') }}</th>
                                <td>{{ $country->country_name_ar }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('country.country_slug') }}</th>
                                <td>{{ $country->country_slug }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('country.sort_order') }}</th>
                                <td>{{ $country->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('country.status') }}</th>
                                <td>@if($country->status==1) Active @else In Active @endif</td>
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
