<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use App\Models\consultation;
use App\Models\Exam;
use App\Models\Doctor;
use App\Models\Comment;



class CommentController extends Controller
{

    public function doctor_comment(Request $request,$exam_id,$consultation_id)
    {
        if(!consultation::where('id',$consultation_id)->where('department_id',Auth::user()->doctor->department_id)->exists())
        {
            return back()->with('danger',"Access Denied");
        }

        if(empty($request->input('comment')))
        {
            return back()->with('danger',"Can't submit empty");
        }

        $data=[
            'consultation_id'=>$consultation_id,
            'exam_id'=>$exam_id,
            'comment_by_doctor_id'=>Auth::user()->doctor->id,
            'comment'=>$request->input('comment')
        ];
        Comment::create($data);

        return back()->with('status',"Commented in a report");


    }

    public function doctor_view($doctor_id)
    {
       $doctor=Doctor::where('id',$doctor_id)->first();
       $doctor->password='';
       $doctor->user->password='';
       return view('pages.comment.doctor_view',['doctor'=>$doctor]);
    }
}
