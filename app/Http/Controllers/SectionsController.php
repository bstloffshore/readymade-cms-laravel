<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Exception;
use Image;
use Illuminate\Support\Facades\File;
class SectionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sections=Section::all();
        return view('admin.sections.index',get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sections.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if(auth()->user()->can('data-add-general-sections')){
            $this->validate($request, [
                'section_title_en' => 'required',
                'sort_order' => 'required',
                'status' => 'required'
            ]);
            $requestData = $request->post();
            if ($request->hasFile('icon_file')) {
                $requestImage = $request->file('icon_file');
                $image = time() . '-' . $requestImage->getClientOriginalName();
                $destinationPath = public_path('/images/section/thumb');
                // Create the directory if it doesn't exist
                File::makeDirectory($destinationPath, 0755, true, true);
                $img = Image::make($requestImage->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image);
                $destinationPath = public_path('/images/section/large');
                $requestImage->move($destinationPath, $image);
                $requestData['icon_file'] = $image;
            }
            $generalSection = Section::create($requestData);
            if($generalSection){
                $response['error'] = false;
                $response['msg'] = 'The general section was created successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The general section was not created.';
            }
        } else {
            $response['error'] = true;
            $response['msg'] = 'Access denied.';
            }
        } catch ( Exception $ex ) {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
        }
        return json_encode($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        return view('admin.sections.show',get_defined_vars());
    }

    public function changePasswordByAdmin($id)
    {
        $generalSection = Section::find($id);
        return view('admin.sections.change-password',get_defined_vars());
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::with('generalSections')->find($id);
        return view('admin.sections.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        try {
            if(auth()->user()->can('update-spider-general-sections')){
                $id=$request->id;
        $this->validate($request, [
            'section_title_en' => 'required',
            'sort_order' => 'required',
            'status' => 'required'
        ]);
        $requestData = $request->post();
        $section = Section::find($id);
        if ($request->hasFile('icon_file')) {
            $requestImage = $request->file('icon_file');
            $image = time() . '-' . $requestImage->getClientOriginalName();
            $destinationPath = public_path('/images/section/thumb');
            // Create the directory if it doesn't exist
            File::makeDirectory($destinationPath, 0755, true, true);
            $img = Image::make($requestImage->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image);
            $destinationPath = public_path('/images/section/large');
            $requestImage->move($destinationPath, $image);
            $section->icon_file=$image;
            //dd($image);
        }else{
            $section->icon_file=$requestData['edit_icon_file'];

        }

        $section->update($requestData);
        $response['error'] = false;
        $response['msg'] = 'The general section was updated successfully!';
    } else {
        $response['error'] = true;
        $response['msg'] = 'Access denied.';
        }
    } catch ( Exception $ex ) {
        $response['error'] = true;
        $response['msg']   = $ex->getMessage();
        $this->log()->error( $response['msg'] );
    }
    return json_encode($response);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function destroy($id)
      {
          $response = [];
          try {
            if(auth()->user()->can('delete-general-sections')){
              $section = Section::findOrFail($id);
              if($section->delete()){
                  $response['error'] = false;
                  $response['msg'] = 'section  deleted successfully!';
              } else {
                  $response['error'] = true;
                  $response['msg'] = 'There was a problem while deleting. Please try later.';
              }
            } else {
                $response['error'] = true;
                $response['msg'] = 'Access denied.';
                }
          } catch(Exception $ex){
              $response['error'] = true;
              $response['msg'] = $ex->getMessage();
              $this->log()->error($response['msg']);
          }
          return json_encode($response);
      }


      public function deleteSelected(Request $request)
 {
     $response = [];
     try {
        if(auth()->user()->can('delete-general-sections')){
         $selectedIds = $request->input('ids');
         $generalSection=Section::whereIn('id', $selectedIds);
         if($generalSection->delete()){
             $response['error'] = false;
             $response['msg'] = 'customer  deleted successfully!';
         } else {
             $response['error'] = true;
             $response['msg'] = 'There was a problem while deleting. Please try later.';
         }
        } else {
            $response['error'] = true;
            $response['msg'] = 'Access denied.';
            }
     } catch(Exception $ex){
         $response['error'] = true;
         $response['msg'] = $ex->getMessage();
         $this->log()->error($response['msg']);
     }
     return json_encode($response);
 }
}
