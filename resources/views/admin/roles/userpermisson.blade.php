@extends('layouts.master')
@section('pageTitle', 'Manage Roles')
@section('meta')
<style>
    /* Increase the size of the checkbox */
    .form-check-input.custom-checkbox {
      width: 24px;
      height: 24px;
      margin-right: 10px; /* Add some spacing between the checkbox and label */
    }
  </style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><small>User Roles / Permissions</small></h1>
            <small>Group Name of ({{ $role->name }})</small>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">User Roles / Permissions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
                <form method="POST" action="{{ route('roles.updateRole') }}" accept-charset="UTF-8" id="validate_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value={{ $role->id }}>
                    <input type="hidden" name="name" value={{ $role->name }}>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="country-data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">Sno</th>
                    <th>Module Name	</th>
                    <th>Assiged permissions list</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $count=1;
                    @endphp
                    @foreach ($moduleSettings as $moduleSetting )
                        <tr>
                            <td>{{ $count++; }}
                            <td>{{ $moduleSetting->module_name }} <small>({{ $moduleSetting->module_slug }})</small></td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input custom-checkbox" name="" id="select-all{{$moduleSetting->id}}" value="checkedValue">
                                    <label class="form-check-label"></label>
                                  </div>
                                <hr>
                                @foreach ($moduleSetting->permissions as $permission)
                                <label>
                                    <input type="checkbox" class="permissions{{ $permission->module_settings_id }}"
                                    name="permission[]"
                                    value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                    > {{ $permission->display_name }}
                                </label>
                                <br>
                                @endforeach
                            </td>
                        </tr>

                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                        <input class="btn btn-success" id="submit_form_request" type="submit" value="Allow Permissions">
                        <a role="button" href="{{route('roles.index')}}" class="link-primary">Cancel</a>

                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>



            </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script>
    $(function () {
        var data = {{ $moduleSettingIds }};
        data.forEach(function(item) {
            $('#select-all'+item).on('change', function() {
                $('.permissions'+item).prop('checked', this.checked);
            });
        });
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
                        //    window.location.href= '{{route('roles.index')}}';
                        window.location.reload();
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
@endsection


