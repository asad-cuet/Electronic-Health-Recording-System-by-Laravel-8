<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\consultation;
use App\Models\Prescribe;
use App\Models\Test;
use App\Models\Exam;
use App\Models\Patient;
use App\Models\Comment;
use App\Models\ClinicalHistory;
use App\Models\Medication;
class ConsultationController extends Controller
{
    public function consultations()
    {

        $consultations=consultation::where('is_on_exam',0)->where('is_complete',0)->where('consulted_by',Auth::user()->doctor->id)->orderBy('updated_at','desc')->get();
        $con_quantity_on_lab=consultation::where('is_on_exam',1)->where('consulted_by',Auth::user()->doctor->id)->count();
        $consultations=collect($consultations)->map(function($item,$key)
        {
            $patient_name=$item->patient->pre_name.' '.$item->patient->fname;
            return [
                'id'=>$item['id'],
                'patient_id'=>$item['patient_id'],
                'consulted_by'=>$item['consulted_by'],
                'patient_name'=>$patient_name,
                'patient_phone'=>$item->patient->phone,
                'is_examed'=>$item->is_examed
                 ];
        });
        
        return view('pages.consultation.consultation_list',['consultations'=>$consultations,'con_quantity_on_lab'=>$con_quantity_on_lab]);

    }


    public function consultations_on_lab()
    {

        $consultations=consultation::where('is_on_exam',1)->where('consulted_by',Auth::user()->doctor->id)->orderBy('updated_at','desc')->get();
        $consultations=collect($consultations)->map(function($item,$key)
        {
            $patient_name=$item->patient->pre_name.' '.$item->patient->fname;
            return [
                'id'=>$item['id'],
                'patient_id'=>$item['patient_id'],
                'consulted_by'=>$item['consulted_by'],
                'patient_name'=>$patient_name,
                'patient_phone'=>$item->patient->phone,
                'doctor_name'=>$item->doctor->user->name
                 ];
        });
        
        return view('pages.consultation.consultation_on_lab',['consultations'=>$consultations]);

    }

    public function consultation_status($id)
    {
        $consultation=consultation::where('id',$id)->first();
        $test=Exam::where('consultation_id',$id)->get();
        $history=ClinicalHistory::where('patient_id',$consultation->patient_id)->first();
        $medication=Medication::where('patient_id',$consultation->patient_id)->first();
        $comments=Comment::where('consultation_id',$id)->get();
        $object=[
            'consultation'=>$consultation,
            'test'=>$test,
            'history'=>$history,
            'medication'=>$medication,
            'comments'=>$comments
        ];
        return view('pages.consultation.consultation_status',$object);

    }

    public function problem($consultation_id)
    {
        $consultation=consultation::where('id',$consultation_id)->first();
        return view('pages.consultation.action.problem',['consultation_id'=>$consultation_id,'consultation'=>$consultation]);
    }
    public function submit_problem(Request $request,$consultation_id)
    {
        if(!consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }


        $data=[
            'problem_details'=>$request->input('problem_details'),
            'problem_duration'=>$request->input('problem_duration')
        ];
        consultation::where('id',$consultation_id)->update($data);
        return redirect('/consultation-status/'.$consultation_id)->with('status','Problem Details Submited Successfully');
    }


    public function exam($consultation_id)
    {
        $tests=Test::all();
        return view('pages.consultation.action.exam',['consultation_id'=>$consultation_id,'tests'=>$tests]);
    }
    public function submit_exam(Request $request,$consultation_id)
    {
        if(!consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }


        $test_id=$request->input('test');
        $t_num=count($test_id);

        //dd($test_id);
        for($i=0;$i<$t_num;$i++)
        {
            $data=[
                    'consultation_id'=>$consultation_id,
                    'test_id'=>$test_id[$i],
                    'report'=>0
            ];
            Exam::create($data);
        }    
        $consult=consultation::where('id',$consultation_id)->first();
        $consult->is_on_exam=1;
        $consult->update();

        $data=[
            'is_examed'=>1
        ];
        consultation::where('id',$consultation_id)->update($data);

        return redirect(route('consultations'))->with('status','The Patient Sent to Laboratory');
    }




    public function prescribe($consultation_id)
    {
        $consultation=consultation::where('id',$consultation_id)->first();
        return view('pages.consultation.action.prescribe',['consultation_id'=>$consultation_id,'consultation'=>$consultation]);
    }


    public function submit_prescribe(Request $request,$consultation_id)
    {

        if(!consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }


        $title=$request->input('title');
        $comment=$request->input('comment');
        $m_num=count($title);
        $c_num=count($comment);
        if($m_num!=$c_num)
        {
            return redirect()->back()->with('status',"No Field can't be empty");
        }
        else
        {
            for($i=0;$i<$m_num;$i++)
            {
                $data=[
                        'consultation_id'=>$consultation_id,
                        'title'=>$title[$i],
                        'comment'=>$comment[$i]

                ];
                Prescribe::create($data);
            }
          //  dd($all_data);
            
            return redirect('/consultation-status/'.$consultation_id)->with('status','Prescribe Added Successfully');
        }
        
    }


