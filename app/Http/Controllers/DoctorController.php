<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\user;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    
    public function doctors()
    {
        $doctors=Doctor::orderBy('id','desc')->get();
        $doctors=collect($doctors)->map(function($item,$key)
        {
            return [
                'id'=>$item['id'],
                'name'=>$item->user->name,
                'phone'=>$item['phone'],
                'department_name'=>$item->department->name
                 ];
        });
        return view('pages.doctor.doctor_list',['doctors'=>$doctors]);

    }

    
    public function doctor_form()
    {
        $departments=Department::orderBy('id','desc')->get();
        return view('pages.doctor.doctor_form',['departments'=>$departments]);
    }

    public function add_doctor(Request $request)
    {
        if(User::where('email',$request->input('email'))->exists())
        {
            return redirect()->back()->with('danger','This email already exist');
        }
        if(!$request->input('department_id'))
        {
            return redirect()->back()->with('danger','Department can not be empty');
        }

        if(empty($request->input('phone')) || empty($request->input('specialization')) || empty($request->input('qualification')))
        {
            return redirect()->back()->with('danger','Any field can not be empty');
        }

        $password=time();
        $user_data=[
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($password),
            'role_as'=>'doctor'
        ];
        $user=User::create($user_data);
        if($user)
        {
            $data=[
                'user_id'=>$user->id,
                'password'=>$password,
                'department_id'=>$request->input('department_id'),
                'specialization'=>$request->input('specialization'),
                'qualification'=>$request->input('qualification'),
                'phone'=>$request->input('phone')
            ];
            $doctor=Doctor::create($data);     
            if($doctor)
            {
                return redirect(route('doctors'))->with('status','Doctor Added Successfully');
            }
            else
            {
                return redirect()->back()->with('danger','Something Wrong');
            }
        
        }
        
    }

    public function doctor_view($id)
    {
        $departments=Department::orderBy('id','desc')->get();
        $doctor=Doctor::where('id',$id)->first();
        $doctor->password='';
        $doctor->user->password='';
        return view('pages.doctor.doctor_view',['doctor'=>$doctor,'departments'=>$departments]);

    }


    public function doctor_update(Request $request,$id)
    {



    if(empty($request->input('phone')) || empty($request->input('specialization')) || empty($request->input('qualification')) || empty($request->input('name')))
    {
        return redirect()->back()->with('danger','Any field can not be empty');
    }
    $data=[
        'department_id'=>$request->input('department_id'),
        'specialization'=>$request->input('specialization'),
        'qualification'=>$request->input('qualification'),
        'phone'=>$request->input('phone')
    ];
    $doctor=Doctor::where('id',$id)->update($data);     
    $doctor=Doctor::where('id',$id)->first();     
    if($doctor)
    {
        $user_data=[
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
        ];
        $user=User::where('id',$doctor->user_id)->update($user_data);
        if($user)
        {
            return redirect(route('doctors'))->with('status',"Doctor's details Updated Successfully");
        }
        else
        {
            return redirect()->back()->with('danger','Something Wrong');
        }
    }

    }



    public function all_doctors()
    {
        $doctors=Doctor::orderBy('id','desc')->get();
        $doctors=collect($doctors)->map(function($item,$key)
        {
            return [
                'id'=>$item['id'],
                'name'=>$item->user->name,
                'email'=>$item->user->email,
                'phone'=>$item['phone'],
                'department_name'=>$item->department->name,
                'qualification'=>$item->department->name,
                'specialization'=>$item->department->name
                 ];
        });
        return view('pages.doctor.all_doctors',['doctors'=>$doctors]);
    }

    public function doctor_details($id)
    {
        $doctor=Doctor::where('id',$id)->first();
        $doctor->password='';
        $doctor->user->password='';
        return view('pages.doctor.doctor_details',['doctor'=>$doctor]);
    }

}