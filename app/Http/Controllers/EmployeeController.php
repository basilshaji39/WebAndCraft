<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Designation;
class EmployeeController extends Controller
{
    public function index(){

        // $designation = DB::table('designation')->get();
        $designation = Designation::all();
        $data = [
            'card_title'=>'Add Employee',
            'designation'=>$designation
        ];
        return view('adminLte.dashboard',$data);
    }
    
    public function store(Request $request){
        //echo request('title');
    //     echo "Reached Here";
    //    die;
            request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'designation' => 'required',
            'image' => 'required|image'
        ]);

       
        $employee = new Staff();
        
        $employee->name = request('name');
        $employee->email = request('email');
        $employee->designation = request('designation');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();// getting Image Extension
            $filename = time() . '.' . $extension;
            $file->move('storage/images/',$filename);
            $employee->image = $filename;
        }
        else{
            return $request;
            $employee->image = '';
        }
            $employee->save();
            return redirect("/home");

    }
}
