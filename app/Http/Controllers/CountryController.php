<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Validation\ValidationException;
class CountryController extends Controller
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
            $data = Country::all();
            return Datatables::of($data)
                    // ->addIndexColumn()
                    ->addColumn('checkboxAndId', function($country) use (&$counter) {
                        return $counter++;
                    })
                    ->addColumn('status', function ($country) {
                        $status = $country->status == 1 ? 'checked' : '';
                        $cat=$country->status;
                        $status = '<div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-'.$country->id.'"  data-name="Country" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$country->id.',this.dataset.name)">
                                        <label class="custom-control-label" for="status-'.$country->id.'"></label>
                                    </div>
                                </div>';
                        return $status;
                    })
                    ->addColumn('action', function($country){
                        $Edit='<a class="btn btn-warning btn-sm mr-1" href="'.route("countries.edit", array($country->id)).'" ><i class="fa fa-edit"></i></a>';
                        $Delete='<a class="btn btn-danger btn-sm mr-1" onclick="confirmDelete('.$country->id.')"><i class="fa fa-trash"></i></a>';
                        $Show='<a class="btn btn-primary btn-sm mr-1" href="'.route("countries.show", array($country->id)).'" ><i class="fa fa-eye"></i></a>';
                        return $Edit.$Show.$Delete;

                    })
                    ->rawColumns(['checkboxAndId','status','action'])
                    ->make(true);
        }
        return view('admin.country.index',get_defined_vars());
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Begin a try block to handle exceptions
        try {
            // Validate the incoming request data using Laravel's validation mechanism
            $this->validate($request, [
                'country_name_en' => 'required',
                'status' => 'required',
                'sort_order' => 'required',
            ]);

            // Retrieve the validated data from the request
            $requestData = $request->post();

            // Create a new country record in the database using the validated data
            $country = Country::create($requestData);

            // Check if the country was successfully created
            if ($country) {
                // If successful, set error flag to false and assign a success message retrieved from language files
                $response['error'] = false;
                $response['msg'] = trans('messages.country_created_true');
            } else {
                // If not successful, set error flag to true and assign an error message retrieved from language files
                $response['error'] = true;
                $response['msg'] = trans('messages.country_created_false');
            }
        } catch (ValidationException $ex) {
            // Catch validation exceptions, set error flag to true, assign the first validation error message, and log the error
            $response['error'] = true;
            $response['msg'] = $ex->validator->errors()->first();
            $this->log()->error($response['msg']);
        } catch (Exception $ex) {
            // Catch general exceptions, set error flag to true, assign the exception message, and log the error
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
            $this->log()->error($response['msg']);
        }

        // Return the response in JSON format
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
        $country=Country::find($id);
        return view('admin.country.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.country.edit',get_defined_vars());
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
            $country = Country::findOrFail($id);
            $this->validate($request, [
                'country_name_en' => 'required',
                'country_slug' => 'required',
                'sort_order'=>'required',
            ]);
            $requestData = $request->post();
            $country->update($requestData);
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
            $country = Country::findOrFail($id);
            if($country->delete()){
                $response['error'] = false;
                $response['msg'] = trans('messages.country_deleted_true');
            } else {
                $response['error'] = true;
                $response['msg'] = trans('messages.country_deleted_false');
            }
        } catch(Exception $ex){
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
            $this->log()->error($response['msg']);
        }
        return json_encode($response);
    }
}
