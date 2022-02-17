<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Designation;
use App\DataTables\StaffDataTable;

class EmployeeController extends Controller
{

    //To Show Add Employee Page
    public function index()
    {
        $designation = Designation::all();
        $data = [
            'menunav' => 'Add Employee',
            'card_title' => 'Add Employee',
            'designation' => $designation,
        ];
        return view('adminLte.dashboard', $data);
    }

    //To Show Listing Employee Page
    public function getEmployee(Request $request)
    {
        $employee = DB::table('staff')
            ->join('designations', 'staff.designation', '=', 'designations.id')
            ->select('staff.*', 'designations.designation')
            ->get();
        $data = [
            'menunav' => 'List Employee',
            'card_title' => 'List Employee',
            'emp_tbl' => $employee
        ];
        return view('adminLte.listemployee', $data);
    }

    //To Check Whether the user have internet connectivity 
    public function isOnline($site = 'https://www.youtube.com/')
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    // Function for insertion of Employee into The database
    public function store(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:staff,email',
            'designation' => 'required',
            'image' => 'required|image'
        ]);

        $employee = new Staff();

        $employee->name = request('name');
        $employee->email = request('email');
        $employee->designation = request('designation');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting Image Extension
            $filename = time() . '.' . $extension;
            $file->move('storage/images/', $filename);
            $employee->image = $filename;
        } else {
            return $request;
            $employee->image = '';
        }


        if ($this->isOnline()) {
            $randString = 'AbDfji1670!@#$%';
            $randString = str_shuffle($randString);
            // $hashedString = Hash::make($randString);
            $mailData = [
                'recipeint' => 'craftweband14@gmail.com',
                'title' => 'WebandCraft',
                'body' => 'This is for Testing Mail',
                'to-email' => $request->email,
                'rand-pass' => $randString
            ];

            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($mailData));
            $employee->save();
            return redirect("/")->with('successmsg', 'Mail has been sented & Data Inserted sucessfully!');
        } else {
            return 'Check Your Internet Connection';
        }
    }

    public function edit($id)
    {
        $designation = Designation::all();
        $employee = Staff::find($id);
        $data = [
            'menunav' => 'Edit Employee',
            'card_title' => 'Edit Employee',
            'emp_tbl' => $employee,
            'designation' => $designation
        ];

        return view('adminLte.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'designation' => 'required',
            'image' => 'required|image'
        ]);
        $employee = Staff::find($id);
        $employee->name = request('name');
        $employee->email = request('email');
        $employee->designation = request('designation');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting Image Extension
            $filename = time() . '.' . $extension;
            $file->move('storage/images/', $filename);
            $employee->image = $filename;
        } else {
            return $request;
            $employee->image = '';
        }
        $employee->save();
        return redirect("/employee/$id/edit")->with('successmsg', 'Updated Data Successfully');
    }

    public function destroy($id)
    {
        $employee = Staff::find($id);
        $employee->delete();
        return redirect('/emp-listing')->with('successmsg', 'Employee Deleted Successfully');
    }
}
