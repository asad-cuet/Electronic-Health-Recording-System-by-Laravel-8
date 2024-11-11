<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function departments()
    {
        $departments=Department::orderBy('id','desc')->get();
        return view('pages.department.department_list',['departments'=>$departments]);

    }
    public function department_form()
    {
        return view('pages.department.department_form');

    }

    public function add_department(Request $request)
    {
        if(Department::where('name',$request->input('name'))->exists())
        {
            return back()->with('danger',"Named ".$request->input('name')." already exist");
        }
        $data=[
            'name'=>$request->input('name')
        ];
        Department::create($data);
        return redirect(route('departments'))->with('status','Department Added Successfully');

    }
}
