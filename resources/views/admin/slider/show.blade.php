@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.show_slider') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.show_slider') }}</li>
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
                    <th>First Title(English)</th>
                    <td>{{ $slider->first_title_en }}</td>
                </tr>
                <tr>
                    <th>First Title(Arabic)</th>
                    <td>{{ $slider->first_title_ar }}</td>
                </tr>
                <tr>
                    <th>Second Title(English)</th>
                    <td>{{ $slider->second_title_en }}</td>
                </tr>
                <tr>
                    <th>Second Title(Arabic)</th>
                    <td>{{ $slider->second_title_ar }}</td>
                </tr>
                <tr>
                    <th>Third Title(English)</th>
                    <td>{{ $slider->third_title_en }}</td>
                </tr>
                <tr>
                    <th>Third Title(Arabic)</th>
                    <td>{{ $slider->third_title_ar }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>

                        <p><a href="{{ asset('public/storage/slider/large') }}/{{ $slider->image }}" data-toggle="lightbox" data-title="{{ $slider->first_title_en }}">
                            <img width=50 height=50 src="{{ asset('public/storage/slider/large') }}/{{ $slider->image }}" class="img-fluid mb-2" alt="white sample"/>
                            </a>

                        </p></td>
                </tr>

                <tr>
                    <th>Image alt</th>
                    <td>{{ $slider->image_alt }}</td>
                </tr>
                <tr>
                    <th>Sort Order</th>
                    <td>{{ $slider->sort_order }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>@if($slider->status==1) Active @else In Active @endif</td>
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
