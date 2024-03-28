<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Repositories\Contracts\MenuRepositoryInterface;

class MenuController extends Controller
{

    protected $menuRepository;
    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $counter = 1;

            $data = $this->menuRepository->all();
            return Datatables::of($data)
                    ->addColumn('checkboxAndId', function($menu) use (&$counter) {
                        return $counter++;
                    })
                    ->addColumn('status', function ($menu) {
                        $status = $menu->status == 1 ? 'checked' : '';
                        $cat=$menu->status;
                        $status = '<div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-'.$menu->id.'"  data-name="Menu" name="status"  '.$status.' onclick="updateStatus(this.checked,'.$menu->id.',this.dataset.name)">
                                        <label class="custom-control-label" for="status-'.$menu->id.'"></label>
                                    </div>
                                </div>';
                        return $status;
                    })
                    ->addColumn('parent_name',function($menu){
                        if($menu->parent_id==0){
                            $ID='<span class="badge badge-primary">'.$menu->id.'</span>';

                            return $menu->menu_name_en.'-'.$ID;
                        }else{
                            $parentID='<span class="badge badge-secondary">'.$menu->parent_id.'</span>';
                            return $menu->parent->menu_name_en.'-'.$parentID;
                        }

                    })
                    ->addColumn('action', function($menu){
                        $Edit='<a class="btn btn-sm btn-warning" href="'.route("menus.edit", array($menu->id)).'" data-toggle="modal" data-target="#ajaxModal"><i class="fa fa-edit"></i></a>';
                        $Delete='<a class="btn btn-sm btn-danger" onclick="confirmDelete('.$menu->id.')"><i class="fa fa-trash"></i></a>';
                        $Actions = $Edit.' '.$Delete;
                        return $Actions;

                    })
                    ->rawColumns(['checkboxAndId','status','parent_name','action'])
                    ->make(true);
        }
        return view('admin.menus.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Menu::with('children')->where('parent_id','0')->get();
        return view('admin.menus.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        try {

            // Validate menu data using the repository method
            $this->menuRepository->validateMenuData($request->post());

           // If validation passes, continue with storing the menu
            $menu = $this->menuRepository->create($request->post());

            if($menu){
                $response['error'] = false;
                $response['msg'] = 'The menu was created successfully!';
            } else {
                $response['error'] = true;
                $response['msg'] = 'The menu was not created.';
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::with(['parent','children'])->find($id);
        $parents=Menu::with('children')->where('parent_id','0')->get();
        return view('admin.menus.edit',get_defined_vars());
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
            $menu = Menu::findOrFail($id);
            // Validate menu data using the repository method
            $this->menuRepository->validateMenuUpdateData($request->post());
            $this->menuRepository->update($id, $request->post());
            $response['error'] = false;
            $response['msg'] = 'The menu was updated successfully!';
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
            $menu = $this->menuRepository->delete($id);;
            if($menu){
                $response['error'] = false;
                $response['msg'] = 'Menu  deleted successfully!';
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

    public function getTheMenuNameByMenuId(Request $request){
        $menu=Menu::where('id',$request->menu_id)->first();
        if(isset($menu)){
            return $menu->menu_name;
        }else{
            return 0;
        }

    }

    public function fetchSlug(Request $request)
    {
         $menu = Menu::where("id", $request->menu_id)->first();
         $data['menu_slug']=$menu->slug;
        return response()->json($data);
    }






}
