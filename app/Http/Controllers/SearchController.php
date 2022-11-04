<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\consultation;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search_user(Request $request)
    {
        $searched_key=$request->input('searched_key');

        if($searched_key!='')
        {
            $user=User::where('name','LIKE','%'.$searched_key.'%')
                             ->orWhere('email','LIKE','%'.$searched_key.'%')
                             ->orWhere('role_as','LIKE','%'.$searched_key.'%')
                             ->orderBy('id','desc')
                             ->get();
            if($user)
            {
                return view('pages.user.user_list',['user'=>$user]);
            }
            else
            {
                return redirect()->back()->with('status',"No User matched your search");
            }

        }

        else
        {
            return redirect()->back();
        }


    }


    public function search_doctor(Request $request)
    {
        $searched_key=$request->input('searched_key');

        if($searched_key!='')
        {                            
            $doctors=Doctor::leftJoin('users','doctors.user_id','=','users.id')
                        ->leftJoin('departments','doctors.department_id','=','departments.id')
                        ->where('users.name','LIKE','%'.$searched_key.'%')
                        ->orWhere('users.email','LIKE','%'.$searched_key.'%')
                        ->orWhere('users.role_as','LIKE','%'.$searched_key.'%')
                        ->orWhere('departments.name','LIKE','%'.$searched_key.'%')
                        ->get();                
            $doctors=collect($doctors)->map(function($item,$key)
            {
                return [
                    'id'=>$item->id,
                    'name'=>$item->user->name,
                    'phone'=>$item->phone,
                    'department_name'=>$item->department->name
                        ];
            });
            //dd($doctors);
            if($doctors)
            {
                return view('pages.doctor.doctor_list',['doctors'=>$doctors]);
            }
            else
            {
                return redirect()->back()->with('status',"No Patient matched your search");
            }

        }

        else
        {
            return redirect()->back();
        }


    }


    public function search_patient(Request $request)
    {
        $searched_key=$request->input('searched_key');

        if($searched_key!='')
        {
            $patients=Patient::where('full_name','LIKE','%'.$searched_key.'%')
                             ->orWhere('age','LIKE','%'.$searched_key.'%')
                             ->orWhere('height','LIKE','%'.$searched_key.'%')
                             ->orWhere('weight','LIKE','%'.$searched_key.'%')
                             ->orWhere('address','LIKE','%'.$searched_key.'%')
                             ->orWhere('phone','LIKE','%'.$searched_key.'%')
                             ->orWhere('guardian_name','LIKE','%'.$searched_key.'%')
                             ->orWhere('guardian_phone','LIKE','%'.$searched_key.'%')
                             ->orWhere('relationship','LIKE','%'.$searched_key.'%')
                             ->orderBy('id','desc')
                             ->paginate(50);
            if($patients)
            {
                return view('pages.patient.patient_list',['patients'=>$patients]);
            }
            else
            {
                return redirect()->back()->with('status',"No Patient matched your search");
            }

        }

        else
        {
            return redirect()->back();
        }


    }


    public function search_con_history(Request $request)
    {
        $searched_key=$request->input('searched_key');
        
        if($searched_key!='')
        {
            $consultations=consultation::where('is_complete',1)->where('consulted_by',Auth::user()->doctor->id)
                             ->leftJoin('patients','consultations.patient_id','=','patients.id')
                             ->orWhere('patients.fname','LIKE','%'.$searched_key.'%')
                             ->orWhere('patients.lname','LIKE','%'.$searched_key.'%')
                             ->orWhere('patients.address','LIKE','%'.$searched_key.'%')
                             ->orWhere('patients.phone','LIKE','%'.$searched_key.'%')
                             ->orderBy('consultations.id','desc')
                             ->get();
            
                             $consultations=collect($consultations)->map(function($item,$key)
                             {
                                 return [
                                     'id'=>$item->id,
                                     'patient_name'=>$item->patient->fname,
                                     'patient_phone'=>$item->phone,
                                     'doctor_name'=>$item->doctor->user->name
                                         ];
                             });
                             //dd($consultations);
            if($consultations)
            {
                return view('pages.consultation.others_consultation_list',['consultations'=>$consultations,'history_view'=>1]);
            }
            else
            {
                return redirect()->back()->with('status',"No Patient matched your search");
            }

        }

        else
        {
            return redirect()->back();
        }


    }
}
