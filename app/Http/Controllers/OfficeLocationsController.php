<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeLocation;
use App\Models\Menu;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class OfficeLocationsController extends Controller
{
    public function create()
    {
        $ofl=OfficeLocation::first();
        return view('admin.office-locations.create',get_defined_vars());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'address_en' => 'required',
                'email' => 'required',
            ]);
                $requestData = $request->post();
                $oflID=$requestData['id'];
                if($oflID==''){
                    $ofl = OfficeLocation::create($requestData);
                    if($ofl){
                    $response['error'] = false;
                    $response['msg'] = 'The office location was created successfully!';
                    } else {
                    $response['error'] = true;
                    $response['msg'] = 'The office location was not created.';
                    }
                }else{
                    $ofl = OfficeLocation::findOrFail($oflID);
                    $ofl->update($requestData);
                    $response['error'] = false;
                    $response['msg'] = 'The office location was updated successfully!';
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


}
