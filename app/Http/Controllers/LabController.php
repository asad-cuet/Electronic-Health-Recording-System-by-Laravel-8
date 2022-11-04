<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consultation;
use App\Models\Test;
use App\Models\Exam;
use App\Models\Comment;
use Illuminate\Support\Facades\File;

class LabController extends Controller
{
    public function lab()
    {
        $lab=consultation::where('is_on_exam',1)->orderBy('updated_at','desc')->get();
        $lab_data=collect($lab)->map(function($item,$key)
        {
            return [
                'id'=>$item['id'],
                'patient_id'=>$item['id'],
                'consulted_by'=>$item['id'],
                'patient_name'=>$item->patient->pre_name.' '.$item->patient->fname,
                'patient_phone'=>$item->patient->phone,
                'doctor_name'=>$item->doctor->user->name,
                 ];
        });
        
        return view('pages.lab.lab_list',['lab_data'=>$lab_data]);
    }


    public function lab_view(Request $request,$consultation_id)
    {
        $lab=consultation::where('is_on_exam',1)->where('id',$consultation_id)->first();
        $test=Exam::where('consultation_id',$consultation_id)->get();

        //return a column in array
        $data=collect($test)->map(function($item,$key)
        {
            return $item['test_id'];
        });
        $unique_test_id  = collect($data)->unique();

        $data=collect($test)->map(function($item,$key)
        {
            return $item->test->test_name;
        });
        $unique_test_name  = collect($data)->unique();

        $object=[
            'lab'=>$lab,
            'test'=>$test,
            'unique_test_id'=>$unique_test_id,
            'unique_test_name'=>$unique_test_name
        ];
        return view('pages.lab.lab_view',$object);
    }


    public function submit_report(Request $request,$consultation_id)
    {
        $image_array=($request->file('image'));
        
        if(empty($image_array))
        {
            return redirect()->back()->with('status',"Can't submitted empty");
        }
        $imgae_qnt=count($image_array);

        $test_id_array=array_values($request->input('test_id'));
        $test_id_qnt=count($image_array);

       // $total_test=Exam::where('consultation_id',$consultation_id)->count();

        

        if($imgae_qnt!=$test_id_qnt)
        {
               return redirect()->back()->with('status',"Submit report properly.");
        }
        else 
        {
            foreach($image_array as $key=>$value)
            {
                if($image_array[$key])       
                {
                     
                     $file=$image_array[$key];
                     $extention=$file->getClientOriginalExtension();  
                     if(array_search($extention,['example','jpg','png','jpeg','gif','pdf']))
                     {
                          $filename=time().'.'.$extention;
                          $file->move('assets/report/',$filename);  
                          $data=[
                            'report'=>$filename
                          ];
                          if(Exam::where('consultation_id',$consultation_id)->where('test_id',$test_id_array[$key])->where('report',0)->exists()) //not submiited any report
                          {
                                Exam::where('consultation_id',$consultation_id)->where('test_id',$test_id_array[$key])->update($data);
                                return back()->with('status','Report Submitted');
                          }
                          elseif(Exam::where('consultation_id',$consultation_id)->where('test_id',$test_id_array[$key])->where('report','!=',0)->exists())  //submiited before.again submitting
                          {
                            $new_input=[
                                'consultation_id'=>$consultation_id,
                                'test_id'=>$test_id_array[$key],
                                'report'=>$filename
                            ];
                                Exam::create($new_input);
                                return back()->with('status','New Report Submitted');
                          }
                          else
                          {
                            dd('Technical error');
                          }
        
                     }
                     else
                     {
                          return back()->with('status', $extention.' file is not allowed.Only pdf and image file is allowed');
                     }
                     
                }
            }
            
           // $submitted_before=$total_test-Exam::where('consultation_id',$consultation_id)->where('report',null)->count();
            return redirect(url('/lab-view/'.$consultation_id))->with('status',$imgae_qnt." Report Submitted Successfully");

        }




        
    }





