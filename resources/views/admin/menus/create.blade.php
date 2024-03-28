@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('menus.create') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('menus.create') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('menus.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('menu_name_en') has-error @enderror">
                                        <label for="menu_name_en" class="control-label">{{ __('menus.menu_name_en') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter Menu Name" name="menu_name_en" type="text" id="menu_name_en">
                                        @error('menu_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('parent_id') has-error @enderror">
                                        <label for="parent_id" class="control-label">{{ __('menus.parent_name') }}:</label>
                                        <select id="parent_id" class="form-control" name="parent_id">
                                            <option value="0">{{ __('menus.select_parent') }}</option>
                                            @foreach($parents as $parent)
                                            <option value="{{$parent->id}}">{{$parent->menu_name_en}}</option>
                                            @if(count($parent->children) > 0)
                                            @include('admin.menus.subtree', ['submenus' => $parent->children, 'prefix' => '--'])
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('menu_name_ar') has-error @enderror">
                                        <label for="menu_name_ar" class="control-label">{{ __('menus.menu_name_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter Menu Name" name="menu_name_ar" type="text" id="menu_name_ar">
                                        @error('menu_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('slug') has-error @enderror">
                                        <label for="slug" class="control-label">{{ __('menus.slug') }}:</label>
                                        <input class="form-control" placeholder="Enter slug" name="slug" type="text" id="slug" readonly>
                                        @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('link') has-error @enderror">
                                        <label for="link" class="control-label">{{ __('menus.custom_link') }}:</label>
                                        <input class="form-control" placeholder="Enter Custom link" name="link" type="text" id="link">
                                        @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                                        <label for="sort_order" class="control-label">{{ __('menus.sort_order') }} <span class="mandatory"> * </span> :</label>
                                        <input class="form-control" placeholder="Enter Sort Number" name="sort_order" type="text" id="sort_order">
                                        @error('sort_order')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('menus.publish') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('menus.display_in_nav_bar') }}</label>
                                        <select id="display_in_nav_bar" name="display_in_nav_bar" class="form-control" >
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('menus.display_in_seo') }}</label>
                                        <select id="display_in_seo" name="display_in_seo" class="form-control" >
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('menus.display_in_footer') }} :</label>
                                        <select id="display_in_footer" name="display_in_footer" class="form-control" >
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                                        <label for="image" class="control-label">{{ __('menus.image') }}:</label>
                                        <input class="form-control" placeholder="Enter Custom link" name="link" type="file" id="image">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="modal-footer">
                                    <input class="btn btn-primary" id="form_submit" type="submit" value="Submit">
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(function () {
        $('#slug').slugify('#menu_name_en');
        $("#validate_form").validate({
            ignore: [],
            rules: {
                'menu_name_en': { required:true, normalizer: function(value) {return $.trim(value);},},
                // 'slug': { required:true, normalizer: function(value) {return $.trim(value);},},
                'status': { required:true, normalizer: function(value) {return $.trim(value);},},
                'sort_order': {required:true, normalizer: function(value) {return $.trim(value);}},
            },
            messages: {
            },
            submitHandler :function (form) {
                var formData = new FormData(form);
                $('#form_submit').attr('disabled', 'disabled');
                $('#prepagemessage').show();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: form.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data){
                        if(!data.error){
                            toastr.success(data.msg);
                            window.location.href= '{{route('menus.index')}}';
                            toastr.clear();
                        }else{
                            toastr.clear();
                            toastr.error(data.msg);
                            $('#form_submit').removeAttr('disabled');
                        }
                        $('#prepagemessage').hide();
                    },
                    error   : function ( jqXhr, json, errorThrown ) {
                        toastr.clear();
                        var errors = jqXhr.responseJSON;
                        var errorsHtml= '';
                        $.each( errors.errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
                        $('#prepagemessage').hide();
                        $('#form_submit').removeAttr('disabled');
                    },
                    fail:function(){
                        toastr.clear();
                        toastr.error("Something went wrong. Please try later.");
                        $('#prepagemessage').hide();
                        $('#form_submit').removeAttr('disabled');
                    }
                });
                return false;
            }
        });
    });
</script>

@endsection
