@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.add_slider') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.add_slider') }}</li>
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
                            <form method="POST" action="{{ route('sliders.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('first_title_en') has-error @enderror">
                                        <label for="first_title_en" class="control-label">{{ __('slider.first_title_en') }} :</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.first_title_en') }}" name="first_title_en" type="text" id="first_title_en">
                                        @error('first_title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('title_ar') has-error @enderror">
                                        <label for="title_ar" class="control-label">{{ __('slider.first_title_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.first_title_ar') }}" name="title_ar" type="text"  id="title_ar">
                                        @error('title_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('second_title_en') has-error @enderror">
                                        <label for="second_title_en" class="control-label">{{ __('slider.second_title_en') }} :</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.second_title_en') }}" name="second_title_en" type="text" id="second_title_en">
                                        @error('second_title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('second_title_ar') has-error @enderror">
                                        <label for="second_title_ar" class="control-label">{{ __('slider.second_title_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.second_title_ar') }}" name="second_title_ar" type="text" id="second_title_ar">
                                        @error('second_title_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('third_title_en') has-error @enderror">
                                        <label for="third_title_en" class="control-label">{{ __('slider.third_title_en') }} :</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.third_title_en') }}" name="third_title_en" type="text" id="third_title_en">
                                        @error('third_title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('third_title_ar') has-error @enderror">
                                        <label for="third_title_ar" class="control-label">{{ __('slider.third_title_ar') }}:</label>
                                        <input class="form-control" placeholder="Enter {{ __('slider.third_title_ar') }}" name="third_title_ar" type="text"
                                            id="third_title_ar">
                                        @error('third_title_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                                        <label for="sort_order" class="control-label">{{ __('slider.sort_order') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="sort_order" type="text" id="sort_order" placeholder="Enter {{ __('slider.sort_order') }}">
                                        @error('sort_order')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('slider.status') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                                        <label for="image" class="control-label">{{ __('slider.image') }} <span class="mandatory"> * </span> :</label>
                                        <input class="form-control" name="image" type="file" id="image" onchange="previewImage(event)">
                                        <input type="button" class="btn btn-danger mt-3" onclick="cancelPreview()" value="Cancel">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2 col-xs-12 form-group @error('image_alt') has-error @enderror" id="previewContainer" class="mt-3">

                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image_alt') has-error @enderror">
                                        <label for="image_alt" class="control-label">{{ __('slider.image_alt') }} <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="image_alt" type="text" id="image_alt" placeholder="Enter {{ __('slider.image_alt') }}">
                                        @error('image_alt')
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
                    'image': {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        },
                    },
                    'image_alt': {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        },
                    },
                    'sort_order': {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        },
                    },
                    'status': {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        },
                    },
                },
                messages: {},
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    // $('#form_submit').attr('disabled', 'disabled');
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
                                window.location.href = '{{ route('sliders.index') }}';
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
                            // $('#form_submit').removeAttr('disabled');
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


function previewImage(event) {
    var input = event.target;
    var previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var imgElement = document.createElement('img');
            imgElement.setAttribute('src', e.target.result);
            imgElement.setAttribute('class', 'img-fluid');
            previewContainer.appendChild(imgElement);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function cancelPreview() {
    var previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';
}


    </script>

@endsection
