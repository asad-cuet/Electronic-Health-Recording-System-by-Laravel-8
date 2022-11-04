@extends('layout.lay')

@section('title','Patients')

@section('css')
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
<style>
    .hover-red:hover {
      color:red!important;
    }
    .hover-other:hover {
      color:rgb(0, 255, 213)!important;
    }
    .hover-dark:hover {
      color:rgb(30, 40, 148)!important;
    }
</style>    
@endsection
@section('content')

@if(!$consultation->exam_result)
<div class="alert alert-danger">
  You didn't give your <strong>Final Statement</strong> yet.
</div>

@else
<div class="alert alert-info">
You gave your <strong>Final Statement</strong> 
</div>
@endif


{{-- information and history section start --}}

<div class="row">
      <div class="col-sm">
      <ul class="list-group">
            <li class="list-group-item" aria-current="true" style="background-color:#D69C2F">
                  Patient Basic Information
            </li>
            <li class="list-group-item"><b>Name : </b>{{$consultation->patient->pre_name}} {{$consultation->patient->fname}} {{$consultation->patient->lname}} </li>
            <li class="list-group-item"><b>Gender : </b>{{$consultation->patient->gender}} </li>
            <li class="list-group-item"><b>Age : </b>{{$consultation->patient->age}} </li>
            <li class="list-group-item"><b>Height : </b>{{$consultation->patient->height}} (Fit.inchi)</li>
            <li class="list-group-item"><b>Wight : </b>{{$consultation->patient->weight}} Kg</li>
            <li class="list-group-item"><b>Phone : </b>{{$consultation->patient->phone}} </li>
            <li class="list-group-item"><b>Address : </b>{{$consultation->patient->address}} </li>
            <li class="list-group-item"><b>Guardian Phone : </b>{{$consultation->patient->guardian_phone}} </li>
            
            <li class="list-group-item text-white" aria-current="true" style="background-color: #264E36">Consulting By</li>
            <li class="list-group-item"><b>Name : </b>
                  <a href="{{url('/doctor-details/'.$consultation->doctor['id'])}}" class="">{{$consultation->doctor->user->name}}</a>
            </li>
            <li class="list-group-item"><b>Department : </b>{{$consultation->doctor->department->name}} </li>
      </ul>
      </div>
      <div class="col-sm">
            <ul class="list-group">

                  <li class="list-group-item bg-dark text-white" aria-current="true">
                        History
                        <div class="float-end">
                              <a href="{{url('/history/'.$consultation['patient_id'])}}" class="btn mb-1 text-white hover-other" style="background-color: #6d81a8">Update</a>
                        </div>
                  </li>
                  <li class="list-group-item"><b>Primary Admitting Diagnosis : </b>{{$history->primary_admitting_diagnosis}} </li>
                  <li class="list-group-item"><b>Permanant History : </b>{{$history->permanant_history}} </li>
                  <li class="list-group-item"><b>Previous Medical History : </b>{{$history->previous_medical_history}} </li>
                  <li class="list-group-item"><b>Surgical History : </b>{{$history->surgical_history}} </li>
                  <li class="list-group-item"><b>Smoker : </b>@if($history->smoker==1) Yes @else No @endif </li>
                  <li class="list-group-item"><b>Diabetes : </b>@if($history->diabetes==1) Yes @else No @endif </li>
                  <li class="list-group-item"><b>Heart Rate : </b>{{$history->heart_rate}} </li>
                  <li class="list-group-item"><b>BP Systole : </b>{{$history->bp_systole}} </li>
                  <li class="list-group-item"><b>BP Diastole : </b>{{$history->bp_diastole}} </li>
                  <li class="list-group-item"><b>Oxygen Seturation : </b>{{$history->oxygen_seturation}} </li>
                  <li class="list-group-item"><b>Pain On Scale : </b>@if($history->pain_on_scale==1) Yes @else No @endif </li>
            </ul>
      </div>
</div>

<br>

{{-- Prescribe and Medication section start --}}
<div class="row">
      <div class="col-sm">
            <ul class="list-group">
                  <li class="list-group-item text-white" aria-current="true" style="background-color:#9B2335">
                        Problem
                        <div class="float-end">
                              <a href="{{url('/problem/'.$consultation['id'])}}" class="btn mb-1 text-white hover-other" style="background-color:#292F33">Update</a>
                        </div>
                  </li>
                  <li class="list-group-item"><b>Details : </b>{{$consultation->problem_details}} </li>
                  <li class="list-group-item"><b>Duration : </b>{{$consultation->problem_duration}} </li>


                  <li class="list-group-item text-white w3-flat-wet-asphalt" aria-current="true" style="backgro-color:#603cba">
                        Doctor's Prescription
                        <div class="float-end">
                              <a href="{{url('/prescribe/'.$consultation['id'])}}" class="btn mb-1 text-white hover-dark" style="background-color:#92a8d1">Update</a>
                        </div>
                  </li>
                  @if(!count($consultation->prescribe))
                        <li class="list-group-item" aria-current="true">
                              Empty
                        </li>
                  @endif
                  @foreach ($consultation->prescribe as $item)
                  <li class="list-group-item">
                        <b>{{$item['title']}} : </b> {{$item['comment']}}
                        @if($item['isAllow'])
                        <a href="{{url('/prescribe-disallow/'.$item['id'])}}" onclick="return confirm('Once disallowed can not be allowed')" class="float-end btn badge bg-dark hover-red">
                               Disallow
                        </a>
                        @else
                        <div class="float-end badge" style="background-color:#9B2335">
                              Disallowed
                       </div>
                       @endif
                  </li>
                  @endforeach
            </ul>
      </div>
      <div class="col-sm">
            <ul class="list-group">
                  <li class="list-group-item text-white" aria-current="true" style="background-color:#55ACEE">
                        Medication
                        <div class="float-end">
                              <a href="{{url('/medication/'.$consultation['patient_id'])}}" class="btn mb-1 text-white hover-other" style="background-color:#292F33">Update</a>
                        </div>
                  </li>
                  <li class="list-group-item"><b>Medication : </b>{{$medication->medication}} </li>
                  <li class="list-group-item"><b>Dose : </b>{{$medication->dose}} </li>
                  <li class="list-group-item"><b>Route : </b>{{$medication->route}} </li>
                  <li class="list-group-item"><b>Frequency : </b>{{$medication->frequency}} </li>
                  <li class="list-group-item"><b>Last Taken : </b>{{$medication->last_taken}} </li>
            </ul>
      </div>
