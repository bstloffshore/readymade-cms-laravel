<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel">Show Country</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div>
        <table id="vertical-datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Country Name(English)</th>
                    <td>{{ $country->country_name_en }}</td>
                </tr>
                <tr>
                    <th>Country Name(Arabic)</th>
                    <td>{{ $country->country_name_ar }}</td>
                </tr>
                <tr>
                    <th>Country ISO Code(English)</th>
                    <td>{{ $country->country_iso_code_en }}</td>
                </tr>
                <tr>
                    <th>Country ISO Code(Arabic)</th>
                    <td>{{ $country->country_iso_code_ar }}</td>
                </tr>
                <tr>
                    <th>Country Slug</th>
                    <td>{{ $country->country_slug }}</td>
                </tr>
                <tr>
                    <th>Sort Order</th>
                    <td>{{ $country->sort_order }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>@if($country->status==1) Published @else In Active @endif</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>
