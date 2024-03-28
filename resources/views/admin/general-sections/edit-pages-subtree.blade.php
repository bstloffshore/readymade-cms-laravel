@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}"
@if(@$submenu->id==$generalSection->menu_id) selected @endif>{{ $prefix }} {{ $submenu->menu_name_en }} </option>
    @if(count($submenu->children) > 0)
        @include('admin.general-sections.edit-pages-subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach
