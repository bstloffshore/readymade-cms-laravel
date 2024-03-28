@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}"
@if(@$submenu->id==$officeLocation->menus_id) selected @endif>{{ $prefix }} {{ $submenu->menu_name_en }} </option>
    @if(count($submenu->children) > 0)
        @include('admin.office-locations.edit-subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach
