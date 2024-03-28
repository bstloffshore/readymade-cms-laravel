@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('menus.edit') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('menus.edit') }}</li>
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
                                <form method="POST" action="{{ route('menus.update', ['menu' => $menu->id]) }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('menu_name') has-error @enderror">
                                        <label for="menu_name" class="control-label">{{ __('menus.menu_name_en') }}:</label>
                                        <input class="form-control" placeholder="Enter Menu Name" name="menu_name_en" type="text" id="menu_name_en" value="{{$menu->menu_name_en}}">
                                        @error('menu_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('parent_id') has-error @enderror">
                                        <label for="parent_id" class="control-label">{{ __('menus.parent_name') }}:</label>
                                        <select id="parent_id" class="form-control" name="parent_id">
                                            <option value="0">Select Parent</option>
                                            @foreach($parents as $parent)
                                                <option value="{{ $parent->id }}"
                                                    @if($menu->parent_id!=0 && $parent->id==$menu->parent_id) selected @endif>
                                                    {{ $parent->menu_name_en }}
                                                </option>
                                                @if(count($parent->children) > 0)
                                                @include('admin.menus.edit-subtree', ['submenus' => $parent->children, 'prefix' => '--'])
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
                                        <input class="form-control" placeholder="Enter Menu Name" name="menu_name_ar" type="text" id="menu_name_ar" value="{{$menu->menu_name_ar}}">
                                        @error('menu_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('slug') has-error @enderror">
                                        <label for="slug" class="control-label">{{ __('menus.slug') }}:</label>
                                        <input class="form-control" placeholder="Enter Menu Slug" name="slug" type="text" id="slug" value="{{$menu->slug}}" readonly>
                                        @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('link') has-error @enderror">
                                        <label for="link" class="control-label">{{ __('menus.custom_link') }}</label>
                                        <input class="form-control" placeholder="Enter Custom link" name="link" type="text" id="link" value="{{$menu->link}}">
                                        @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('sort') has-error @enderror">
                                        <label for="page_name" class="control-label">{{ __('menus.sort_order') }}:</label>
                                        <input class="form-control" placeholder="Enter Sort Number" name="sort_order" type="text" id="sort_order" value="{{$menu->sort_order}}">
                                        @error('sort')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label">{{ __('menus.publish') }} <span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="">Select</option>
                                            <option value="1" @if($menu->status==1) selected @endif>Yes</option>
                                            <option value="0" @if($menu->status==0) selected @endif>No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="display_in_nav_bar" class="control-label">{{ __('menus.display_in_nav_bar') }}:</label>
                                        <select id="display_in_nav_bar" name="display_in_nav_bar" class="form-control" >
                                            <option value="0" @if($menu->display_in_nav_bar==0) selected @endif>No</option>
                                            <option value="1" @if($menu->display_in_nav_bar==1) selected @endif>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="display_in_seo" class="control-label">{{ __('menus.display_in_seo') }}:</label>
                                        <select id="display_in_seo" name="display_in_seo" class="form-control" >
                                            <option value="0" @if($menu->display_in_seo==0) selected @endif>No</option>
                                            <option value="1" @if($menu->display_in_seo==1) selected @endif>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="display_in_footer" class="control-label">{{ __('menus.display_in_footer') }}:</label>
                                        <select id="display_in_footer" name="display_in_footer" class="form-control" >
                                            <option value="0" @if($menu->display_in_footer==0) selected @endif>No</option>
                                            <option value="1" @if($menu->display_in_footer==1) selected @endif>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary" id="submit_menu_request" type="submit" value="Submit">
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

$('#slug').slugify('#menu_name_en');
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
$("#validate_form").validate({
ignore: [],
rules: {
   'menu_name_en': { required:true, normalizer: function(value) {return $.trim(value);},},
//    'slug': { required:true, normalizer: function(value) {return $.trim(value);},},
   'sort': {required:true, normalizer: function(value) {return $.trim(value);}},
},
messages: {

},
submitHandler :function (form) {
   var formData = new FormData(form);
   $('#submit_menu_request').attr('disabled', 'disabled');
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
               $('#submit_menu_request').removeAttr('disabled');
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
           $('#submit_menu_request').removeAttr('disabled');
       },
       fail:function(){
           toastr.clear();
           toastr.error("Something went wrong. Please try later.");
           $('#prepagemessage').hide();
           $('#submit_menu_request').removeAttr('disabled');
       }
   });
   return false;
}
});
});
</script>
</div>
@endsection
