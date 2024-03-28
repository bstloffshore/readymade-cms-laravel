@extends('layouts.adminLTE')
@section('pageTitle', 'Manage Office Location')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small>{{ __('office-location.create_title') }}</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashaboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('office-location.create_title') }}</li>
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
                            <form method="POST" action="{{ route('office-locations.update', ['office_location' => $officeLocation->id]) }}" accept-charset="UTF-8" id="office_location_form" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 form-group @error('menus_id') has-error @enderror">
                                        <label for="menus_id" class="control-label">Page <span class="mandatory"> * </span>
                                            :</label>
                                        <select id="menus_id" name="menus_id" class="form-control">
                                            <option value="">Select Page</option>
                                            @foreach($pages as $parent)
                                            <option value="{{ $parent->id }}"
                                                @if($parent->id==$officeLocation->menus_id) selected @endif>
                                                {{ $parent->menu_name_en }}
                                            </option>
                                            @if(count($parent->children) > 0)
                                            @include('admin.office-locations.edit-subtree', ['submenus' => $parent->children, 'prefix' => '--'])
                                            @endif
                                        @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="hidden" name="menu_slug">
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('icon_class') has-error @enderror">
                                        <label for="icon_class" class="control-label">Icon Class:</label>
                                        <input class="form-control" name="icon_class" type="text" id="icon_class" placeholder="Enter Icon class" value="{{ $officeLocation->icon_class }}">
                                        @error('icon_class')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                                        <label for="image" class="control-label">Icon Image :</label>
                                        <input class="form-control" name="image" type="file" id="image">
                                        <p><img src="{{ asset('public/storage/office-location/thumb') }}/{{ $officeLocation->image }}">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image_alt') has-error @enderror">
                                        <label for="image_alt" class="control-label">Image alt </label>
                                        <input class="form-control" placeholder="Enter banner image alt" name="image_alt" type="text"
                                            id="image_alt" value="{{ $officeLocation->image_alt }}">
                                        @error('image_alt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('first_title_en') has-error @enderror">
                                        <label for="first_title_en" class="control-label">First Title(English) <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="first_title_en" type="text" id="first_title_en" placeholder="Enter first title of address" value="{{ $officeLocation->first_title_en }}">
                                        @error('first_title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('first_title_ar') has-error @enderror">
                                        <label for="first_title_ar" class="control-label">First Title(Arabic):</label>
                                        <input class="form-control" name="first_title_ar" type="text" id="first_title_ar" placeholder="Enter First Title" value="{{ $officeLocation->first_title_ar }}">
                                        @error('first_title_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('second_title_en') has-error @enderror">
                                        <label for="second_title_en" class="control-label">Second Title(English)<span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="second_title_en" type="text" id="second_title_en" placeholder="Enter Second Title" value="{{ $officeLocation->second_title_en }}">
                                        @error('second_title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('second_title_ar') has-error @enderror">
                                        <label for="second_title_ar" class="control-label">Second Title(Arabic) <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="second_title_ar" type="text" id="second_title_ar" placeholder="Enter Second Title" value="{{ $officeLocation->second_title_ar }}">
                                        @error('second_title_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('third_title_en') has-error @enderror">
                                        <label for="third_title_en" class="control-label">Third Title(English) <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="third_title_en" type="text" id="third_title_en" placeholder="Enter Second Title" value="{{ $officeLocation->third_title_en }}">
                                        @error('third_title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('third_title_ar') has-error @enderror">
                                        <label for="third_title_ar" class="control-label">Third Title(Arabic) <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="third_title_ar" type="text" id="third_title_ar" placeholder="Enter Third Title" value="{{ $officeLocation->third_title_ar }}">
                                        @error('third_title_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('map_link') has-error @enderror">
                                        <label for="map_link" class="control-label">Map link:</label>
                                        <input class="form-control" name="map_link" type="text" id="map_link" placeholder="Enter map link" value="{{ $officeLocation->map_link }}">
                                        @error('map_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                                        <label for="sort_order" class="control-label">Sort order <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" name="sort_order" type="text" id="sort_order" placeholder="Enter sort order" value="{{ $officeLocation->sort_order }}">
                                        @error('sort_order')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">Status <span class="mandatory"> *
                                            </span>:</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1" {{ $officeLocation->status==1 ? 'selected':'' }}>Yes</option>
                                            <option value="0" {{ $officeLocation->status==0 ? 'selected':'' }}>No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="is_media_contact" class="control-label">Display in Media Contact Page :</label>
                                        <select id="is_media_contact" name="is_media_contact" class="form-control">
                                            <option value="1" {{ $officeLocation->is_media_contact==1 ? 'selected':'' }}>Yes</option>
                                            <option value="0" {{ $officeLocation->is_media_contact==0 ? 'selected':'' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary" id="submit_of_request" type="submit" value="Submit">
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
           $.validator.setDefaults({
               errorElement: "span",
               errorClass: "help-block",
               highlight: function (element, errorClass, validClass) {
                   var $element = $(element)
                       , $group = $element.closest('.form-group');

                   $group.removeClass('form-group--success').addClass('form-group--error');
                   $(element).closest('.form-group').addClass('has-error');
               },
               unhighlight: function (element, errorClass, validClass) {
                   var $element = $(element)
                       , $group = $element.closest('.form-group');

                   $group.removeClass('form-group--error').addClass('form-group--success');
                   $(element).closest('.form-group').removeClass('has-error');
               },
               errorPlacement: function (error, element) {
                   var data = element.data('selectric');

                   if(data){
                       error.appendTo( element.closest( '.' + data.classes.wrapper ).parent());
                   }else{
                       if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                           error.insertAfter(element.parent());
                       } else if(element.hasClass('select2-hidden-accessible')){
                           error.insertAfter(element.siblings('.select2'));
                       }  else if(element.hasClass('rating-input')){
                           error.insertAfter(element.parents('.rating-container'));
                       } else{
                           error.insertAfter(element);
                       }
                   }
               }
           });
           $.validator.addMethod("regxNoSplChar", function(value, element, regexpr) {
               if(value !== '')
                   return regexpr.test(value);
               else
                   return true;
           }, "Special characters not allowed.");
           $.validator.addMethod('mediaFileSize', function (value, element, param) {
               return this.optional(element) || (element.files[0].size <= param)
           }, "Image size should not exceed 2 MB");
           $("#office_location_form").validate({
               ignore: [],
               rules: {
                'first_title_en': {required: true,normalizer: function(value) { return $.trim(value);},},
                'second_title_en': {required: true,normalizer: function(value) { return $.trim(value);},},
                'third_title_en': {required: true,normalizer: function(value) { return $.trim(value);},},
                'sort_order': {required: true,normalizer: function(value) { return $.trim(value);},},
                'status': {required: true,normalizer: function(value) { return $.trim(value);},},
               },
               messages: {},
               submitHandler :function (form) {
                   var formData = new FormData(form);
                   $('#submit_of_request').attr('disabled', 'disabled');
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
                               window.location.href= '{{route('office-locations.index')}}';
                               toastr.clear();
                           }else{
                               toastr.clear();
                               toastr.error(data.msg);
                               $('#submit_of_request').removeAttr('disabled');
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
                           $('#submit_of_request').removeAttr('disabled');
                       },
                       fail:function(){
                           toastr.clear();
                           toastr.error("Something went wrong. Please try later.");
                           $('#prepagemessage').hide();
                           $('#submit_of_request').removeAttr('disabled');
                       }
                   });
                   return false;
               }
           });
       });

       /*------------------------------------------
            --------------------------------------------
            Department Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/

            function GetPositions(department_id){
                $("#position_id").html('');
                $.ajax({
                    url: '{{route('jobs.fetch-positions')}}',
                    type: "POST",
                    data: {department_id: department_id,_token: '{{csrf_token()}}'},
                    dataType: 'json',
                    success: function (result) {
                        $('#position_id').html('<option value="">-- Select Position --</option>');
                        $.each(result.positions, function (key, value) {
                            $("#position_id").append('<option value="' + value.id + '">' + value.position_name_en + '</option>');
                        });
                    }
                });
            }
   </script>

@endsection
