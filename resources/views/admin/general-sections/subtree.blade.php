@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}">{{ $prefix }} {{ $submenu->category_title_en }}</option>
    @if(count($submenu->children) > 0)
        @include('admin.general-sections.subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach

