<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Menu;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class SlidersController extends Controller
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
             $url = url('/public/storage/slider/large');
             $data = Slider::all();
             return Datatables::of($data)
             ->editColumn('created_at', function($slider){
                return Carbon::parse($slider->created_at)->format('d-m-y h:i A');
            })

                     ->addColumn('checkboxAndId', function($slider) use (&$counter) {
                         return $counter++;
                     })

                    ->addColumn('status', function ($slider) {
                        $status = $slider->status == 1 ? 'checked' : '';
                        $cat=$slider->status;
                        $status = '<div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-'.$slider->id.'"  data-name="Slider" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$slider->id.',this.dataset.name)">
                                        <label class="custom-control-label" for="status-'.$slider->id.'"></label>
                                    </div>
                                </div>';
                        return $status;
                    })
                     ->addColumn('image',function($slider) use (&$url){
                        $imageurl=$url.'/'.$slider->image;
                        // $image='<p><img width=100 height=100 src="'.$imageurl.'"></p>';
                        $image='<p>
                                <a href="'.$imageurl.'" data-toggle="lightbox" data-title="'.$slider->first_title_en.'">
                                <img width=50 height=50 src="'.$imageurl.'" class="img-fluid mb-2" alt="white sample"/>
                                </a>
                                </p>';
                        return $image;
                    })
                     ->addColumn('action', function($slider){
                        $Edit='<a class="btn btn-sm btn-warning mr-1" href="'.route("sliders.edit", array($slider->id)).'" ><i class="fa fa-edit"></i></a>';
                        $Show='<a class="btn btn-sm btn-info mr-1" href="'.route("sliders.show", array($slider->id)).'"><i class="fa fa-eye"></i></a>';
                        $Delete='<a class="btn btn-sm btn-danger mr-1" onclick="confirmDelete('.$slider->id.')"><i class="fa fa-trash"></i></a>';
                        $Actions = $Edit.$Show.$Delete;
                        return $Actions;
                     })
                     ->rawColumns(['checkboxAndId','image','status','action'])
                     ->make(true);
         }
         return view('admin.slider.index',get_defined_vars());

        }

     public function showImage($id){
        $slider=Slider::find($id);
        return view('admin.slider.showImage',get_defined_vars());
     }

     public function changeGalleryStatus(Request $request)
     {
        try
         {
            $id=$request->id;
            $status=$request->status;
            if($status=="on"){
                $value=1;
            }else{
                $value=0;
            }
            $category=Slider::where('id',$id)->update(['status'=>$value]);
            if($category){
                $response['error'] = false;
                $response['msg'] = 'Gallery  status updated successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'There was a problem while deleting. Please try later.';
            }
        } catch (ValidationException $ex) {
            $response['error'] = true;
            $response['msg']   = $ex->validator->errors()->first();
        } catch ( Exception $ex )
        {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
        }
        return json_encode( $response );
     }



     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        $pages=Menu::with('children')->where(['parent_id'=>'0','status'=>1])->orderBy('sort_order','ASC')->get();
         return view('admin.slider.create',get_defined_vars());
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
            if ($request->hasFile('image')) {
                $requestImage = $request->file('image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'slider/';
                $thumbnailPath = 'public/slider/thumb/';
                $mediumPath = 'public/slider/medium/';
                $largePath = 'public/slider/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($mediumPath)) {
                    Storage::makeDirectory($mediumPath);
                }
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

                // Create a medium-sized image
                $medium = Image::make($requestImage->path());
                $medium->resize(100,100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                Storage::put($mediumPath . $image, $medium->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['image'] = $image;
            }
               $slider = Slider::create($requestData);
             if($slider){
                 $response['error'] = false;
                 $response['msg'] = 'The slider was created successfully!';
             } else {
                 $response['error'] = true;
                 $response['msg'] = 'The slider was not created.';
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
         $slider=Slider::find($id);
         return view('admin.slider.show',get_defined_vars());
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $slider = Slider::find($id);
         $pages=Menu::with('children')->where(['parent_id'=>'0','status'=>1])->orderBy('sort_order','ASC')->get();
         return view('admin.slider.edit',get_defined_vars());
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
             $slider = Slider::findOrFail($id);
             $this->validate($request, [
                 'sort_order' => 'required',
             ]);
             $requestData = $request->post();
             if ($request->hasFile('image')) {
                $requestImage = $request->file('image');
                $image = time() . '.' . $requestImage->getClientOriginalExtension();
                // Define the storage paths
                $storagePath = 'slider/';
                $thumbnailPath = 'public/slider/thumb/';
                $mediumPath = 'public/slider/medium/';
                $largePath = 'public/slider/large/';

                // Create the 'large' directory if it doesn't exist
                if (!Storage::exists($mediumPath)) {
                    Storage::makeDirectory($mediumPath);
                }
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

                // Create a medium-sized image
                $medium = Image::make($requestImage->path());
                $medium->resize(100,100, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                // Store the thumbnail in 'public' storage
                Storage::put($thumbnailPath . $image, $thumbnail->stream());
                Storage::put($mediumPath . $image, $medium->stream());
                // Store the original image in 'public' storage in the 'large' directory
                Storage::putFileAs($largePath, $requestImage, $image);
                // Update the image path in your database if needed
                $requestData['image'] = $image;
            }
            $slider->update($requestData);
             $response['error'] = false;
             $response['msg'] = 'The gallery was updated successfully!';
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
             $slider = Slider::findOrFail($id);
             if($slider->delete()){
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


     // delete multiple selects

     public function deleteSelected(Request $request)
 {
     $response = [];
     try {
         $selectedIds = $request->input('ids');
         $slider=Slider::whereIn('id', $selectedIds);
         if($slider->delete()){
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
