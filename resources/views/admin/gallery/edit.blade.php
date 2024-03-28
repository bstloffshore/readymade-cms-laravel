
@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('breadcrumb.edit_gallery') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('breadcrumb.edit_gallery') }}</li>
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
    <form method="POST" action="{{ route('galleries.update', ['gallery' => $gallery->id]) }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
        @method('PUT')
        @csrf
            <input class="form-control" name="image_thumb_path" type="hidden" id="image_thumb_path">
            <input class="form-control" name="image_medium_path" type="hidden" id="image_medium_path">
            <input class="form-control" name="image_large_path" type="hidden" id="image_large_path">

        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('title_en') has-error @enderror">
                <label for="title_en" class="control-label">{{ __('gallery.title_en') }} <span class="mandatory"> * </span>:</label>
                <input class="form-control" placeholder="Enter {{ __('gallery.title_en') }}" name="title_en" type="text"  id="title_en" value="{{ $gallery->title_en }}">
                @error('title_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('title_ar') has-error @enderror">
                <label for="title_ar" class="control-label">{{ __('gallery.title_ar') }}:</label>
                <input class="form-control" placeholder="Enter {{ __('gallery.title_ar') }}" name="title_ar" type="text"   id="title_ar" value="{{ $gallery->title_ar }}">
                @error('title_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                <label for="image" class="control-label">{{ __('gallery.image') }} :</label>
                <input class="form-control" name="image" type="file" id="image" onchange="previewImage(event)">
                <p>
                    <a href="{{ $gallery->image_large_path }}{{ $gallery->image }}" data-toggle="lightbox" data-title="{{ $gallery->iamge_title_tag }}">
                        <img src="{{ $gallery->image_thumb_path }}{{ $gallery->image }}" class="img-fluid mb-2" alt="{{ $gallery->image_alt_text }}"/>
                    </a>
                </p>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-2 col-xs-12 form-group" id="previewContainer"></div>
            <div class="col-sm-4 col-xs-12 form-group cancelButton"  style="display:none;">
                <input type="button" onclick="cancelPreview()" value="Cancel Preview" class="btn btn-sm btn-danger mt-3 ">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('image_alt_text') has-error @enderror">
                <label for="image_alt_text" class="control-label">{{ __('gallery.image_alt_text') }} :</label>
                <input class="form-control" name="image_alt_text" type="text" id="image_alt_text"  placeholder="Enter Alt Text"  value="{{ $gallery->image_alt_text }}">
                @error('image_alt_text')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('iamge_title_tag') has-error @enderror">
                <label for="iamge_title_tag" class="control-label">{{ __('gallery.iamge_title_tag') }} :</label>
                <input class="form-control" name="iamge_title_tag" type="text" id="iamge_title_tag" placeholder="Enter {{ __('gallery.iamge_title_tag') }}" value="{{ $gallery->iamge_title_tag }}">
                @error('iamge_title_tag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                <label for="sort_order" class="control-label">{{ __('gallery.sort_order') }} <span class="mandatory"> * </span>:</label>
                <input class="form-control" name="sort_order" type="text" id="sort_order" placeholder="Enter Sort Order" value="{{ $gallery->sort_order }}">
                @error('sort_order')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group">
                <label for="status" class="control-label">{{ __('gallery.status') }} <span class="mandatory"> * </span>:</label>
                <select id="status" name="status" class="form-control" >
                    <option value="">Select</option>
                    <option value="1" @if($gallery->status==1) selected @endif>Yes</option>
                    <option value="0" @if($gallery->status==0) selected @endif>No</option>
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
    <script>
        $(function () {
           $("#validate_form").validate({
               ignore: [],
               rules: {
                'sort_order': { required:true, normalizer: function(value) {return $.trim(value);},},
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
                               window.location.href= '{{route('galleries.index')}}';
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
