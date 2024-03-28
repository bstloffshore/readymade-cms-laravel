@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small>{{ __('breadcrumb.add_ss') }}</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.add_ss') }}</li>
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
                            <form method="POST" action="{{ route('site-settings.store') }}"
                                accept-charset="UTF-8" id="siteSetting_form" enctype="multipart/form-data">
                                @csrf
                                @if($siteSetting!=null)
                                <input type="hidden" name="id" value="{{ $siteSetting->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('site_name_en') has-error @enderror">
                                        <label for="site_name_en" class="control-label">{{ __('site_settings.site_name_en') }} <span
                                                class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter {{ __('site_settings.site_name_en') }}" name="site_name_en"
                                            type="text" id="site_name_en"  @if($siteSetting!=null) value="{{ $siteSetting->site_name_en }}" @endif>
                                        @error('site_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('site_name_ar') has-error @enderror">
                                        <label for="site_name_ar" class="control-label">{{ __('site_settings.site_name_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter {{ __('site_settings.site_name_ar') }}" name="site_name_ar"
                                            type="text" id="site_name_ar" @if($siteSetting!=null) value="{{ $siteSetting->site_name_ar }}" @endif>
                                        @error('site_name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('site_url') has-error @enderror">
                                        <label for="site_url" class="control-label">{{ __('site_settings.site_url') }} :</label>
                                        <input class="form-control" placeholder="Enter {{ __('site_settings.site_url') }}" name="site_url"
                                            type="url" id="site_url" @if($siteSetting!=null) value="{{ $siteSetting->site_url }}" @endif>
                                        @error('site_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('contact_number') has-error @enderror">
                                        <label for="contact_number" class="control-label">{{ __('site_settings.contact_number') }} :</label>
                                        <input class="form-control" placeholder="Enter {{ __('site_settings.contact_number') }}" name="contact_number"
                                            type="text" id="contact_number" @if($siteSetting!=null) value="{{ $siteSetting->contact_number }}" @endif>
                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-sm-6 col-xs-12 form-group @error('telephone_number') has-error @enderror">
                                        <label for="telephone_number" class="control-label">{{ __('site_settings.telephone_number') }} :</label>
                                        <input class="form-control" name="telephone_number" type="text"
                                            id="telephone_number" placeholder="Enter {{ __('site_settings.telephone_number') }}" @if($siteSetting!=null) value="{{ $siteSetting->telephone_number }}" @endif>
                                        @error('telephone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('email') has-error @enderror">
                                        <label for="email" class="control-label">{{ __('site_settings.email') }}:</label>
                                        <input class="form-control" name="email" type="email" id="email"
                                            placeholder="Enter {{ __('site_settings.email') }}" @if($siteSetting!=null) value="{{ $siteSetting->email }}" @endif>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('facebook_url') has-error @enderror">
                                        <label for="facebook_url" class="control-label">{{ __('site_settings.facebook_url') }}:</label>
                                        <input class="form-control" name="facebook_url" type="text" id="facebook_url"
                                            placeholder="Enter {{ __('site_settings.facebook_url') }}" @if($siteSetting!=null) value="{{ $siteSetting->facebook_url }}" @endif>
                                        @error('facebook_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('twitter_url') has-error @enderror">
                                        <label for="twitter_url" class="control-label">{{ __('site_settings.twitter_url') }}:</label>
                                        <input class="form-control" name="twitter_url" type="text" id="twitter_url"
                                            placeholder="Enter {{ __('site_settings.twitter_url') }}" @if($siteSetting!=null) value="{{ $siteSetting->twitter_url }}" @endif>
                                        @error('twitter_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('instagram_url') has-error @enderror">
                                        <label for="instagram_url" class="control-label">{{ __('site_settings.instagram_url') }} :</label>
                                        <input class="form-control" name="instagram_url" type="text"
                                            id="instagram_url" placeholder="Enter {{ __('site_settings.instagram_url') }}" @if($siteSetting!=null) value="{{ $siteSetting->instagram_url }}" @endif>
                                        @error('instagram_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('youtube_url') has-error @enderror">
                                        <label for="youtube_url" class="control-label">{{ __('site_settings.youtube_url') }} :</label>
                                        <input class="form-control" name="youtube_url" type="text"
                                            id="youtube_url" placeholder="Enter {{ __('site_settings.youtube_url') }}" @if($siteSetting!=null) value="{{ $siteSetting->youtube_url }}" @endif>
                                        @error('youtube_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="disable" class="control-label">{{ __('site_settings.disable') }} :</label>
                                        <select id="disable" name="disable" class="form-control">
                                            <option value="0" @if($siteSetting!=null &&  $siteSetting->disable==0) selected @endif>No</option>
                                            <option value="1" @if($siteSetting!=null &&  $siteSetting->disable==1) selected @endif>Yes</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-6 col-xs-12 form-group @error('login_email') has-error @enderror">
                                        <label for="login_email" class="control-label">{{ __('site_settings.login_email') }}<small>(Please update login email in profile page)</small>:</label>
                                        <input class="form-control" type="text"
                                             placeholder="Enter {{ __('site_settings.login_email') }}" @if($siteSetting!=null) value="{{ $siteSetting->login_email }}" @endif readonly>
                                        @error('login_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('contactus_email') has-error @enderror">
                                        <label for="contactus_email" class="control-label">{{ __('site_settings.contactus_email') }}:</label>
                                        <input class="form-control" type="text"
                                             placeholder="Enter {{ __('site_settings.contactus_email') }}" @if($siteSetting!=null) value="{{ $siteSetting->contactus_email }}" @endif name="contactus_email" id="contactus_email">
                                        @error('contactus_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 col-xs-12 form-group @error('whats_app_number') has-error @enderror">
                                        <label for="whats_app_number" class="control-label">{{ __('site_settings.whats_app_number') }} :</label>
                                        <input class="form-control" name="whats_app_number" type="text"
                                            id="whats_app_number" placeholder="Enter {{ __('site_settings.whats_app_number') }}" @if($siteSetting!=null) value="{{ $siteSetting->whats_app_number }}" @endif>
                                        @error('whats_app_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('header_logo') has-error @enderror">
                                        <label for="header_logo" class="control-label">{{ __('site_settings.header_logo') }}:</label>
                                        <input class="form-control" name="header_logo" type="file"
                                            id="header_logo">
                                            @if($siteSetting!=null && $siteSetting->header_logo!=null)
                                            <p><img src="{{ asset('public/storage/site-settings/thumb') }}/{{ $siteSetting->header_logo }}"></p>
                                            @endif

                                        @error('header_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('footer_logo') has-error @enderror">
                                        <label for="footer_logo" class="control-label">{{ __('site_settings.footer_logo') }} :</label>
                                        <input class="form-control" name="footer_logo" type="file"
                                            id="footer_logo" placeholder="Enter Facebook URL">
                                            @if($siteSetting!=null && $siteSetting->footer_logo!=null)
                                            <p><img src="{{ asset('public/storage/site-settings/thumb') }}/{{ $siteSetting->footer_logo }}"></p>
                                            @endif
                                        @error('footer_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div
                                    class="col-sm-12 col-xs-12 form-group @error('company_address_en') has-error @enderror">
                                    <label for="company_address_en" class="control-label">{{ __('site_settings.company_address_en') }}:</label>
                                    <input class="form-control" name="company_address_en" type="text"
                                        id="company_address_en" placeholder="Enter {{ __('site_settings.company_address_en') }}" @if($siteSetting!=null) value="{{ $siteSetting->company_address_en }}" @endif>
                                    @error('company_address_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                class="col-sm-12 col-xs-12 form-group @error('company_address_ar') has-error @enderror">
                                <label for="company_address_ar" class="control-label">{{ __('site_settings.company_address_ar') }}:</label>
                                <input class="form-control" name="company_address_ar" type="text"
                                    id="company_address_ar" placeholder="Enter {{ __('site_settings.company_address_ar') }}" @if($siteSetting!=null) value="{{ $siteSetting->company_address_ar }}" @endif>
                                @error('company_address_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary" id="submit_ss_request" type="submit" value="Submit">
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
    $(function() {

        $("#siteSetting_form").validate({
            ignore: [],
            rules: {
                'site_name_en': {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
            },
            messages: {},
            submitHandler: function(form) {
                var formData = new FormData(form);
                $('#submit_ss_request').attr('disabled', 'disabled');
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
                            window.location.reload();
                            toastr.clear();
                        } else {
                            toastr.clear();
                            toastr.error(data.msg);
                            $('#submit_ss_request').removeAttr('disabled');
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
                        $('#submit_ss_request').removeAttr('disabled');
                    },
                    fail: function() {
                        toastr.clear();
                        toastr.error("Something went wrong. Please try later.");
                        $('#prepagemessage').hide();
                        $('#submit_ss_request').removeAttr('disabled');
                    }
                });
                return false;
            }
        });
    });
</script>
</div>
@endsection
