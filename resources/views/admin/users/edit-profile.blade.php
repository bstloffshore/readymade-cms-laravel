@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small>Manage Site Setting</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashaboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Site Setting</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.update-user-profile') }}"
                                accept-charset="UTF-8" id="user_form" enctype="multipart/form-data">
                                @csrf
                                @if($user!=null)
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 form-group @error('name') has-error @enderror">
                                        <label for="name" class="control-label">User Name <span
                                                class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter Name" name="name"
                                            type="text" id="name"  @if($user!=null) value="{{ $user->name }}" @endif>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xs-12 form-group @error('email') has-error @enderror">
                                        <label for="email" class="control-label">Login Email <span
                                                class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter Email" name="email"
                                            type="text" id="email"  @if($user!=null) value="{{ $user->email }}" @endif>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xs-12 form-group @error('profile_pic') has-error @enderror">
                                        <label for="profile_pic" class="control-label">Profile Pic <span
                                                class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="profile_pic" type="file" id="profile_pic">
                                            <p>

                                                @if($user->profile_pic!=null)
                                                <img src="{{ asset('public/images/profile-pic/thumb') }}/{{ $user->profile_pic }}">
                                                @else
                                                <img src="{{ asset('public/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" width="50px;">
                                                @endif
                                            </p>
                                            @error('profile_pic')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-xs-12 form-group @error('phone') has-error @enderror">
                                        <label for="phone" class="control-label">Mobile:</label>
                                        <input class="form-control" placeholder="Enter Site Name" name="phone"
                                            type="text" id="phone" @if($user!=null) value="{{ $user->phone }}" @endif>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-xs-12 form-group @error('password') has-error @enderror">
                                        <label for="password" class="control-label">Password <small>Leave blank in case dont want to update</small>:</label>
                                        <input class="form-control" placeholder="*****" name="password"
                                            type="password" id="password" >
                                        @error('password')
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
<script>
    $(function() {
        $.validator.setDefaults({
            errorElement: "span",
            errorClass: "help-block",
            highlight: function(element, errorClass, validClass) {
                var $element = $(element),
                    $group = $element.closest('.form-group');

                $group.removeClass('form-group--success').addClass('form-group--error');
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                var $element = $(element),
                    $group = $element.closest('.form-group');

                $group.removeClass('form-group--error').addClass('form-group--success');
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function(error, element) {
                var data = element.data('selectric');

                if (data) {
                    error.appendTo(element.closest('.' + data.classes.wrapper).parent());
                } else {
                    if (element.parent('.input-group').length || element.prop('type') ===
                        'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.siblings('.select2'));
                    } else if (element.hasClass('rating-input')) {
                        error.insertAfter(element.parents('.rating-container'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            }
        });
        $.validator.addMethod("regxNoSplChar", function(value, element, regexpr) {
            if (value !== '')
                return regexpr.test(value);
            else
                return true;
        }, "Special characters not allowed.");
        $.validator.addMethod('mediaFileSize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, "Image size should not exceed 2 MB");
        $("#user_form").validate({
            ignore: [],
            rules: {
                'name': {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
            },
            messages: {},
            submitHandler: function(form) {
                var formData = new FormData(form);
                // $('#submit_ss_request').attr('disabled', 'disabled');
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
