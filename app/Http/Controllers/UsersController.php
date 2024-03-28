<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;
use App\Repositories\Contracts\UserRepositoryInterface;

class UsersController extends Controller
{

    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $data = User::where('is_user_type','!=',2)->get();
        // dd($data);
        if ($request->ajax()) {
            $counter = 1;
            $data = User::where('is_user_type','!=',2)->get();
            return Datatables::of($data)
            ->editColumn('created_at', function($user){
                return Carbon::parse($user->created_at)->format('d-m-y h:i A');
            })
            ->addColumn('checkboxAndId', function($user) use (&$counter) {
                return '<input type="checkbox" name="user_ids[]" value="'.$user->id.'"> ' . $counter++;
            })
            ->addColumn('status',function($user){
                $active='<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Active</a>';
                $inactive='<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Inactive</a>';
                return $user->status == 1 ? $active : $inactive;
            })
            ->addColumn('action', function($user){
                $Edit='<a class="btn btn-sm btn-info table-actions" href="'.route("users.edit", array($user->id)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-edit"></i></a>';

                // if(auth()->user()->can('edit-view-manage-users')){
                //     $Edit='<a class="btn btn-sm btn-info table-actions" href="'.route("users.edit", array($user->id)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-edit"></i></a>';
                // }else{
                //         $Edit='';
                // }
                // $Actions = $Edit;
                // if( auth()->user()->can('edit-view-manage-users'))
                // {
                //     return $Actions;
                // }else{
                //     return $Actions='<span class="fa fa-ban"></span> Access Denied';
                // }
                $Actions = $Edit;
                return $Actions;
            })
            ->addColumn('roles', function($user){
                // if ($user->branchLocations!=null) {
                //     $userRole = $user->roles->pluck('name')->implode(',');
                //     $branchLocations=$user->branchLocations->branch_location_name_en;
                //     $roles='<span class="btn btn-info btn-block" style="font-size:14px;font-weight:400">'.$userRole.'<br><span class="badge badge-warning">'.$branchLocations.'</span></span> ';
                // }else{
                //     $userRole = $user->roles->pluck('name')->implode(',');
                //     $roles='<span class="btn btn-info btn-block" style="font-size:14px;font-weight:400">'.$userRole.'</span> ';
                // }
                $userRole = $user->roles->pluck('name')->implode(',');
                    $roles='<span class="btn btn-info btn-block" style="font-size:14px;font-weight:400">'.$userRole.'</span> ';
               return $roles;

            })
            ->addColumn('reset', function($user){
                $reset='<a class="btn btn-sm btn-primary table-actions" title="Reset password" href="'.route("users.changePasswordByAdmin", array($user->id)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-lock"></i></a>';
                return $reset;
            })
                ->rawColumns(['checkboxAndId','status','roles','reset','action'])
                ->make(true);
        }

        return view('admin.users.index', get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',get_defined_vars());
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

            $input = $request->post();
            $input['password'] = Hash::make($input['password']);
            // Validate menu data using the repository method
            $this->userRepository->validateUserStoreData($input);
            // If validation passes, continue with storing the menu
            $user = $this->userRepository->create($input);
            $user->assignRole($input['roles']);
            if($user){
                $response['error'] = false;
                $response['msg'] = 'The user was created successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The user was not created.';
            }
    } catch (ValidationException $ex) {
        $response['error'] = true;
        $response['msg']   = $ex->validator->errors()->first();
        $this->log()->error( $response['msg'] );
    } catch ( Exception $ex ) {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
    }
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
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    public function changePasswordByAdmin($id)
    {
        $user = User::find($id);
        return view('admin.users.change-password',get_defined_vars());
    }

    public function updateChnagePasswordByAdmin(Request $request)
    {


        try {
            $this->validate($request, [
                'password' => 'required',
                'status' => 'required',
            ]);
            $id=$request->id;
            $user=User::find($id);
            $input = $request->all();
            $user->palin_password= $input['password'];
            $input['password'] = Hash::make($input['password']);

            $user->update($input);
            if($user){
                $response['error'] = false;
                $response['msg'] = 'The password was reset successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The password was not created.';
            }
        } catch (ValidationException $ex) {
            $response['error'] = true;
            $response['msg']   = $ex->validator->errors()->first();
            $this->log()->error( $response['msg'] );
        } catch ( Exception $ex ) {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
        }
        return json_encode($response);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRoles = $user->roles;
        return view('admin.users.edit',get_defined_vars());
    }

    public function editUserProfile()
    {
        $user= Auth::user();
        return view('admin.users.edit-profile',get_defined_vars());
    }

    public function updateUserProfile(Request $request)
    {
        try {

        $id=$request->id;
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$id,
                'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            ],
            'phone' => [
                'required',
                'digits:10',
                'unique:users,phone,'.$id,
                'regex:/^(\+?\d{1,3}[-\.\s]?)?\(?\d{3}\)?[-\.\s]?\d{3}[-\.\s]?\d{4}$/'
            ],
        ]);
        // $input = $request->all();
        $requestData = $request->post();

        // dd($request->file('profile_pic')->getClientOriginalExtension());

        $user = User::find($id);

            if($requestData['password']!=null){
                $requestData['password']= Hash::make($request->password);
            }else{
                $requestData['password']= $user->password;
            }
        if ($request->hasFile('profile_pic')) {
            $requestImage = $request->file('profile_pic');

            $image = time().'.'.$requestImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile-pic/thumb');
            // Create the directory if it doesn't exist
            File::makeDirectory($destinationPath, 0755, true, true);
            $img = Image::make($requestImage->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image);
            $destinationPath = public_path('/images/profile-pic/large');
            $requestImage->move($destinationPath, $image);
            $user->profile_pic=$image;
        }else{
            $user->profile_pic=$user->profile_pic;
        }
        $user->update($requestData);
        $response['error'] = false;
        $response['msg'] = 'The user profile was updated successfully!';
    } catch (ValidationException $ex) {
        $response['error'] = true;
        $response['msg']   = $ex->validator->errors()->first();
        $this->log()->error( $response['msg'] );
    } catch ( Exception $ex ) {
        $response['error'] = true;
        $response['msg']   = $ex->getMessage();
        $this->log()->error( $response['msg'] );
    }
    return json_encode($response);
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
        try {

        $this->userRepository->validateUserUpdateData($request->post(),$id);
        $this->userRepository->update($id, $request->post());
        $response['error'] = false;
        $response['msg'] = 'The user was updated successfully!';

} catch (ValidationException $ex) {
    $response['error'] = true;
    $response['msg']   = $ex->validator->errors()->first();
    $this->log()->error( $response['msg'] );
    } catch ( Exception $ex ) {
        $response['error'] = true;
        $response['msg']   = $ex->getMessage();
        $this->log()->error( $response['msg'] );
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
              $user = User::findOrFail($id);
              if($user->delete()){
                  $response['error'] = false;
                  $response['msg'] = 'user  deleted successfully!';
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
         $user=User::whereIn('id', $selectedIds);
         if($user->delete()){
             $response['error'] = false;
             $response['msg'] = 'user  deleted successfully!';
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