    public function prescribe_disallow($presc_id)
    {
       if(!Prescribe::where('id',$presc_id)->exists())
       {
            return back()->with('danger',"The Id doesn't exist");
       }
       $consultation_id=Prescribe::where('id',$presc_id)->first()->consultation_id;
       if(!Consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
       {
            return back()->with('danger',"You can only take this action to your patient");
       }

       Prescribe::where('id',$presc_id)->update(['isAllow'=>0]);
       return redirect('/consultation-status/'.$consultation_id)->with('status',"One Prescription disallowed");

    }



    public function lab_resend($exam_id,$consultation_id)
    {
        if(!consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }

        if(consultation::where('id',$consultation_id)->where('is_complete',1)->exists())
        {
            return back()->with('danger',"This patient's consultation completed. You can't take this action anymore.");
        }
        
        $data=[
            'is_resent'=>1
        ];
        Exam::where('id',$exam_id)->update($data);
        $data=[
        'is_on_exam'=>1
        ];
        consultation::where('id',$consultation_id)->update($data);
        return redirect(route('consultations'))->with('status', "A patient sent to Lab");
    }


    public function history($patient_id)
    {
        if(!ClinicalHistory::where('patient_id',$patient_id)->exists())
        {
             return back()->with('danger',"This Patient doesn't exist in Clinical-History Table");
        }

        $history=ClinicalHistory::where('patient_id',$patient_id)->first();
        return view('pages.consultation.action.history',['patient_id'=>$patient_id,'history'=>$history]);
    }

    
    public function submit_history(Request $request,$patient_id)
    {
        if(!consultation::where('patient_id',$patient_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }

        $consultation_id=consultation::where('patient_id',$patient_id)->first()->id;


        $data=[
            'primary_admitting_diagnosis'=>$request->input('primary_admitting_diagnosis'),
            'permanant_history'=>$request->input('permanant_history'),
            'previous_medical_history'=>$request->input('previous_medical_history'),
            'surgical_history'=>$request->input('surgical_history'),
            'smoker'=>$request->input('smoker'),
            'diabetes'=>$request->input('diabetes'),
            'heart_rate'=>$request->input('heart_rate'),
            'bp_systole'=>$request->input('bp_systole'),
            'bp_diastole'=>$request->input('bp_diastole'),
            'oxygen_seturation'=>$request->input('oxygen_seturation'),
            'pain_on_scale'=>$request->input('pain_on_scale')
        ];
        ClinicalHistory::where('patient_id',$patient_id)->update($data);
        return redirect('/consultation-status/'.$consultation_id)->with('status','History Submited Successfully');
    }

    public function medication($patient_id)
    {
        if(!Medication::where('patient_id',$patient_id)->exists())
        {
             return back()->with('danger',"This Patient doesn't exist in Clinical-History Table");
        }

        $medication=Medication::where('patient_id',$patient_id)->first();
        return view('pages.consultation.action.medication',['patient_id'=>$patient_id,'medication'=>$medication]);
    }

    
    public function submit_medication(Request $request,$patient_id)
    {
        if(!consultation::where('patient_id',$patient_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }


        $consultation_id=consultation::where('patient_id',$patient_id)->first()->id;

        $data=[
            'medication'=>$request->input('medication'),
            'dose'=>$request->input('dose'),
            'route'=>$request->input('route'),
            'frequency'=>$request->input('frequency'),
            'last_taken'=>$request->input('last_taken')
        ];
        Medication::where('patient_id',$patient_id)->update($data);
        return redirect('/consultation-status/'.$consultation_id)->with('status','Medication Submited Successfully');
    }




    public function exam_result($consultation_id)
    {
        $result=consultation::where('id',$consultation_id)->first()->exam_result;
        return view('pages.consultation.action.exam_result',['consultation_id'=>$consultation_id,'result'=>$result]);
    }


    public function submit_exam_result(Request $request,$consultation_id)
    {
        if(consultation::where('id',$consultation_id)
        ->where('is_on_exam',1)
        ->where('consulted_by',Auth::user()->doctor->id)
        ->exists()) 
        {
         return back()->with('danger',"This patient is on exam.During exam,can't take this action.");
        }



       $data=[
        'exam_result'=>$request->input('exam_result')
       ];
       consultation::where('id',$consultation_id)->update($data);
       return redirect('/consultation-status/'.$consultation_id)->with('status',"Exam result submitted");

    }


    public function consultant_complete($consultation_id)
    {
        if(!consultation::where('id',$consultation_id)->where('consulted_by',Auth::user()->doctor->id)->exists())
        {
            return back()->with('danger',"You can only take this action to your patient");
        }


       if(consultation::where('id',$consultation_id)
       ->where('is_on_exam',1)
       ->exists()) 
       {
        return back()->with('danger',"This patient is on exam.During exam,can't take this action.");
       }



       if(consultation::where('id',$consultation_id)->where('exam_result','=',null)->exists())
       {
        return back()->with('danger',"Can't take this action without giving the final statement.");
       }
       
       if(consultation::where('id',$consultation_id)
       ->where('consulted_by',Auth::user()->doctor->id)
       ->exists())
       {
            $data=[
                'is_complete'=>1
            ];
            consultation::where('id',$consultation_id)->update($data);
            $patient_id=consultation::where('id',$consultation_id)->first()->patient_id;
            $data=[
                'is_cleared'=>1
            ];
            Patient::where('id',$patient_id)->update($data);   
            return redirect(route('consultations'))->with('status',"The patient consultation is completed.This patient details is available in Consultation History");
        }
 
  
           
   


    }
}
