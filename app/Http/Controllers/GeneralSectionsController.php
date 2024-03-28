<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSection;
use App\Models\Section;
use App\Models\Menu;
use Exception;
use Image;
use Illuminate\Support\Facades\File;
class GeneralSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $generalSections=GeneralSection::with('sections')->get();
        $generalSections=GeneralSection::with(['children','sections'])->where('parent_id','0')->orderBy('sort_order','asc')->get();

        $sections=Section::with('generalSections')->get();
        return view('admin.general-sections.index',get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pages=Menu::where(['status'=>1])->orderBy('sort','ASC')->get();
        $pages=Menu::with('children')->where(['status'=>1,'parent_id'=>'0'])->get();
        $parents=GeneralSection::with('children')->where('parent_id','0')->get();
        return view('admin.general-sections.create',get_defined_vars());
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

            $this->validate($request, [
                'category_title_en' => 'required',
                'menu_id' => 'required',
                'sort_order' => 'required',
                'status' => 'required'
            ]);
            $input = $request->all();
            $menus=Menu::where('id',$input['menu_id'])->first();
            $input['menu_slug']=$menus->slug;
            if ($request->hasFile('icon_file')) {
                $requestImage = $request->file('icon_file');
                $image = time() . '-' . $requestImage->getClientOriginalName();
                $destinationPath = public_path('/images/general-section/thumb');
                // Create the directory if it doesn't exist
                File::makeDirectory($destinationPath, 0755, true, true);
                $img = Image::make($requestImage->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image);
                $destinationPath = public_path('/images/general-section/large');
                $requestImage->move($destinationPath, $image);
                $input['icon_file'] = $image;
            }
            $generalSection = GeneralSection::create($input);
            if($generalSection){
                $response['error'] = false;
                $response['msg'] = 'The general section was created successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The general section was not created.';
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
        $generalSection = GeneralSection::find($id);
        return view('admin.general-sections.show',get_defined_vars());
    }

    public function changePasswordByAdmin($id)
    {
        $generalSection = GeneralSection::find($id);
        return view('admin.general-sections.change-password',get_defined_vars());
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generalSection = GeneralSection::find($id);
        $pages=Menu::with('children')->where('parent_id','0')->get();
        $parents=GeneralSection::with('children')->where('parent_id','0')->get();
        return view('admin.general-sections.edit',get_defined_vars());
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
        //  dd($request->all());
        try {


        $id=$request->id;
        $this->validate($request, [
            'category_title_en' => 'required'
        ]);
        $input = $request->post();

        $generalSection = GeneralSection::find($id);
        $menus=Menu::where('id',$input['menu_id'])->first();
        $input['menu_slug'] = $menus->slug;

        if ($request->hasFile('icon_file')) {
            $requestImage = $request->file('icon_file');
            $image = time() . '.' . $requestImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/general-section/thumb');
            // Create the directory if it doesn't exist
            File::makeDirectory($destinationPath, 0755, true, true);
            $img = Image::make($requestImage->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image);
            $destinationPath = public_path('/images/general-section/large');
            $requestImage->move($destinationPath, $image);
            $generalSection->icon_file=$image;
            //dd($image);
        }else{
            $generalSection->icon_file=$input['edit_icon_file'];

        }
        $generalSection->update($input);
        $response['error'] = false;
        $response['msg'] = 'The general section was updated successfully!';

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

              $generalSection = GeneralSection::findOrFail($id);
              if($generalSection->delete()){
                  $response['error'] = false;
                  $response['msg'] = 'customer  deleted successfully!';
              } else {
                  $response['error'] = true;
                  $response['msg'] = 'There was a problem while deleting. Please try later.';
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

         $selectedIds = $request->input('ids');
         $generalSection=GeneralSection::whereIn('id', $selectedIds);
         if($generalSection->delete()){
             $response['error'] = false;
             $response['msg'] = 'customer  deleted successfully!';
         } else {
             $response['error'] = true;
             $response['msg'] = 'There was a problem while deleting. Please try later.';
         }

     } catch(Exception $ex){
         $response['error'] = true;
         $response['msg'] = $ex->getMessage();
         $this->log()->error($response['msg']);
     }
     return json_encode($response);
 }
}
