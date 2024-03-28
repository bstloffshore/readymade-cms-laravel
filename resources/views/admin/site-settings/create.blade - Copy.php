<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel">Add Country</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('countries.store') }}" accept-charset="UTF-8" id="country_form" enctype="multipart/form-data">
        @csrf
        <div class="row card-body">
            <div class="col-sm-6 col-xs-12 form-group @error('country_name') has-error @enderror">
                <label for="country_name" class="control-label">Country Name(English) <span class="mandatory"> * </span>:</label>
                <input class="form-control" placeholder="Enter Country Name" name="country_name_en" type="text" id="country_name_en">
                @error('country_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-6 col-xs-12 form-group @error('country_name_ar') has-error @enderror">
                <label for="country_name_ar" class="control-label">Country Name(Arabic):</label>
                <input class="form-control" placeholder="Enter Country Name" name="country_name_ar" type="text" id="country_name_ar">
                @error('country_name_ar')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('country_iso_code_en') has-error @enderror">
                <label for="country_iso_code_en" class="control-label">Country ISO Code(English) <span class="mandatory"> * </span> :</label>
                <input class="form-control" placeholder="Enter Country Name" name="country_iso_code_en" type="text" id="country_iso_code_en">
                @error('country_iso_code_en')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('country_iso_code_ar') has-error @enderror">
                <label for="country_iso_code_ar" class="control-label">Country ISO Code(Arabic)  :</label>
                <input class="form-control" placeholder="Enter Country Name" name="country_iso_code_ar" type="text" id="country_iso_code_ar">
                @error('country_iso_code_ar')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row card-body">
            <div class="col-sm-5 col-xs-12 form-group @error('slug') has-error @enderror">
                <label for="slug" class="control-label">Slug <span class="mandatory"> * </span>:</label>
                <input class="form-control" name="country_slug" type="text" id="country_slug" placeholder="Enter Slug" readonly>
                @error('slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-5 col-xs-12 form-group @error('sort_order') has-error @enderror">
                <label for="sort_order" class="control-label">Sort Order <span class="mandatory"> * </span>:</label>
                <input class="form-control" name="sort_order" type="text" id="sort_order" placeholder="Enter Sort Order">
                @error('sort_order')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-2 col-xs-12 form-group">
                <label for="status" class="control-label">Publish <span class="mandatory"> * </span>:</label>
                <select id="status" name="status" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" id="submit_country_request" type="submit" value="Submit">
          </div>
    </form>
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
           $("#country_form").validate({
               ignore: [],
               rules: {
                   'country_name_en': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'country_iso_code_en': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'country_slug': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'sort_order': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'status': { required:true, normalizer: function(value) {return $.trim(value);},},
               },
               messages: {},
               submitHandler :function (form) {
                   var formData = new FormData(form);
                   $('#submit_country_request').attr('disabled', 'disabled');
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
                               window.location.href= '{{route('countries.index')}}';
                               toastr.clear();
                           }else{
                               toastr.clear();
                               toastr.error(data.msg);
                               $('#submit_country_request').removeAttr('disabled');
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
                           $('#submit_country_request').removeAttr('disabled');
                       },
                       fail:function(){
                           toastr.clear();
                           toastr.error("Something went wrong. Please try later.");
                           $('#prepagemessage').hide();
                           $('#submit_country_request').removeAttr('disabled');
                       }
                   });
                   return false;
               }
           });
       });
   </script>

  </div>
