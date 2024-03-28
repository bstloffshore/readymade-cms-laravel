<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\Menu;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
class SeoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request)
     {

         if ($request->ajax()) {
             $counter = 1;
             $url = url('/public/images/seo/thumb');
             $data = Seo::select('*');
             return Datatables::of($data)
             ->editColumn('created_on', function($seo){
                return Carbon::parse($seo->created_on)->format('d-m-y h:i A');
            })

                     ->addColumn('checkboxAndId', function($seo) use (&$counter) {
                         return '<input type="checkbox" name="seo_ids[]" value="'.$seo->id.'"> ' . $counter++;
                     })
                     ->addColumn('page_name', function($seo) {
                            return $seo->menu->menu_name_en;
                    })
                     ->addColumn('status', function ($seo) {
                        $status = $seo->status == 1 ? 'checked' : '';
                        $status = '<div class="form-group">
                                        <div class="custom-control custom-switch ">
                                            <input type="checkbox" class="custom-control-input" id="status-'.$seo->id.'"  name="status"  '.$status.' onclick="updateStatus(this.checked,'.$seo->id.')">
                                            <label class="custom-control-label" for="status-'.$seo->id.'"></label>
                                        </div>
                                    </div>';
                        return $status;
                    })
                     ->addColumn('action', function($seo){
                        $Edit='<a class="btn btn-warning btn-sm mr-1" href="'.route("seo.edit", array($seo->id)).'" ><i class="fa fa-edit"></i></a>';
                        $Delete='<a class="btn btn-sm btn-danger mr-1" onclick="confirmDelete('.$seo->id.')"><i class="fa fa-trash"></i></a>';
                        $Show='<a class="btn btn-info btn-sm mr-1" href="'.route("seo.show", array($seo->id)).'"><i class="fa fa-eye"></i></a>';
                        $Actions = $Edit.$Show.$Delete;
                        return $Actions;
                     })
                     ->rawColumns(['checkboxAndId','page_name','status','action'])
                     ->make(true);
         }
         return view('admin.seo.index',get_defined_vars());
     }





     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        $pages=Menu::with('children')->where(['parent_id'=>'0','status'=>1])->orderBy('sort_order','ASC')->get();
        return view('admin.seo.create',get_defined_vars());
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
                 'meta_title' => 'required',
                 'meta_description' => 'required',
                 'meta_keywords'=>'required',
                 'status' => 'required'

             ]);
             $requestData = $request->post();
             if ($request->hasFile('image')) {
                $requestImage = $request->file('image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'seo/';
                $thumbnailPath = 'public/seo/thumb/';
                $largePath = 'public/seo/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($largePath)) {
                    Storage::makeDirectory($largePath);
                }
                // Store the original image in 'public' storage
                // Storage::putFileAs($storagePath, $requestImage, $image);
                // Create a thumbnail
                $thumbnail = Image::make($requestImage->path());
                $thumbnail->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['image'] = $image;
            }
            if ($request->hasFile('og_image')) {
                $requestImage = $request->file('og_image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'seo/';
                $thumbnailPath = 'public/seo/thumb/';
                $largePath = 'public/seo/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($largePath)) {
                    Storage::makeDirectory($largePath);
                }
                // Store the original image in 'public' storage
                // Storage::putFileAs($storagePath, $requestImage, $image);
                // Create a thumbnail
                $thumbnail = Image::make($requestImage->path());
                $thumbnail->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['og_image'] = $image;
            }
               $seo = Seo::create($requestData);
             if($seo){
                 $response['error'] = false;
                 $response['msg'] = 'The seo was created successfully!';
             } else {
                 $response['error'] = true;
                 $response['msg'] = 'The seo was not created.';
             }
         } catch ( Exception $ex ) {
             $response['error'] = true;
             $response['msg']   = $ex->getMessage();
             $this->log()->error( $response['msg'] );
         }
         return json_encode( $response );
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         $seo=Seo::with('menu')->find($id);
         return view('admin.seo.show',get_defined_vars());
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $seo = Seo::find($id);
         $pages=Menu::with('children')->where(['parent_id'=>'0','status'=>1])->orderBy('sort_order','ASC')->get();
         return view('admin.seo.edit',get_defined_vars());
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
         try{
             $id=$request->id;
             $seo = Seo::findOrFail($id);
             $this->validate($request, [
                 'meta_title' => 'required',
                 'meta_description' => 'required',
                 'meta_keywords'=>'required',
             ]);
             $requestData = $request->post();
             if ($request->hasFile('image')) {
                $requestImage = $request->file('image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'seo/';
                $thumbnailPath = 'public/seo/thumb/';
                $largePath = 'public/seo/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($largePath)) {
                    Storage::makeDirectory($largePath);
                }
                // Store the original image in 'public' storage
                // Storage::putFileAs($storagePath, $requestImage, $image);
                // Create a thumbnail
                $thumbnail = Image::make($requestImage->path());
                $thumbnail->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['image'] = $image;
            }
            if ($request->hasFile('og_image')) {
                $requestImage = $request->file('og_image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'seo/';
                $thumbnailPath = 'public/seo/thumb/';
                $largePath = 'public/seo/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($largePath)) {
                    Storage::makeDirectory($largePath);
                }
                // Store the original image in 'public' storage
                // Storage::putFileAs($storagePath, $requestImage, $image);
                // Create a thumbnail
                $thumbnail = Image::make($requestImage->path());
                $thumbnail->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['og_image'] = $image;
            }
            $seo->update($requestData);
             $response['error'] = false;
             $response['msg'] = 'The seo was updated successfully!';
         }catch(Exception $ex){
             $response['error'] = true;
             $response['msg'] = $ex->getMessage();
             $this->log()->error($response['msg']);
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

             $seo = Seo::findOrFail($id);
             if($seo->delete()){
                 $response['error'] = false;
                 $response['msg'] = 'seo  deleted successfully!';
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


     // delete multiple selects

     public function deleteSelected(Request $request)
 {
     $response = [];
     try {
         $selectedIds = $request->input('ids');
         $seo=Seo::whereIn('id', $selectedIds);
         if($seo->delete()){
             $response['error'] = false;
             $response['msg'] = 'seo  deleted successfully!';
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
