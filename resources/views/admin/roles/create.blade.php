<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel">Add User Group</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('roles.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-xs-12 form-group @error('name') has-error @enderror">
                <label for="name" class="control-label">Group Name <span class="mandatory"> * </span>:</label>
                <input class="form-control" placeholder="Enter Name" name="name" type="text" id="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" id="submit_form_request" type="submit" value="Save">
          </div>
    </form>
    <script>
        $(function () {
           $("#validate_form").validate({
               ignore: [],
               rules: {
                   'name': { required:true, normalizer: function(value) {return $.trim(value);},},
               },
               messages: {},
               submitHandler :function (form) {
                   var formData = new FormData(form);
                   $('#submit_form_request').attr('disabled', 'disabled');
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
                               window.location.href= '{{route('roles.index')}}';
                               toastr.clear();
                           }else{
                               toastr.clear();
                               toastr.error(data.msg);
                               $('#submit_form_request').removeAttr('disabled');
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
                           $('#submit_form_request').removeAttr('disabled');
                       },
                       fail:function(){
                           toastr.clear();
                           toastr.error("Something went wrong. Please try later.");
                           $('#prepagemessage').hide();
                           $('#submit_form_request').removeAttr('disabled');
                       }
                   });
                   return false;
               }
           });
       });
   </script>
  </div>
