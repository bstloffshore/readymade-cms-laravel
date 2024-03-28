<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Carbon\Carbon;
use App\Models\ModuleSetting;
use App\Models\PagePermissionName;
use Illuminate\Validation\ValidationException;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        if ($request->ajax()) {
            $counter = 1;
            $data = Role::latest('created_at')->get();
            return Datatables::of($data)
            ->editColumn('created_at', function($role){
                return Carbon::parse($role->created_at)->format('d-m-y h:i A');
            })
            ->addColumn('sno', function($row) use (&$counter) {
                return  $counter++;
            })
            ->addColumn('action', function($role){
                // $Show='<a class="edit btn" href="'.route("roles.show", array($role->id)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-eye"></i></a>';
                $Edit='<a class="edit btn btn-info btn-sm table-actions custom-pointer" href="'.route("roles.edit", array($role->id)).'" data-toggle="modal" data-target="#ajaxModalOfSmall"><i class="fa fa-edit"></i></a>';
                $Delete='<a class="edit btn btn-danger btn-sm table-actions custom-pointer" onclick="confirmDelete('.$role->id.')"><i class="fa fa-trash"></i></a>';

                // if(auth()->user()->can('edit-view-user-groups')){
                //     $Edit='<a class="edit btn btn-info btn-sm table-actions custom-pointer" href="'.route("roles.edit", array($role->id)).'" data-toggle="modal" data-target="#ajaxModalOfSmall"><i class="fa fa-edit"></i></a>';
                // }else{
                //         $Edit='';
                // }
                // if(auth()->user()->can('delete-user-groups')){
                //     $Delete='<a class="edit btn btn-danger btn-sm table-actions custom-pointer" onclick="confirmDelete('.$role->id.')"><i class="fa fa-trash"></i></a>';
                // }else{
                //         $Delete='';
                // }
                $Actions = $Edit.' '.$Delete;

                // if( auth()->user()->can('edit-view-user-groups') || auth()->user()->can('delete-user-groups'))
                // {
                //     return $Actions;
                // }else{
                //     return $Actions='<span class="fa fa-ban"></span> Access Denied';
                // }
                return $Actions;
            })
            ->addColumn('permissoin', function($role){
                $Edit='<a class="btn btn-xs btn-warning pull-left table-actions" href="'.route("roles.userpermissoins", array($role->id)).'"><i class="fa fa-cogs"></i></a>';
                return $Edit;
            })
                ->rawColumns(['sno','permissoin','action'])
                ->make(true);
        }
        return view('admin.roles.index', get_defined_vars());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permission = Permission::get();
        return view('admin.roles.create', compact( 'permission' ) );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $currentDateTime = Carbon::now();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

              $role = Role::create( [ 'name' => $request->input( 'name' ),'created_at'=>now(),'created_at'=>$formattedDateTime,'updated_at'=>$formattedDateTime ] );
            if($role){
                $response['error'] = false;
                $response['msg'] = 'The role was created successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The role was not created.';
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $role            = Role::find( $id );
        $rolePermissions = Permission::join( "role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id" )
            ->where( "role_has_permissions.role_id", $id )
            ->get();


        return view( 'admin.roles.show', compact( 'role', 'rolePermissions' ) );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $role = Role::find( $id );
        return view('admin.roles.edit',get_defined_vars());
    }

    public function userRolePermission($id)
    {
        $role            = Role::find( $id );
        $permission      = Permission::get();
        $rolePermissions = DB::table( "role_has_permissions" )->where( "role_has_permissions.role_id", $id )
            ->pluck( 'role_has_permissions.permission_id', 'role_has_permissions.permission_id' )
            ->all();
        $moduleSettings=ModuleSetting::with(['permissions'])->get();
        $moduleSettingIds=ModuleSetting::pluck('id');


        return view('admin.roles.userpermisson',get_defined_vars());
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request) {
        try{
            $this->validate( $request, [
                'name'       => 'required',
                'permission' => 'required',
            ] );
            $id=$request->id;
            $role       = Role::find( $id );
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            $response['error'] = false;
            $response['msg'] = 'The role permissons was updated successfully!';

        }catch(Exception $ex){
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
            $this->log()->error($response['msg']);
        }
        return json_encode($response);
    }

    /**
     * Update the User Group specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */

    public function updateUserGroup( Request $request) {
        try{
            $id=$request->id;
            $role = Role::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
            ]);
            $requestData = $request->post();
            $role->update($requestData);
            $response['error'] = false;
            $response['msg'] = 'The role was updated successfully!';

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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = [];
        try {
            $role = Role::findOrFail($id);
            if($role->delete()){
                $response['error'] = false;
                $response['msg'] = 'role  deleted successfully!';
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
