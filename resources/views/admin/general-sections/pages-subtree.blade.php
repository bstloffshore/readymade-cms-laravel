@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}">{{ $prefix }} {{ $submenu->menu_name_en }}</option>
    @if(count($submenu->children) > 0)
        @include('admin.general-sections.pages-subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach

