@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}" @if($submenu->id==$menus->id) selected @endif>{{ $prefix }} {{ $submenu->menu_name }}</option>
    @if(count($submenu->children) > 0)
        @include('admin.menus.subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach

