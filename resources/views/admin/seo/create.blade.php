@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="modal-title" id="ajaxModalLabel"><b>{{ __('seo.create') }}</b></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('seo.create') }}</li>
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
                            <form method="POST" action="{{ route('seo.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('menus_id') has-error @enderror">
                                        <label for="menus_id" class="control-label">{{ __('seo.page_name') }} <span class="mandatory"> * </span>
                                            :</label>
                                        <select id="menus_id" name="menus_id" class="form-control">
                                            <option value="">Select Page</option>
                                            @foreach ($pages as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->menu_name_en }}</option>
                                                @if (count($parent->children) > 0)
                                                    @include('admin.seo.subtree', [
                                                        'submenus' => $parent->children,
                                                        'prefix' => '--',
                                                    ])
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="hidden" name="menu_slug">
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_title') has-error @enderror">
                                        <label for="meta_title" class="control-label">{{ __('seo.meta_title') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('seo.meta_title') }}" name="meta_title" type="text" id="meta_title">
                                        @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('canonical_url') has-error @enderror">
                                        <label for="canonical_url" class="control-label">{{ __('seo.canonical_url') }} :</label>
                                        <input type="text" name="canonical_url" id="canonical_url" class="form-control" placeholder="Enter {{ __('seo.canonical_url') }}">
                                        @error('canonical_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                                        <label for="image" class="control-label">{{ __('seo.image') }} :</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image_alt') has-error @enderror">
                                        <label for="image_alt" class="control-label">{{ __('seo.image_alt') }} :</label>
                                        <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="Enter {{ __('seo.image_alt') }}">
                                        @error('image_alt')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label"> {{ __('seo.status') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_description') has-error @enderror">
                                        <label for="meta_description" class="control-label"> {{ __('seo.meta_description') }} <span class="mandatory"> * </span> :</label>
                                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3"></textarea>
                                        @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_keywords') has-error @enderror">
                                        <label for="meta_keywords" class="control-label">{{ __('seo.meta_keywords') }} <span class="mandatory"> * </span> :</label>
                                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3"></textarea>
                                        @error('meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('robots') has-error @enderror">
                                        <label for="robots" class="control-label">{{ __('seo.robots') }} :</label>
                                        <input type="text" name="robots" id="robots" class="form-control" placeholder="Enter {{ __('seo.robots') }}">
                                        @error('robots')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_title') has-error @enderror">
                                        <label for="og_title" class="control-label">{{ __('seo.og_title') }} :</label>
                                        <input type="text" name="og_title" id="og_title" class="form-control" placeholder="Enter {{ __('seo.og_title') }}">
                                        @error('og_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_url') has-error @enderror">
                                        <label for="og_url" class="control-label">{{ __('seo.og_url') }} :</label>
                                        <input type="text" name="og_url" id="og_url" class="form-control" placeholder="Enter {{ __('seo.og_url') }}">
                                        @error('og_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_image') has-error @enderror">
                                        <label for="og_image" class="control-label">{{ __('seo.og_image') }}:</label>
                                        <input type="file" name="og_image" id="og_image" class="form-control">
                                        @error('og_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_type') has-error @enderror">
                                        <label for="og_type" class="control-label">{{ __('seo.og_type') }} :</label>
                                        <input type="text" name="og_type" id="og_type" class="form-control">
                                        @error('og_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_locale') has-error @enderror">
                                        <label for="og_locale" class="control-label">{{ __('seo.og_locale') }} :</label>
                                        <input type="text" name="og_locale" id="og_locale" class="form-control">
                                        @error('og_locale')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('og_description') has-error @enderror">
                                        <label for="og_description" class="control-label">{{ __('seo.og_description') }} :</label>
                                        <textarea class="form-control" name="og_description" id="og_description" rows="3"></textarea>
                                        @error('og_description')
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
           $("#validate_form").validate({
               ignore: [],
               rules: {
                   'menus_id': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'meta_title': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'meta_description': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'meta_keywords': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'status': { required:true, normalizer: function(value) {return $.trim(value);},},
               },
               messages: {},
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
                               window.location.href= '{{route('seo.index')}}';
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