    public function lab_update(Request $request,$exam_id)
    {
        if(Exam::where('id',$exam_id)->first()->is_resent==0)
        {
            return back()->with('danger',"This report didn't Send back by doctor");
        }


        if(empty($request->file('updated_report')))
        {
            return back()->with('danger','Cannot Submit Empty');
        }
        else
        {
            //dd('catch');
            $file=$request->file('updated_report');
            $extention=$file->getClientOriginalExtension();  
            if(array_search($extention,['example','jpg','png','jpeg','gif','pdf']))
            {
                 $filename=time().'.'.$extention;
                 $file->move('assets/report/',$filename);  
                 if($file)
                 {
                      $old_report=Exam::where('id',$exam_id)->first()->report;
                      $old_report='assets/report/'.$old_report;
                      if(File::exists($old_report))
                      {
                           File::delete($old_report);
                           $exam=Exam::where('id',$exam_id)->first();
                           $exam->report=$filename;
                           if($exam->is_resent==1)
                           {
                               $exam->is_resent=0;
                           }
                           $exam->update();
                           return back()->with('status','Report Updated Successfully');

                      }
                 }

            }
            else
            {
                 return back()->with('danger', $extention.' file is not allowed');
            }

        }
        
        
    }
    public function lab_delete($exam_id,$consultation_id,$test_id)
    {
        // if(Comment::where('consultation_id',$consultation_id)->exists())
        // {
        //     return back()->with('danger',"This post is on Doctor's comment. You can't delete this report.");
        // }
        if(Exam::where('id',$exam_id)->where('is_once_sent_to_consult',1)->exists())
        {
            return back()->with('danger',"Once the report submitted to Consultation, you can't delete report anymore");
        }

        if(Exam::where('consultation_id',$consultation_id)->where('test_id',$test_id)->count()>1)  //multiple report uploaded
        {
                $exam=Exam::where('id',$exam_id)->first();
                if($exam->report)
                {
                    $old_image=$exam->report;
                    $old_image='assets/report/'.$old_image;
                    if(File::exists($old_image))
                    {
                        File::delete($old_image);
                    }
                }
                $row=Exam::find($exam_id);
                $row->delete();
                return back()->with('status','Report Deleted');
        }
        else
        {
            $exam=Exam::where('id',$exam_id)->first();
            if($exam->report)
            {
                $old_image=$exam->report;
                $old_image='assets/report/'.$old_image;
                if(File::exists($old_image))
                {
                    File::delete($old_image);
                }
            }
            $exam->report=0;
            $exam->update();
            return back()->with('status',' Report Deleted');
        }
    }

    public function lab_clear($consultation_id)
    {
        if(Exam::where('consultation_id',$consultation_id)->where('is_resent',1)->exists())
        {
            return back()->with('danger',"Can not send without updating the Re-Sent test");
        }
        if(Exam::where('consultation_id',$consultation_id)->where('report',0)->exists())
        {
            return back()->with('danger',"Can not send without uploading report");
        }

        $data=[
        'is_on_exam'=>0,
        'is_examed'=>1
        ];
        consultation::where('id',$consultation_id)->update($data);
        $data=[
            'is_once_sent_to_consult'=>1
        ];
        Exam::where('consultation_id',$consultation_id)->update($data);
        return redirect(route('lab'))->with('status', "A patient's sent to consultation");
    }


    public function lab_comment(Request $request,$exam_id)
    {
        
        if(empty($request->input('comment_from_lab')))
        {
            return redirect()->back()->with('danger',"Comment can't be empty");
        }
        $data=[
        'comment_from_lab'=>$request->input('comment_from_lab')
        ];
        Exam::where('id',$exam_id)->update($data);
        return redirect()->back()->with('status', "Commented in a report");
    }
    public function doctor_comment_to_lab(Request $request,$exam_id)
    {
        
        if(empty($request->input('comment_from_doctor_to_lab')))
        {
            return redirect()->back()->with('danger',"Comment can't be empty");
        }
        $data=[
        'comment_from_doctor'=>$request->input('comment_from_doctor_to_lab')
        ];
        Exam::where('id',$exam_id)->update($data);
        return redirect()->back()->with('status', "Commented in a report");
    }



}


