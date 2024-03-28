@foreach($submenus as $submenu)
    <option value="{{ $submenu->id }}"
@if(@$submenu->id==$generalSection->parent_id) selected @endif>{{ $prefix }} {{ $submenu->category_title_en }} </option>
    @if(count($submenu->children) > 0)
        @include('admin.general-sections.edit-subtree', ['submenus' => $submenu->children, 'prefix' => $prefix.'--'])
    @endif
@endforeach
