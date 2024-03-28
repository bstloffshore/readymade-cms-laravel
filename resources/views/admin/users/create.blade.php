<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel">Add User</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form autocomplete="off" method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6 col-xs-12 form-group">
                <label for="status" class="control-label">User Group <span class="mandatory"> * </span>:</label>
                <select id="roles" name="roles" class="form-control" >
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 col-xs-12 form-group @error('name') has-error @enderror">
                <label for="name" class="control-label">Username <span class="mandatory"> * </span>:</label>
                <input class="form-control" placeholder="Enter Username" name="name" type="text" id="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-6 col-xs-12 form-group @error('email') has-error @enderror">
                <label for="email" class="control-label">Email <span class="mandatory"> * </span> <small> (Login email) :</label>
                <input class="form-control" placeholder="Enter Email" name="email" type="text" id="email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-xs-12 form-group @error('phone') has-error @enderror">
                <label for="phone" class="control-label">Mobile <span class="mandatory"> * </span>:</label>
                <input class="form-control" name="phone" type="text" id="phone" placeholder="Enter Mobile">
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-5 col-xs-12 form-group @error('password') has-error @enderror">
                <label for="password" class="control-label">Password <span class="mandatory"> * </span>:</label>
                <input class="form-control" name="password" type="password" id="password" placeholder="Enter Password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-2 col-xs-12 form-group">
                <label for="status" class="control-label">Status <span class="mandatory"> * </span>:</label>
                <select id="status" name="status" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" id="submit_form_request" type="submit" value="Submit">
          </div>
    </form>
    <script>
        $(function () {
           $('#country_slug').slugify('#country_name_en');
           $("#validate_form").validate({
               ignore: [],
               rules: {
                   'name': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'email': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'password': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'phone': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'branch_location_id': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'roles': { required:true, normalizer: function(value) {return $.trim(value);},},
                   'status': { required:true, normalizer: function(value) {return $.trim(value);},},
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
                               window.location.href= '{{route('users.index')}}';
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

