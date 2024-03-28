@foreach($subGeneralSections as $subGen)
<ul class="tree">
    @php
    $sections=\App\Models\Section::where('general_sections_id',$subGen->id)->count();
    $sectionsData=\App\Models\Section::where('general_sections_id',$subGen->id)->orderBy('sort_order','asc')->get();
   @endphp
    <li class="parent">
        <span>{{ $subGen->category_title_en }}</span>
        <div class="actions">
            <small>

            <a class="action btn btn-sm btn-success" href="{{route('general-sections.show',$subGen->id)}}" title="Add Under {{ $subGen->category_title_en }}" data-toggle="modal" data-target="#ajaxModal">
                <i class="fa fa-plus"></i></a>


            <a title="Edit {{ $subGen->category_title_en }}" class="ml-2 btn btn-warning btn-sm" href="{{route("general-sections.edit",$subGen->id)}}" data-toggle="modal" data-target="#ajaxModal">
                <i class="fas fa-edit"></i>
            </a>


            <a title="Delete {{ $subGen->category_title_en }}" class="btn btn-sm btn-danger" style="cursor:pointer;" onclick="confirmGeneralSectionDelete({{$subGen->id}})">
              <i class="fa fa-trash"></i></a>

            </small>
        </div>
        @if($sections > 0)
        @foreach($sectionsData as $sections)
        <ul class="tree">
            <li class="child">
                <span>{{ $sections->section_title_en }}</span>
                <div class="actions">
                    <small>

                    <a class="btn btn-sm edit-color" title="Edit {{ $sections->section_title_en }}" class="ml-2" href="{{route("sections.edit",$sections->id)}}" data-toggle="modal" data-target="#ajaxModal">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a title="Delete {{ $sections->section_title_en }}" class="btn btn-sm btn-danger" style="cursor:pointer;" onclick="confirmSectionDelete({{$sections->id}})">
                        <i class="fa fa-trash"></i></a>

                    </small>
                </div>
            </li>
        </ul>
        @endforeach
        @endif
    </li>

</ul>
@endforeach
