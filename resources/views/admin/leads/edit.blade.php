@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.edit_country') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.edit_country') }}</li>
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
                            <form method="POST" action="{{ route('leads.update', ['lead' => $lead->id]) }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input class="form-control" name="country_slug" type="hidden" id="country_slug" value="{{ $lead->country_slug }}" readonly>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('country_name') has-error @enderror">
                                        <label for="country_name" class="control-label">{{ __('lead.name') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('lead.name') }}" name="name" type="text" id="name" value="{{ $lead->name }}">
                                        @error('country_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('email') has-error @enderror">
                                        <label for="email" class="control-label">{{ __('lead.email') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('lead.email') }}" name="email" type="text" id="email" value="{{ $lead->email }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('phone') has-error @enderror">
                                        <label for="phone" class="control-label">{{ __('lead.phone') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('lead.phone') }}" name="phone" type="text" id="phone" value="{{ $lead->phone }}">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('location') has-error @enderror">
                                        <label for="location" class="control-label">{{ __('lead.location') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('lead.location') }}" name="location" type="text" id="location" value="{{ $lead->location }}">
                                        @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('lead.status') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="0" {{ $lead->status==0 ? 'selected':'' }}>New</option>
                                            <option value="1" {{ $lead->status==1 ? 'selected':'' }}>Contacted</option>
                                            <option value="2" {{ $lead->status==2 ? 'selected':'' }}>Blocked</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 form-group @error('message') has-error @enderror">
                                        <label for="message" class="control-label">{{ __('lead.message') }}:</label>
                                        <textarea class="form-control" name="message" id="message" cols="10" rows="5" placeholder="Enter {{ __('lead.message') }}">{{ $lead->message }}</textarea>
                                        @error('message')
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
                   'name': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'email': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'phone': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'location': { required:true, normalizer: function(value) {return $.trim(value);},},
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
                               window.location.href= '{{route('leads.index')}}';
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
