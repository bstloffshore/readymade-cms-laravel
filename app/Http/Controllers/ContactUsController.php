<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\ContactUs;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $counter = 1;

            $data = ContactUs::latest();
            return Datatables::of($data)
            ->editColumn('created_on', function($contact){
               return Carbon::parse($contact->created_on)->format('d-m-y h:i A');
           })

            ->addColumn('checkboxAndId', function($gallery) use (&$counter) {
                return $counter++;
            })
            ->addColumn('action', function($contact){
                $Show='<a class="btn btn-sm btn-info table-actions" href="'.route("contact-us.show", array($contact->id)).'"><i class="fa fa-eye"></i></a>';
                $Actions = $Show;
                return $Actions;
             })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.contact-us.index',get_defined_vars());
    }
    public function show($id)
     {
         $contact=ContactUs::find($id);
         return view('admin.contact-us.show',get_defined_vars());
     }
}
