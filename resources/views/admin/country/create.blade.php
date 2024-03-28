@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.add_country') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.add_country') }}</li>
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
                            <form method="POST" action="{{ route('countries.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" name="country_slug" type="hidden" id="country_slug" placeholder="Enter Slug" readonly>
                                <div class="row card-body">
                                    <div class="col-sm-6 col-xs-12 form-group @error('country_name') has-error @enderror">
                                        <label for="country_name" class="control-label">{{ __('country.country_name_en') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('country.country_name_en') }}" name="country_name_en" type="text" id="country_name_en">
                                        @error('country_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('country_name_ar') has-error @enderror">
                                        <label for="country_name_ar" class="control-label">{{ __('country.country_name_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter {{ __('country.country_name_ar') }}" name="country_name_ar" type="text" id="country_name_ar">
                                        @error('country_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row card-body">
                                    <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                                        <label for="sort_order" class="control-label">{{ __('country.sort_order') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="sort_order" type="text" id="sort_order" placeholder="Enter {{ __('country.sort_order') }}">
                                        @error('sort_order')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('country.status') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
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
    @include('partials.submitValidationLinks')
    <script>
        $(function () {
           $('#country_slug').slugify('#country_name_en');
           $("#validate_form").validate({
               ignore: [],
               rules: {
                   'country_name_en': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'sort_order': { required:true, normalizer: function(value) {return $.trim(value);},},
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
                               window.location.href= '{{route('countries.index')}}';
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
