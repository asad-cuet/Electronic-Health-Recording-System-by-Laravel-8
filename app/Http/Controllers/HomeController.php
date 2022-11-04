<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\consultation;
use Auth;



// use Xenon\LaravelBDSms\Facades\SMS;
// use Xenon\LaravelBDSms\Provider\Ssl;
use LaravelBDSms, SMS;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function profile()
    {
        if(Auth::user()->role_as=='administration' || Auth::user()->role_as=='lab_tecknician')
        {
            return view('pages.profile.other_profile');
        }
        if(Auth::user()->role_as=='doctor')
        {
            return view('pages.profile.doctor_profile');
        }

    }


    public function update_profile(Request $request)
    {
        if(Auth::user()->role_as=='administration' || Auth::user()->role_as=='lab_tecknician')
        {
            if(empty($request->input('name')) || empty($request->input('email')))
            {
                return redirect()->back()->with('danger','Any field can not be empty');
            }
            if(User::where('id','!=',Auth::user()->id)->where('email',$request->input('email'))->exists())
            {
                return back()->with('danger',"The Email Existed In Other Account");
            }
            $data=[
                'name'=>$request->input('name'),
                'email'=>$request->input('email')
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with('status',"Profile Updated");
        }


        if(Auth::user()->role_as=='doctor')
        {
            if(empty($request->input('name')) || empty($request->input('email')) || empty($request->input('qualification')))
            {
                return redirect()->back()->with('danger','Any field can not be empty');
            }
            if(User::where('id','!=',Auth::user()->id)->where('email',$request->input('email'))->exists())
            {
                return back()->with('danger',"The Email Existed In Other Account");
            }
            $data=[
                'name'=>$request->input('name'),
                'email'=>$request->input('email')
            ];
            User::where('id',Auth::user()->id)->update($data);

            $data=[
                'qualification'=>$request->input('qualification'),
                'phone'=>$request->input('phone'),                
                'specialization'=>$request->input('specialization')                
            ];
            Doctor::where('id',Auth::user()->doctor->id)->update($data);
            return back()->with('status',"Profile Updated");
        }

    }

    // public function test()
    // {
    //     //dd('dsd');
    //     $response =SMS::shoot("01781856861",'test sms');
    //     return $response;
    // }
    // public function test()
    // {
    //     $len=6;
    //     for($i=1;$i<$len;$i++)
    //     {
    //         $patients=Patient::where('id',$i)->first();
    //         $patients->full_name=$patients->pre_name.' '.$patients->fname.' '.$patients->lname;
    //         $patients->update();
    //     }
    // }


    //Exporting patient only

    // public function test()
    // {
    //             // Create an array of elements
    //             $array=[[
    //                 'pre_name',
    //                 'fname',
    //                 'lname',
    //                 'gender',
    //                 'phone'
    //             ]];
    //             $list=Patient::select(
    //                 'pre_name',
    //                 'fname',
    //                 'lname',
    //                 'gender',
    //                 'phone'
    //             )->get()->toArray();

            
    //             $array=array_merge($array,$list);
                
    //             //dd($array);


    //             // Open a file in write mode ('w')
    //             $fp = fopen('persons3.csv', 'w');
                
    //             // Loop through file pointer and a line
    //             foreach ($array as $fields) {
    //                 fputcsv($fp, $fields);
    //             }
                
    //             fclose($fp);
    // }


    //Exporting consultation,patient,doctor combinely

    // public function test()
    // {
    //             // Create an array of elements
    //             $array=[[
    //                 'pre_name',
    //                 'fname',
    //                 'lname',
    //                 'gender',
    //                 'phone',
    //                 'Doctor Name',
    //                 'Doctor Department'
    //             ]];


    //             $list=consultation::get();

    //             foreach($list as $l)
    //             {
    //                 $data=[[
    //                     $l->patient->pre_name,
    //                     $l->patient->fname,
    //                     $l->patient->lname,
    //                     $l->patient->gender,
    //                     $l->patient->phone,
    //                     $l->doctor->user->name,
    //                     $l->doctor->department->name
    //                 ]];
    //                 $array=array_merge($array,$data);
    //             }


    //             //dd($array);
                


    //             // Open a file in write mode ('w')
    //             $fp = fopen('consultation.csv', 'w');
                
    //             // Loop through file pointer and a line
    //             foreach ($array as $fields) {
    //                 fputcsv($fp, $fields);
    //             }
                
    //             fclose($fp);
    // }




        //Exporting patient only

    public function test()
    {
                // Create an array of elements
                $array=[[
                    'id',
                    'pre_name',
                    'fname',
                    'lname',
                    'full_name',
                    'gender',
                    'age',
                    'height',
                    'weight',
                    'address',
                    'phone',
                    'health_insurance',
                    'guardian_name',
                    'guardian_phone',
                    'relationship',
                    'history_id',
                    'is_consulted',
                    'is_cleared',
                    'created_at',
                    'updated_at'
                ]];
                $list=Patient::get()->toArray();

            
                $array=array_merge($array,$list);
                
                //dd($array);


                // Open a file in write mode ('w')
                $fp = fopen('csv/PatientTable.csv', 'w');
                
                // Loop through file pointer and a line
                foreach ($array as $fields) {
                    fputcsv($fp, $fields);
                }
                
                fclose($fp);
    }

    //failed

    // public function xlsx()
    // {
    //     $list=Patient::get()->toArray();
    //     $xlsx = Shuchkin\SimpleXLSXGen::fromArray( $list );
    //     $xlsx->saveAs('xlsx/patients.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 
    // }
}
