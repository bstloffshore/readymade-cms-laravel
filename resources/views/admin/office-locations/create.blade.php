@extends('layouts.master')
@section('pageTitle', 'Manage Office Location')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small>{{ __('officeLocations.create') }}</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.office_location') }}</li>
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
                            <form method="POST" action="{{ route('office-locations.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ isset($ofl) && $ofl->id }}">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('email_icon') has-error @enderror">
                                        <label for="email_icon" class="control-label">{{ __('officeLocations.email_icon') }}  :</label>
                                        <input class="form-control" name="email_icon" type="text" id="email_icon" placeholder="Enter {{ __('officeLocations.email_icon') }}" value="{{ isset($ofl) && $ofl->email_icon !='' ? $ofl->email_icon : '' }}">
                                        @error('email_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('email') has-error @enderror">
                                        <label for="email" class="control-label">{{ __('officeLocations.email') }} <span class="mandatory">*</span> :</label>
                                        <input class="form-control" name="email" type="text" id="email" placeholder="Enter {{ __('officeLocations.email') }}" value="{{ isset($ofl) && $ofl->email !='' ? $ofl->email : '' }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('phone_icon') has-error @enderror">
                                        <label for="phone_icon" class="control-label">{{ __('officeLocations.phone_icon') }} :</label>
                                        <input class="form-control" name="phone_icon" type="text" id="phone_icon" placeholder="Enter {{ __('officeLocations.phone_icon') }}" value="{{ isset($ofl) && $ofl->phone_icon !='' ? $ofl->phone_icon : '' }}">
                                        @error('phone_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('phone_no') has-error @enderror">
                                        <label for="phone_no" class="control-label">{{ __('officeLocations.phone_no') }} <span class="mandatory">*</span> :</label>
                                        <input class="form-control" name="phone" type="text" id="phone" placeholder="Enter {{ __('officeLocations.phone_no') }}" value="{{ isset($ofl) && $ofl->phone !='' ? $ofl->phone : '' }}">
                                        @error('phone_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('tel_number') has-error @enderror">
                                        <label for="tel_number" class="control-label">{{ __('officeLocations.tel_number') }}:</label>
                                        <input class="form-control" name="tel_number" type="text" id="tel_number" placeholder="Enter {{ __('officeLocations.tel_number') }}" value="{{ isset($ofl) && $ofl->tel_number !='' ? $ofl->tel_number : '' }}">
                                        @error('tel_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 col-xs-12 form-group @error('fax_number') has-error @enderror">
                                        <label for="fax_number" class="control-label">{{ __('officeLocations.fax_number') }}:</label>
                                        <input class="form-control" name="fax_number" type="text" id="fax_number" placeholder="Enter {{ __('officeLocations.fax_number') }}" value="{{ isset($ofl) && $ofl->fax_number !='' ? $ofl->fax_number : '' }}">
                                        @error('fax_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('address_icon') has-error @enderror">
                                        <label for="address_icon" class="control-label">{{ __('officeLocations.address_icon') }}:</label>
                                        <input class="form-control" name="address_icon" type="text" id="address_icon" placeholder="Enter {{ __('officeLocations.address_icon') }}" value="{{ isset($ofl) && $ofl->address_icon !='' ? $ofl->address_icon : '' }}">
                                        @error('address_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-xs-12 form-group @error('address_en') has-error @enderror">
                                        <label for="address_en" class="control-label">{{ __('officeLocations.address_en') }} <span class="mandatory">*</span> : </label>
                                        <input class="form-control" name="address_en" type="text" id="address_en" placeholder="Enter {{ __('officeLocations.address_en') }}" value="{{ isset($ofl) && $ofl->address_en !='' ? $ofl->address_en : '' }}">
                                        @error('address_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-xs-12 form-group @error('address_ar') has-error @enderror">
                                        <label for="address_ar" class="control-label">{{ __('officeLocations.address_ar') }}:</label>
                                        <input class="form-control" name="address_ar" type="text" id="address_ar" placeholder="Enter {{ __('officeLocations.address_ar') }}" value="{{ isset($ofl) && $ofl->address_ar !='' ? $ofl->address_ar : '' }}">
                                        @error('address_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-xs-12 form-group @error('map_link') has-error @enderror">
                                        <label for="map_link" class="control-label">{{ __('officeLocations.map_link') }}  :</label>
                                        <input class="form-control" name="map_link" type="text" id="map_link" placeholder="Enter {{ __('officeLocations.map_link') }}" value="{{ isset($ofl) && $ofl->map_link !='' ? $ofl->map_link : '' }}">
                                        @error('map_link')
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
    $(function() {
        $("#validate_form").validate({
            ignore: [],
            rules: {
                'address_en': {required: true,normalizer: function(value) { return $.trim(value);},},
                'email': {required: true,normalizer: function(value) { return $.trim(value);},},
                'phone': {required: true,normalizer: function(value) { return $.trim(value);},},

            },
            messages: {},
            submitHandler: function(form) {
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
                    success: function(data) {
                        if (!data.error) {
                            toastr.success(data.msg);
                            window.location.href = '{{ route('office-locations.create') }}';
                            toastr.clear();
                        } else {
                            toastr.clear();
                            toastr.error(data.msg);
                            $('#form_submit').removeAttr('disabled');
                        }
                        $('#prepagemessage').hide();
                    },
                    error: function(jqXhr, json, errorThrown) {
                        toastr.clear();
                        var errors = jqXhr.responseJSON;
                        var errorsHtml = '';
                        $.each(errors.errors, function(key, value) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' +
                            errorThrown);
                        $('#prepagemessage').hide();
                        $('#form_submit').removeAttr('disabled');
                    },
                    fail: function() {
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
</div>
@endsection
