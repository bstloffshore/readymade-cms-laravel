@extends('layouts.master')
@section('pageTitle', 'Manage Category')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('categories.show_title') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('categories.show_title') }}</li>
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
                                <th>Page Name</th>
                                <td>{{ $seo->menu->menu_name_en }}</td>
                            </tr>
                            <tr>
                                <th>Meta Title</th>
                                <td>{{ $seo->meta_title }}</td>
                            </tr>
                            <tr>
                                <th>Main heading</th>
                                <td>{{ $seo->meta_main_heading }}</td>
                            </tr>
                            <tr>
                                <th>Sub heading</th>
                                <td>{{ $seo->meta_sub_heading }}</td>
                            </tr>
                            <tr>
                                <th>Canonical</th>
                                <td>{{ $seo->canonical_url }}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>@if ($seo->image!=null)
                                    <p><img src="{{ asset('public/storage/seo/thumb') }}/{{ $seo->image }}"></p>
                                    @endif</td>
                            </tr>
                            <tr>
                                <th>Image Alt</th>
                                <td>{{ $seo->image_alt }}</td>
                            </tr>
                            <tr>
                                <th>Meta Description</th>
                                <td>{{ $seo->meta_description }}</td>
                            </tr>
                            <tr>
                                <th>Meta Keywords</th>
                                <td>{{ $seo->meta_keywords }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>@if($seo->status==1) Active @else In Active @endif</td>
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
