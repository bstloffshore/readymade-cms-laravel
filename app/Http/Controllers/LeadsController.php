<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Exception;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
class LeadsController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $lead = 1;
             $data = Lead::all();
             return Datatables::of($data)
                     // ->addIndexColumn()
                     ->addColumn('checkboxAndId', function($country) use (&$lead) {
                         return $lead++;
                     })
                     ->addColumn('status', function ($lead) {
                         $status = $lead->status == 1 ? 'checked' : '';
                         $cat=$lead->status;
                         $status = '<div class="form-group">
                                     <div class="custom-control custom-switch">
                                         <input type="checkbox" class="custom-control-input" id="status-'.$lead->id.'"  data-name="Lead" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$lead->id.',this.dataset.name)">
                                         <label class="custom-control-label" for="status-'.$lead->id.'"></label>
                                     </div>
                                 </div>';
                         return $status;
                     })
                     ->addColumn('action', function($lead){
                         $Edit='<a class="btn btn-warning btn-sm mr-1" href="'.route("leads.edit", array($lead->id)).'" ><i class="fa fa-edit"></i></a>';
                        //  $Delete='<a class="btn btn-danger btn-sm mr-1" onclick="confirmDelete('.$lead->id.')"><i class="fa fa-trash"></i></a>';
                        //  $Show='<a class="btn btn-primary btn-sm mr-1" href="'.route("leads.show", array($lead->id)).'" ><i class="fa fa-eye"></i></a>';
                         return $Edit;

                     })
                     ->rawColumns(['checkboxAndId','status','action'])
                     ->make(true);
         }
         return view('admin.leads.index',get_defined_vars());
     }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead=Lead::find($id);
        return view('admin.leads.show',get_defined_vars());
    }

    public function edit($id)
    {
        $lead=Lead::find($id);
        return view('admin.leads.edit',get_defined_vars());
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
            $lead = Lead::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'phone'=>'required',
                'status'=>'required',
            ]);
            $requestData = $request->post();
            $lead->update($requestData);
            $response['error'] = false;
            $response['msg'] = trans('messages.country_updated');
        } catch (ValidationException $ex) {
            $response['error'] = true;
            $response['msg']   = $ex->validator->errors()->first();
            $this->log()->error( $response['msg'] );
        }catch(Exception $ex){
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
            $this->log()->error($response['msg']);
        }
        return json_encode($response);
    }
}
