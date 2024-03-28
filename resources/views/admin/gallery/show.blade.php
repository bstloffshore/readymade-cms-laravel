@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.show_gallery') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.show_gallery') }}</li>
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
                    <th>{{ __('gallery.title_en') }}</th>
                    <td>{{ $gallery->title_en }}</td>
                </tr>
                <tr>
                    <th>{{ __('gallery.title_ar') }}</th>
                    <td>{{ $gallery->title_ar }}</td>
                </tr>

                <tr>
                    <th>Image</th>
                    <td>
                        <p>
                            <a href="{{ $gallery->image_large_path }}{{ $gallery->image }}" data-toggle="lightbox" data-title="{{ $gallery->iamge_title_tag }}">
                                <img src="{{ $gallery->image_medium_path }}{{ $gallery->image }}" class="img-fluid mb-2" alt="{{ $gallery->image_alt_text }}"/>
                            </a>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th>Image alt</th>
                    <td>{{ $gallery->image_alt_text }}</td>
                </tr>
                <tr>
                    <th>Image title tag</th>
                    <td>{{ $gallery->iamge_title_tag }}</td>
                </tr>
                <tr>
                    <th>Sort Order</th>
                    <td>{{ $gallery->sort_order }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>@if($gallery->status==1) Active @else In Active @endif</td>
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
