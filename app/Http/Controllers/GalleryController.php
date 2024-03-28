<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Menu;
use Intervention\Image\Facades\Image;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
class GalleryController extends Controller
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
             $url = url('/public/storage/gallery/thumb');
             $data = Gallery::get();
             return Datatables::of($data)
             ->editColumn('created_at', function($gallery){
                return Carbon::parse($gallery->created_at)->format('d-m-y h:i A');
            })

                     ->addColumn('checkboxAndId', function($gallery) use (&$counter) {
                         return $counter++;
                     })

                    ->addColumn('status', function ($gallery) {
                        $status = $gallery->status == 1 ? 'checked' : '';
                        $cat=$gallery->status;
                        $status = '<div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-'.$gallery->id.'"  data-name="Gallery" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$gallery->id.',this.dataset.name)">
                                        <label class="custom-control-label" for="status-'.$gallery->id.'"></label>
                                    </div>
                                </div>';
                        return $status;
                    })
                     ->addColumn('image',function($gallery) use (&$url){
                        $imageurl=$url.'/'.$gallery->image;
                        $image='<p><img src="'.$imageurl.'"></p>';
                        return $image;
                    })
                    ->addColumn('thumb_image',function($gallery) use (&$url){
                        $image=$url.'/'.$gallery->thumb_image;
                        $web_image='<p><img src="'.$image.'"></p>';
                        return $web_image;
                    })
                     ->addColumn('action', function($gallery){
                        $Edit='<a class="btn btn-sm btn-seconday edit-color table-actions" href="'.route("galleries.edit", array($gallery->id)).'" ><i class="fa fa-edit"></i></a>';
                        $Show='<a class="btn btn-sm btn-info table-actions" href="'.route("galleries.show", array($gallery->id)).'"><i class="fa fa-eye"></i></a>';
                        $Delete='<a class="btn btn-sm btn-danger table-actions" onclick="confirmDelete('.$gallery->id.')"><i class="fa fa-trash"></i></a>';
                        $Actions = $Edit.$Show.$Delete;
                        return $Actions;
                     })
                     ->rawColumns(['checkboxAndId','image','thumb_image','status','action'])
                     ->make(true);
         }
         return view('admin.gallery.index',get_defined_vars());
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('admin.gallery.create',get_defined_vars());
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
                 'image' => 'required',
                 'sort_order' => 'required',
                 'status' => 'required'
             ]);
             $requestData = $request->post();
             if ($request->hasFile('image'))
             {
                $requestImage = $request->file('image');
                $thumbnailPath = 'public/gallery/thumb/';
                $mediumPath = 'public/gallery/medium/';
                $largePath = 'public/gallery/large/';
                $iamgeUpload=$this->uploadImage($requestImage,$thumbnailPath,$mediumPath,$largePath);
                $requestData['image'] = $iamgeUpload;
             }
            $requestData['image_thumb_path']=env('GALLERY_THUMB_IMAGE_PATH');
            $requestData['image_medium_path']=env('GALLERY_MEDIUM_IMAGE_PATH');
            $requestData['image_large_path']=env('GALLERY_LARGE_IMAGE_PATH');
            $gallery = Gallery::create($requestData);
             if($gallery){
                 $response['error'] = false;
                 $response['msg'] = trans('messages.gallery_created_true');
             } else {
                 $response['error'] = true;
                 $response['msg'] = trans('messages.gallery_created_false');
             }
            } catch (ValidationException $ex) {
                $response['error'] = true;
                $response['msg']   = $ex->validator->errors()->first();
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
         $gallery=Gallery::find($id);
         return view('admin.gallery.show',get_defined_vars());
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $gallery = Gallery::find($id);
         return view('admin.gallery.edit',get_defined_vars());
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request,$id)
     {
         try{
             $gallery = Gallery::findOrFail($id);
             $this->validate($request, [
                 'sort_order' => 'required',
             ]);
             $requestData = $request->post();

             if ($request->hasFile('image'))
             {
                $requestImage = $request->file('image');
                $thumbnailPath = 'public/gallery/thumb/';
                $mediumPath = 'public/gallery/medium/';
                $largePath = 'public/gallery/large/';
                $iamgeUpload=$this->uploadImage($requestImage,$thumbnailPath,$mediumPath,$largePath);
                $requestData['image'] = $iamgeUpload;
             }

             $requestData['image_thumb_path']=env('GALLERY_THUMB_IMAGE_PATH');
             $requestData['image_medium_path']=env('GALLERY_MEDIUM_IMAGE_PATH');
             $requestData['image_large_path']=env('GALLERY_LARGE_IMAGE_PATH');

             $gallery->update($requestData);
             $response['error'] = false;
             $response['msg'] = trans('messages.gallery_updated');
        } catch (ValidationException $ex) {
             $response['error'] = true;
             $response['msg']   = $ex->validator->errors()->first();
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
             $gallery = Gallery::findOrFail($id);
             if($gallery->delete()){
                 $response['error'] = false;
                 $response['msg'] = trans('messages.gallery_deleted_true');
             } else {
                 $response['error'] = true;
                 $response['msg'] = trans('messages.gallery_deleted_false');
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
         $gallery=Gallery::whereIn('id', $selectedIds);
         if($gallery->delete()){
             $response['error'] = false;
             $response['msg'] = 'gallery  deleted successfully!';
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
