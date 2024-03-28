<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Region;
class ChangeStatusController extends Controller
{
    public function changeStatus(Request $request)
     {
        try
         {
            $brandId=$request->id;
            $modelClassName = 'App\Models\\' . $request->modelClassName;
            $status=$request->status;
            if($status=="on"){
                $value=1;
            }else{
                $value=0;
            }
            if (class_exists($modelClassName)) {
                $model = new $modelClassName();
                $modelStatus=$model->where('id', $brandId)->update(['status' => $value]);
                $response['error'] = false;
                $response['msg'] = $request->modelClassName.' '.'status updated successfully!';
            }else{
                $response['error'] = true;
                $response['msg'] = 'There was a problem while update the status. Please try later.';
            }

        } catch ( Exception $ex )
        {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
        }
        return json_encode( $response );
     }

}
