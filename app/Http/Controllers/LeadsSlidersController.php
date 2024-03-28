<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadSlider;
use App\Models\Menu;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
class LeadsSlidersController extends Controller
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
             $url = url('/public/storage/lead-slider/large');
             $data = LeadSlider::all();
             return Datatables::of($data)
             ->editColumn('created_at', function($lead_slider){
                return Carbon::parse($lead_slider->created_at)->format('d-m-y h:i A');
            })

                     ->addColumn('checkboxAndId', function($lead_slider) use (&$counter) {
                         return $counter++;
                     })

                    ->addColumn('status', function ($lead_slider) {
                        $status = $lead_slider->status == 1 ? 'checked' : '';
                        $cat=$lead_slider->status;
                        $status = '<div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-'.$lead_slider->id.'"  data-name="LeadSlider" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$lead_slider->id.',this.dataset.name)">
                                        <label class="custom-control-label" for="status-'.$lead_slider->id.'"></label>
                                    </div>
                                </div>';
                        return $status;
                    })
                     ->addColumn('image',function($lead_slider) use (&$url){
                        $imageurl=$url.'/'.$lead_slider->image;
                        // $image='<p><img width=100 height=100 src="'.$imageurl.'"></p>';
                        $image='<p>
                                <a href="'.$imageurl.'" data-toggle="lightbox" data-title="'.$lead_slider->image_title.'">
                                <img width=50 height=50 src="'.$imageurl.'" class="img-fluid mb-2" alt="'.$lead_slider->image_alt.'"/>
                                </a>
                                </p>';
                        return $image;
                    })
                     ->addColumn('action', function($lead_slider){
                        $Edit='<a class="btn btn-sm btn-warning mr-1" href="'.route("lead-sliders.edit", array($lead_slider->id)).'" ><i class="fa fa-edit"></i></a>';
                        $Show='<a class="btn btn-sm btn-info mr-1" href="'.route("lead-sliders.show", array($lead_slider->id)).'"><i class="fa fa-eye"></i></a>';
                        $Delete='<a class="btn btn-sm btn-danger mr-1" onclick="confirmDelete('.$lead_slider->id.')"><i class="fa fa-trash"></i></a>';
                        $Actions = $Edit.$Show.$Delete;
                        return $Actions;
                     })
                     ->rawColumns(['checkboxAndId','image','status','action'])
                     ->make(true);
         }
         return view('admin.lead-slider.index',get_defined_vars());

        }





     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('admin.lead-slider.create',get_defined_vars());
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
                $thumbnailPath = 'public/lead-slider/thumb/';
                $mediumPath = 'public/lead-slider/medium/';
                $largePath = 'public/lead-slider/large/';
                $iamgeUpload=$this->uploadImage($requestImage,$thumbnailPath,$mediumPath,$largePath);
                $requestData['image'] = $iamgeUpload;
             }
               $slider = LeadSlider::create($requestData);
             if($slider){
                 $response['error'] = false;
                 $response['msg'] = 'The Lead slider was created successfully!';
             } else {
                 $response['error'] = true;
                 $response['msg'] = 'The Lead slider was not created.';
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
         $slider=LeadSlider::find($id);
         return view('admin.lead-slider.show',get_defined_vars());
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $slider = LeadSlider::find($id);
         return view('admin.lead-slider.edit',get_defined_vars());
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
             $slider = LeadSlider::findOrFail($id);
             $this->validate($request, [
                 'sort_order' => 'required',
             ]);
             $requestData = $request->post();
             if ($request->hasFile('image'))
             {
                $requestImage = $request->file('image');
                $thumbnailPath = 'public/lead-slider/thumb/';
                $mediumPath = 'public/lead-slider/medium/';
                $largePath = 'public/lead-slider/large/';
                $iamgeUpload=$this->uploadImage($requestImage,$thumbnailPath,$mediumPath,$largePath);
                $requestData['image'] = $iamgeUpload;
             }
            $slider->update($requestData);
             $response['error'] = false;
             $response['msg'] = 'The Lead Slider was updated successfully!';
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
             $slider = LeadSlider::findOrFail($id);
             if($slider->delete()){
                 $response['error'] = false;
                 $response['msg'] = 'The Lead Slider  deleted successfully!';
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
         $slider=LeadSlider::whereIn('id', $selectedIds);
         if($slider->delete()){
             $response['error'] = false;
             $response['msg'] = 'The Lead Slider  deleted successfully!';
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
