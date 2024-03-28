<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\ModuleSetting;
use App\Models\PagePermissionName;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Carbon\Carbon;
class ModuleSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        $pagetitle = 'Manage Roles';
        $activeTab = 'manage-roles';
        $activeSubTab = 'list-roles';
        if ($request->ajax()) {
            $counter = 1;
            // $data = Permission::all();
            $data = ModuleSetting::all();
            return Datatables::of($data)
            ->editColumn('created_on', function($moduleSetting){
                return Carbon::parse($moduleSetting->created_on)->format('d-m-y h:i A');
            })
            ->addColumn('checkboxAndId', function($moduleSetting) use (&$counter) {
                return '<input type="checkbox" name="ms_ids[]" value="'.$moduleSetting->id.'"> ' . $counter++;
            })
            ->addColumn('action', function($moduleSetting){
                $Edit='<a class="edit btn btn-info btn-sm table-actions custom-pointer" href="'.route("module-settings.edit", array($moduleSetting->module_slug)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-edit"></i></a>';
                $Delete='<a class="edit btn btn-danger btn-sm table-actions custom-pointer" onclick="confirmDelete('.$moduleSetting->id.')"><i class="fa fa-trash"></i></a>';

                // if(auth()->user()->can('edit-view-module-settings')){
                //     $Edit='<a class="edit btn btn-info btn-sm table-actions custom-pointer" href="'.route("module-settings.edit", array($moduleSetting->module_slug)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-edit"></i></a>';
                // }else{
                //         $Edit='';
                // }
                // if(auth()->user()->can('delete-module-settings')){
                //     $Delete='<a class="edit btn btn-danger btn-sm table-actions custom-pointer" onclick="confirmDelete('.$moduleSetting->id.')"><i class="fa fa-trash"></i></a>';
                // }else{
                //     $Delete='';
                // }
                // $Actions = $Edit.$Delete;
                // if( auth()->user()->can('edit-view-module-settings') || auth()->user()->can('delete-module-settings') )
                // {
                //     return $Actions;
                // }else{
                //     return $Actions='<span class="fa fa-ban"></span> Access Denied';
                // }
                $Actions = $Edit.$Delete;
                return $Actions;

            })
            ->addColumn('permission', function($moduleSetting){
                $count=Permission::where(['module_slug'=>$moduleSetting->module_slug,'status'=>1])->count();
                $permission='<a class="link-primary" href="'.route("module-settings.show", array($moduleSetting->module_slug)).'" data-toggle="modal" data-target="#ajaxModal">Permissoins</a>';
                return $count.' '.$permission;
            })
                ->rawColumns(['checkboxAndId','permission','action'])
                ->make(true);
        }
        return view('admin.permission.index', get_defined_vars());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $modelHeading="Add :: Module Setting";
        $permission = Permission::get();
        return view('admin.permission.create',get_defined_vars() );
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
                'module_name' => 'required'
            ]);
            // $currentDateTime = Carbon::now();
            // $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
            // $role = Role::create( [ 'name' => $request->input( 'name' ),'created_at'=>now(),'created_at'=>$formattedDateTime,'updated_at'=>$formattedDateTime ] );
            // ModuleSetting
            $requestData = $request->post();
            $ms = ModuleSetting::create($requestData);
              foreach($request->display_name as $key =>$value){
                if(isset($request['status'][$key]) && $request['status'][$key] === 'on') {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $role = \Spatie\Permission\Models\Role::where(['name' => 'Admin'])->first();
                $data=[
                    'name'=>$request->permission_slug[$key].'-'.$ms->module_slug,
                    'display_name'=>$value,
                    'permission_slug'=>$request->permission_slug[$key],
                    'status'=>$status,
                    'guard_name'=>'web',
                    'module_settings_id'=>$ms->id,
                    'module_name'=>$requestData['module_name'],
                    'module_slug'=>$requestData['module_slug'],
                ];
                Permission::insert($data);
            }
              if($ms){
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
    public function show($moduleSlug) {
        $modelHeading="View::Permissions";
        $modulesettings=Permission::where('module_slug',$moduleSlug)->get();
        return view('admin.permission.show',get_defined_vars());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($moduleSlug) {

        $modelHeading="Edit::Module Setting";
        $moduleSetting = ModuleSetting::where('module_slug',$moduleSlug)->first();
        $permissions=Permission::where('module_slug',$moduleSlug)->get();
        $permissionIds=Permission::where('module_slug',$moduleSlug)->pluck('id');
        return view('admin.permission.edit',get_defined_vars());
    }

    public function userRolePermission( $id ) {
        $role            = Role::find( $id );
        $permission      = Permission::get();
        $rolePermissions = DB::table( "role_has_permissions" )->where( "role_has_permissions.role_id", $id )
            ->pluck( 'role_has_permissions.permission_id', 'role_has_permissions.permission_id' )
            ->all();


        return view( 'admin.permission.userpermisson', compact( 'role', 'permission', 'rolePermissions' ) );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
     {
         try{

             $id=$request->id;
             $ms = ModuleSetting::findOrFail($id);
             $this->validate($request, [
                'module_name' => 'required'
             ]);
             $requestData = $request->post();
             $ms->update($requestData);
             $permission=Permission::where('module_settings_id',$id)->delete();
             if($ms){
                foreach($request->display_name as $key =>$value){
                    if(isset($request['status'][$key]) && $request['status'][$key] === 'on') {
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                    $data=[
                        'name'=>$request->permission_slug[$key].'-'.$ms->module_slug,
                        'display_name'=>$value,
                        'permission_slug'=>$request->permission_slug[$key],
                        'status'=>$status,
                        'module_settings_id'=>$ms->id,
                        'guard_name'=>'web',
                        'module_name'=>$ms->module_name,
                        'module_slug'=>$ms->module_slug,
                    ];
                    Permission::insert($data);
                }
             }

             $response['error'] = false;
             $response['msg'] = 'The module setting was updated successfully!';
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

            $ms=ModuleSetting::where('id',$id)->delete();
            if($ms){
                Permission::where('module_settings_id',$id)->delete();
                $response['error'] = false;
                $response['msg'] = 'module setting  deleted successfully!';
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
            $ms= ModuleSetting::whereIn('id', $selectedIds);
            if($ms->delete()){
                Permission::whereIn('module_settings_id', $selectedIds)->delete();
                $response['error'] = false;
                $response['msg'] = 'module setting  deleted successfully!';
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
