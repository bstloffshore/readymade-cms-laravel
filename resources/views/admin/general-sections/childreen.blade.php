
<ul>
        @foreach($subGeneralSections as $subGen)
        <li class="d-flex align-items-center">
            <small>{{ $subGen->category_title_en }}
                <a href="{{route('general-sections.show',$subGen->id)}}" data-toggle="modal" data-target="#ajaxModal">
                    <i class="fa fa-plus"></i></a>
                <a class="ml-2" href="{{route("general-sections.edit",$subGen->id)}}" data-toggle="modal" data-target="#ajaxModal">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="text-danger" style="cursor:pointer;" onclick="confirmSectionDelete({{$subGen->id}})">
                    <i class="fa fa-trash"></i></a>
            </small>
        </li>
        @php
         $sections=\App\Models\Section::where('general_sections_id',$subGen->id)->count();
         $sectionsData=\App\Models\Section::where('general_sections_id',$subGen->id)->get();
        @endphp
        @if($sections > 0)
        @foreach($sectionsData as $sections)
        <li class="d-flex align-items-center">
            <small>{{ $sections->section_title_en }}
                <a class="ml-2" href="{{route("general-sections.edit",$sections->id)}}" data-toggle="modal" data-target="#ajaxModal">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="text-danger" style="cursor:pointer;" onclick="confirmSectionDelete({{$sections->id}})">
                    <i class="fa fa-trash"></i></a>
            </small>
        </li>
        @endforeach
        @endif
        @endforeach

</ul>