</div>
<br>




{{-- exam section start --}}


<ul class="list-group">
      <li class="list-group-item text-white" aria-current="true" style="background-color: #00758F">
            Given Test
            <div class="float-end">
                  <a href="{{url('/exam/'.$consultation['id'])}}" class="btn mb-1 text-white hover-other" style="background-color:#4040a1">Exam</a>
            </div>
      </li>
      @if(!count($test))
            <li class="list-group-item" aria-current="true">
                  Empty
            </li>
      @endif
      @foreach ($test as $item)
            <li class="list-group-item">
                  
                  <h5>{{$item->test->test_name}} : </h5>
                  @if(!empty($item->report))
                        <a href="{{asset('assets/report/'.$item->report)}}" class="badge btn btn-dark" target="_blank" rel="noopener noreferrer">View</a>  
                        @if($item->is_resent==0 && $item->is_once_sent_to_consult==1 && $consultation->is_complete==0)
                        <a href="{{url('/lab-resend/'.$item->id.'/'.$item->consultation_id)}}" onclick="return confirm('Are You Sure?')" class="badge btn btn-danger" rel="noopener noreferrer">Re Send to Lab</a> 
                        @endif


                        
                        {{-- lab comment section start --}}
                        <div class="mt-3">
                              @if($item->comment_from_lab)
                              <b>Comment From Laboratory: </b>{{$item->comment_from_lab}}
                              @endif
                        </div>
                        {{-- doctors to lab comment section start --}}
                        @if($consultation->is_on_exam)
                              @if($item->comment_from_doctor)
                              <b>Comment To Laboratory: </b>{{$item->comment_from_doctor}}
                              @endif
                              <div class="mt-3">
                                    <form action="{{url('/doctor-comment-to-lab/'.$item->id)}}" method="POST">
                                          @csrf
                                          <input type="text" name="comment_from_doctor_to_lab" placeholder="To Lab Tecknician">
                                          <button type="submit" class="btn btn-warning badge">@if($item->comment_from_doctor)Update Comment @else Comment @endif</button>
                                    </form>
                              </div>
                        @endif
                        {{-- doctors section start --}}
                        <div class="">
                              @if(!$consultation->is_on_exam)
                                    @if(count($comments)>0)
                                    
                                    @foreach ($comments as $com)
                                    @if( $item->id==$com->exam_id)
                                          <div class="mt-1 mb-1">
                                                {{$com->comment}} by 
                                                @if($com->doctor->user->id==Auth::user()->id) You 
                                                @else 
                                                <a href="{{url('/commented-doctor-view/'.$com->comment_by_doctor_id)}}">{{$com->doctor->user->name}} </a>
                                                @endif
                                          </div>   
                                          @endif                          
                                    @endforeach


                                    @endif    

                                    <div class="row">
                                          <div class="col-sm-8">
                                                <form action="{{url('/doctor-comment/'.$item->id.'/'.$item->consultation_id)}}" method="post">
                                                      @csrf
                                                      <input type="text" name="comment" placeholder="This comment is readable only for doctor" class="form-control">
                                                      
                                          </div>
                                          <div class="col-sm-4">
                                                      <button type="submit" class="btn btn-secondary">Comment</button>
                                                </form>
                                          </div>
                                    </div>

                              @endif    
                        </div>

                  @else
                       <div class="">Didn't Submitted Yet</div>
                  @endif
                  
                  
            </li>
      @endforeach
</ul>

<br>

<div class="row">
      <div class="col-sm">
            <ul class="list-group">
                  <li class="list-group-item text-white" style="background-color:#2F4F4F" aria-current="true">   
                        Doctor's Final Statement
                        <div class="float-end">
                              <a href="{{url('/exam-result/'.$consultation['id'])}}" class="btn mb-1 hover-dark" style="background-color:#D1B894">Final Statement</a>
                        </div>
                  </li>
                  <li class="list-group-item">@if($consultation->exam_result){{$consultation->exam_result}} @else Didn't submitted yet @endif</li>
            </ul>
      </div>
</div>

<br>

<div class="container center border border-1 p-4 border-danger" style="text-align:center">

      <a href="{{url('/consultant-complete/'.$consultation['id'])}}" 
      onclick="return confirm('After this action You will be unable to take any others actions to this patient')" 
      class="btn mb-1 text-white" style="background-color:#9B1B30">Complete this Consultation</a>
      <br>
      <b>After this action You will be unable to take any others actions to this patient</b>

</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@endsection