<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel"><b>{{ $modelHeading }}</b></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('module-settings.updateModuleSetting') }}" accept-charset="UTF-8" id="ms_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$moduleSetting->id}}">
        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('module_name') has-error @enderror">
                <label for="module_name" class="control-label">Module Name:</label>
                <input class="form-control" placeholder="Enter Module name" name="module_name" type="text" id="module_name" value="{{$moduleSetting->module_name}}">
                @error('module_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('module_slug') has-error @enderror">
                <label for="module_slug" class="control-label">Module Slug:</label>
                <input class="form-control" placeholder="Enter module slug" name="module_slug" type="text" id="module_slug" value="{{$moduleSetting->module_slug}}" readonly>
                @error('module_slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
@if($permissions->isEmpty())
<input type="hidden" name="num_i" id="num_i1" value="1" />
{{-- Start the Add Dynamic Attributes --}}
<div class="row">
    <div class="col-md-1 d-flex align-items-center justify-content-center">
        <div>
            <button type="button" class="btn btn-success" onclick="addAttribute(1)">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('display_name') has-error @enderror">
        <label for="display_name" class="control-label">Permissoin Name:</label>
        <input class="form-control" placeholder="Enter Name" name="display_name[]" type="text" id="display_name">
        @error('display_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('permission_slug') has-error @enderror">
        <label for="permission_slug" class="control-label">Permission Slug:</label>
        <input class="form-control" name="permission_slug[]" type="text" id="permission_slug" placeholder="Enter Slug" readonly>
        @error('permission_slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3 col-xs-12 form-group">
        <label for="status" class="control-label">Status:</label>
        <div class="checkbox">
            <input checked="checked" name="status[]" type="checkbox" id="status">
        </div>
    </div>
</div>
<div id="dynamic_field" width="100%"></div>
@else
<div class="row">
    <div class="col-md-1 d-flex align-items-center justify-content-center">
        <div>
            <button type="button" class="btn btn-success" onclick="addAttribute(1)">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('display_name') has-error @enderror">
        <label for="display_name" class="control-label">Permissoin Name:</label>
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('permission_slug') has-error @enderror">
        <label for="permission_slug" class="control-label">Permission Slug:</label>
    </div>
    <div class="col-sm-3 col-xs-12 form-group">
        <label for="status" class="control-label">Status:</label>
    </div>
</div>
@foreach($permissions as $permission)
<input type="hidden" name="num_i" id="num_i1" value="1" />

<div class="row">
    <div class="col-md-1 d-flex align-items-center justify-content-center">
        {{-- <div>
            <button type="button" class="btn btn-success" onclick="addAttribute(1)">
                <i class="fa fa-plus"></i>
            </button>
        </div> --}}
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('display_name') has-error @enderror">
        <input class="form-control" placeholder="Enter Name" name="display_name[]" type="text" id="display_name{{ $permission->id }}" value="{{$permission->display_name}}">
        @error('display_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-4 col-xs-12 form-group @error('permission_slug') has-error @enderror">
        <input class="form-control" name="permission_slug[]" type="text" id="permission_slug{{ $permission->id }}" placeholder="Enter Slug" value="{{$permission->permission_slug}}" readonly>
        @error('permission_slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-3 col-xs-12 form-group">
        <div class="checkbox">
            <input  name="status[]" type="checkbox" id="status" @if($permission->status==1) checked @endif>
        </div>
    </div>
</div>
@endforeach
<div id="dynamic_field" width="100%"></div>
@endif
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" id="submit_ms_request" type="submit" value="Submit">
          </div>
    </form>
    @include('partials.submitValidationLinks')
    <script>
        $(function () {
            $('#module_slug').slugify('#module_name');
            $('#permission_slug').slugify('#display_name');

                var data = {{ $permissionIds }};
                data.forEach(function(item) {
                    $('#permission_slug'+item).slugify('#display_name'+item);
                });


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
           $("#ms_form").validate({
               ignore: [],
               rules: {
                   'module_name': { required:true, normalizer: function(value) {return $.trim(value);},},
               },
               messages: {},
               submitHandler :function (form) {
                   var formData = new FormData(form);
                   $('#submit_ms_request').attr('disabled', 'disabled');
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
                               window.location.href= '{{route('module-settings.index')}}';
                               toastr.clear();
                           }else{
                               toastr.clear();
                               toastr.error(data.msg);
                               $('#submit_ms_request').removeAttr('disabled');
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
                           $('#submit_ms_request').removeAttr('disabled');
                       },
                       fail:function(){
                           toastr.clear();
                           toastr.error("Something went wrong. Please try later.");
                           $('#prepagemessage').hide();
                           $('#submit_ms_request').removeAttr('disabled');
                       }
                   });
                   return false;
               }
           });
       });
   </script>
<script>
    var i=$("#num_i1").val();

    function addAttribute(r_id)
    {
      i++;
      console.log(i);
      $('#dynamic_field').append(
                '<div class="row">'+
                    '<div class="col-md-1 d-flex align-items-center justify-content-center" id="rm_div'+i+'">'+
                        '<div>'+
                        '<a class="text-danger custom-pointer" id="remove'+i+'" onclick="remove('+i+')"><i class="fa fa-trash"></i></a>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-4 col-xs-12 form-group @error('display_name') has-error @enderror">'+
                            ' <input class="form-control" placeholder="Enter Name" name="display_name[]" type="text" id="display_name'+i+'">'+
                            '</div>'+
                            '<div class="col-sm-4 col-xs-12 form-group @error('permission_slug') has-error @enderror">'+
                                    '<input class="form-control" name="permission_slug[]" type="text" id="permission_slug'+i+'" placeholder="Enter Slug" readonly>'+
                                '</div>'+
                                '<div class="col-sm-3 col-xs-12 form-group @error('status') has-error @enderror">'+
                                '<div class="checkbox">'+
                                '<input type="checkbox" name="status[]" id="status" checked>'+
                                '</div>'+
                                '</div>'+
                        '</div>'
             );
             $('#permission_slug'+i).slugify('#display_name'+i);
    }

    function remove(r_id)
    {
      if(confirm("Are you sure you want to remove Attribute#"+r_id+"?"))
      {
       if(r_id<i)
      {
          location.reload();
      }
      else
      {
          //alert("last");
      }
      var div = document.getElementById("rm_div"+r_id+"");
      div.parentNode.remove(div);
      i--;
      }

    }
    </script>
  </div>
