
@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>{{ __('categories.edit_title') }}</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ __('categories.edit_title') }}</li>
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

                                <form method="POST" action="{{ route('seo.update', ['seo' => $seo->id]) }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                <input type="hidden" name="id" value="{{$seo->id}}">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="menu_id" class="control-label">Pages <span class="mandatory"> * </span>:</label>
                                        <select id="menus_id" name="menus_id" class="form-control">
                                            <option value="">Select Page</option>
                                            @foreach($pages as $parent)
                                                <option value="{{ $parent->id }}"
                                                    @if($parent->id==$seo->menus_id) selected @endif>
                                                    {{ $parent->menu_name_en }}
                                                </option>
                                                @if(count($parent->children) > 0)
                                                @include('admin.seo.edit-subtree', ['submenus' => $parent->children, 'prefix' => '--'])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_title') has-error @enderror">
                                        <label for="meta_title" class="control-label">Meta Title <span class="mandatory"> * </span>:</label>
                                        <input class="form-control" placeholder="Enter title" name="meta_title" type="text" id="meta_title" value="{{$seo->meta_title}}">
                                        @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_main_heading') has-error @enderror">
                                        <label for="meta_main_heading" class="control-label">Main heading :</label>
                                        <input type="text" name="meta_main_heading" id="meta_main_heading" class="form-control" value="{{$seo->meta_main_heading}}">
                                        @error('meta_main_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_sub_heading') has-error @enderror">
                                        <label for="meta_sub_heading" class="control-label">Sub heading :</label>
                                        <input type="text" name="meta_sub_heading" id="meta_sub_heading" class="form-control" value="{{$seo->meta_sub_heading}}" >
                                        @error('meta_sub_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('canonical_url') has-error @enderror">
                                        <label for="canonical_url" class="control-label">Canonical :</label>
                                        <input type="text" name="canonical_url" id="canonical_url" class="form-control" value="{{$seo->canonical_url}}">
                                        @error('canonical_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image') has-error @enderror">
                                        <label for="image" class="control-label">Image :</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        @if ($seo->image!=null)
                                        <p><img src="{{ asset('public/storage/seo/thumb') }}/{{ $seo->image }}"></p>
                                        @endif
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('image_alt') has-error @enderror">
                                        <label for="image_alt" class="control-label">Image Alt :</label>
                                        <input type="text" name="image_alt" id="image_alt" class="form-control" value="{{$seo->meta_sub_heading}}">
                                        @error('image_alt')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group">
                                        <label for="status" class="control-label"> Status<span class="mandatory"> * </span>:</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="1" @if($seo->status==1) selected @endif>Yes</option>
                                            <option value="0" @if($seo->status==0) selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_description') has-error @enderror">
                                        <label for="meta_description" class="control-label"> Meta Description<span class="mandatory"> * </span> :</label>
                                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{$seo->meta_description}}</textarea>
                                        @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('meta_keywords') has-error @enderror">
                                        <label for="meta_keywords" class="control-label">Meta Keywords<span class="mandatory"> * </span> :</label>
                                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3">{{$seo->meta_keywords}}</textarea>
                                        @error('meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('robots') has-error @enderror">
                                        <label for="robots" class="control-label">Robots :</label>
                                        <input type="text" name="robots" id="robots" class="form-control" value="{{$seo->robots}}">
                                        @error('robots')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_title') has-error @enderror">
                                        <label for="og_title" class="control-label">OG:Title :</label>
                                        <input type="text" name="og_title" id="og_title" class="form-control" value="{{$seo->og_title}}">
                                        @error('og_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_url') has-error @enderror">
                                        <label for="og_url" class="control-label">OG:URL :</label>
                                        <input type="text" name="og_url" id="og_url" class="form-control" value="{{$seo->og_url}}">
                                        @error('og_url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_image') has-error @enderror">
                                        <label for="og_image" class="control-label">OG:Image :</label>
                                        <input type="file" name="og_image" id="og_image" class="form-control">
                                        @if ($seo->og_image!=null)
                                        <p><img src="{{ asset('public/storage/seo/thumb') }}/{{ $seo->og_image }}"></p>
                                        @endif
                                        @error('og_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_type') has-error @enderror">
                                        <label for="og_type" class="control-label">OG:Type :</label>
                                        <input type="text" name="og_type" id="og_type" class="form-control" value="{{$seo->og_type}}">
                                        @error('og_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-12 form-group @error('og_locale') has-error @enderror">
                                        <label for="og_locale" class="control-label">OG:Locale :</label>
                                        <input type="text" name="og_locale" id="og_locale" class="form-control" value="{{$seo->og_locale}}">
                                        @error('og_locale')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-12 form-group @error('og_description') has-error @enderror">
                                        <label for="og_description" class="control-label">OG:Description :</label>
                                        <textarea class="form-control" name="og_description" id="og_description" rows="3">{{$seo->og_description}}</textarea>
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
           $('#seo_slug').slugify('#meta_title');

           $("#validate_form").validate({
               ignore: [],
               rules: {
                'meta_title': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'meta_description': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'meta_keywords': { required:true, normalizer: function(value) {return $.trim(value);},},
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
