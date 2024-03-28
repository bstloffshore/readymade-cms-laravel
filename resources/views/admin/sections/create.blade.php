<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel"><b>Add:: General Section</b></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('sections.store') }}" accept-charset="UTF-8" id="section_form" enctype="multipart/form-data">
        @csrf

            <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('section_title_en') has-error @enderror">
                <label for="section_title_en" class="control-label">Section Title(English) <span class="mandatory"> * </span>:</label>
                <input class="form-control" placeholder="Enter Section Title" name="section_title_en" type="text" id="section_title_en">
                @error('section_title_en')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('section_title_ar') has-error @enderror">
                <label for="section_title_ar" class="control-label">Section Title(Arabic):</label>
                <input class="form-control" placeholder="Enter Section Title" name="section_title_ar" type="text" id="section_title_ar">
                @error('section_title_ar')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 form-group @error('icon') has-error @enderror">
                <label for="highlight_en" class="control-label">Icon:</label>
                <input class="form-control" placeholder="Enter Section Title" name="icon" type="text" id="icon">
                @error('icon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-12 col-xs-12 form-group @error('icon_file') has-error @enderror">
                <label for="icon_file" class="control-label">Icon File:</label>
                <input class="form-control" placeholder="Enter Section Title" name="icon" type="file" id="icon_file">
                @error('icon_file')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group @error('status') has-error @enderror">
                <label for="status" class="control-label">Status <span class="mandatory"> * </span> :</label>
                <select id="status" name="status" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('sort_order') has-error @enderror">
                <label for="sort_order" class="control-label">Sort Order  <span class="mandatory"> * </span> :</label>
                <input class="form-control" placeholder="Enter Sort Order" name="sort_order" type="text" id="sort_order">
                @error('sort_order')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-12 col-xs-12 form-group @error('description_en') has-error @enderror">
                <label for="description_en" class="control-label">Description(English):</label>
                <textarea class="form-control" name="description_en" id="description_en" rows="3"></textarea>
                @error('description_en')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-12 col-xs-12 form-group @error('description_ar') has-error @enderror">
                <label for="description_ar" class="control-label">Description(Arabic) :</label>
                <textarea class="form-control" name="description_ar" id="description_ar" rows="3"></textarea>
                @error('description_ar')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" id="submit_section_request" type="submit" value="Submit">
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
           $("#section_form").validate({
               ignore: [],
               rules: {
                    'menu_id': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'category_title_en': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'sort_order': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'status': { required:true, normalizer: function(value) {return $.trim(value);},},
               },
               messages: {},
               submitHandler :function (form) {
                   var formData = new FormData(form);
                   $('#submit_section_request').attr('disabled', 'disabled');
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
                               window.location.href= '{{route('sections.index')}}';
                               toastr.clear();
                           }else{
                               toastr.clear();
                               toastr.error(data.msg);
                               $('#submit_section_request').removeAttr('disabled');
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
                           $('#submit_section_request').removeAttr('disabled');
                       },
                       fail:function(){
                           toastr.clear();
                           toastr.error("Something went wrong. Please try later.");
                           $('#prepagemessage').hide();
                           $('#submit_section_request').removeAttr('disabled');
                       }
                   });
                   return false;
               }
           });
       });
   </script>

  </div>
