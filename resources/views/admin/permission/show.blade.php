<div class="modal-header">
    <h2 class="modal-title" id="ajaxModalLabel"><b>{{ $modelHeading }}</b></h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div>
        <table id="state-data" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Permission Name</th>
              <th>Permission Slug</th>
              <th>Permission name</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($modulesettings as $modulesetting)
                <tr>
                <td>{{ $modulesetting->display_name }}</td>
                <td>{{ $modulesetting->permission_slug }}</td>
                <td>{{ $modulesetting->name }}</td>

                <td>@if($modulesetting->status==1) Active @else Inactive @endif</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
  </div>

